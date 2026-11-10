<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PaymentSeeder extends Seeder
{
    /**
     * Seed realistic balance and cheque payments for roughly seventy percent of orders.
     */
    public function run(): void
    {
        $approvedStatus = Status::where('name', 'Approved')->first() ?? Status::firstOrCreate(['name' => 'Approved']);
        $pendingStatus = Status::where('name', 'Pending')->first() ?? Status::firstOrCreate(['name' => 'Pending']);
        $demoCustomer = User::where('email', 'customer@jeweblrystore.com')->first();

        if ($demoCustomer !== null) {
            /** @var Collection<int, Order>|Order[] $demoOrders */
            $demoOrders = Order::with('user')
                ->where('user_id', $demoCustomer->getId())
                ->orderBy('created_at')
                ->get();

            if ($demoOrders->count() >= 1 && $demoOrders[0]->getPayment() === null) {
                $this->registerSeededPayment($demoOrders[0], Payment::METHOD_BALANCE, $approvedStatus->getId());
            }

            if ($demoOrders->count() >= 2 && $demoOrders[1]->getPayment() === null) {
                $this->registerSeededPayment($demoOrders[1], Payment::METHOD_CHEQUE, $pendingStatus->getId());
            }
        }

        $targetPaidCount = (int) floor(Order::query()->count() * 0.7);
        $alreadyPaidCount = Payment::query()->count();
        $remainingToPay = max(0, $targetPaidCount - $alreadyPaidCount);

        if ($remainingToPay === 0) {
            return;
        }

        $unpaidOrdersQuery = Order::with('user')->whereDoesntHave('payment');

        if ($demoCustomer !== null) {
            $unpaidOrdersQuery->where('user_id', '!=', $demoCustomer->getId());
        }

        /** @var Collection<int, Order>|Order[] $ordersToPay */
        $ordersToPay = $unpaidOrdersQuery->inRandomOrder()->take($remainingToPay)->get();

        foreach ($ordersToPay as $index => $order) {
            $method = $index % 4 === 0 ? Payment::METHOD_CHEQUE : Payment::METHOD_BALANCE;
            $statusId = $method === Payment::METHOD_CHEQUE ? $pendingStatus->getId() : $approvedStatus->getId();

            $this->registerSeededPayment($order, $method, $statusId);
        }
    }

    /**
     * Persist a balance or cheque payment with a valid date and synchronize order/PDF state.
     */
    private function registerSeededPayment(Order $order, string $method, int $statusId): void
    {
        $paymentDate = $order->getCreatedAt() !== null
            ? Carbon::parse($order->getCreatedAt())->format('Y-m-d')
            : now()->toDateString();

        $payment = Payment::factory()->create([
            'order_id' => $order->getId(),
            'amount' => $order->getTotal(),
            'method' => $method,
            'date' => $paymentDate,
            'status_id' => $statusId,
        ]);

        if ($method === Payment::METHOD_BALANCE) {
            $order->setStatusId($statusId);
            $order->save();

            return;
        }

        $this->storeSeededChequePdf($order, $payment);
    }

    /**
     * Generate and store the downloadable cheque PDF for a seeded cheque payment.
     */
    private function storeSeededChequePdf(Order $order, Payment $payment): void
    {
        if (Storage::disk('local')->exists($payment->getChequePath())) {
            return;
        }

        if (class_exists(Pdf::class)) {
            $viewData = [
                'order' => $order,
                'payment' => $payment,
                'customer' => $order->getUser() ?? User::find($order->getUserId()),
            ];

            $chequePdf = Pdf::loadView('payments.cheque', ['viewData' => $viewData]);
            Storage::disk('local')->put($payment->getChequePath(), $chequePdf->output());

            return;
        }

        Storage::disk('local')->put($payment->getChequePath(), "%PDF-1.4\n1 0 obj<<>>endobj\ntrailer<<>>\n%%EOF\n");
    }
}

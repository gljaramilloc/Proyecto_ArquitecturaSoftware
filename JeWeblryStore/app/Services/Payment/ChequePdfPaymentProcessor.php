<?php

namespace App\Services\Payment;

use App\Actions\CreatePaymentAction;
use App\Interfaces\PaymentProcessor;
use App\Models\Order;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

/**
 * Pays an order with a cheque: the payment stays pending until the cheque
 * is cashed, and a PDF cheque is generated for the customer to download.
 */
class ChequePdfPaymentProcessor implements PaymentProcessor
{
    public function __construct(private readonly CreatePaymentAction $createPaymentAction) {}

    /**
     * Process a cheque payment and store the generated PDF cheque.
     */
    public function pay(Order $order): Payment
    {
        return DB::transaction(function () use ($order): Payment {
            $payment = $this->createPaymentAction->execute($order, Payment::METHOD_CHEQUE, now()->toDateString());

            $viewData = [];
            $viewData['order'] = $order;
            $viewData['payment'] = $payment;
            $viewData['customer'] = $order->getUser();

            $chequePdf = Pdf::loadView('payments.cheque', ['viewData' => $viewData]);

            $this->storeCheque($payment->getChequePath(), $chequePdf->output());

            return $payment;
        });
    }

    /**
     * Store the cheque PDF on the configured disk (GCS bucket or local).
     */
    private function storeCheque(string $path, string $contents): void
    {
        if (config('filesystems.default') === 'gcs') {
            $client = new StorageClient([
                'projectId' => config('filesystems.disks.gcs.project_id'),
            ]);
            $client->bucket(config('filesystems.disks.gcs.bucket'))
                ->upload($contents, ['name' => $path]);

            return;
        }

        Storage::disk(config('filesystems.default'))->put($path, $contents);
    }
}

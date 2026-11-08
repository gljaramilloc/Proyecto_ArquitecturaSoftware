<?php

namespace Tests\Unit;

use App\Exceptions\InsufficientBalanceException;
use App\Interfaces\PaymentProcessor;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Status;
use App\Models\User;
use App\Services\Payment\BalancePaymentProcessor;
use App\Services\Payment\ChequePdfPaymentProcessor;
use Database\Seeders\StatusSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PaymentProcessorTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(StatusSeeder::class);
    }

    public function test_container_resolves_the_processor_for_each_method(): void
    {
        $chequeProcessor = app()->makeWith(PaymentProcessor::class, ['method' => Payment::METHOD_CHEQUE]);
        $balanceProcessor = app()->makeWith(PaymentProcessor::class, ['method' => Payment::METHOD_BALANCE]);

        $this->assertInstanceOf(ChequePdfPaymentProcessor::class, $chequeProcessor);
        $this->assertInstanceOf(BalancePaymentProcessor::class, $balanceProcessor);
    }

    public function test_cheque_processor_registers_a_pending_payment_and_stores_the_pdf(): void
    {
        Storage::fake('local');
        $order = $this->createOrder(balance: 0, total: 250.00);

        $payment = app(ChequePdfPaymentProcessor::class)->pay($order);

        $this->assertSame(Payment::METHOD_CHEQUE, $payment->getMethod());
        $this->assertSame(Status::findByName('Pending')->getId(), $payment->getStatusId());
        $this->assertEqualsWithDelta(250.00, $payment->getAmount(), 0.001);
        Storage::disk('local')->assertExists($payment->getChequePath());
    }

    public function test_balance_processor_discounts_the_balance_and_approves_the_order(): void
    {
        $order = $this->createOrder(balance: 1000.00, total: 400.00);

        $payment = app(BalancePaymentProcessor::class)->pay($order);

        $approvedStatusId = Status::findByName('Approved')->getId();
        $this->assertSame(Payment::METHOD_BALANCE, $payment->getMethod());
        $this->assertSame($approvedStatusId, $payment->getStatusId());
        $this->assertSame($approvedStatusId, $order->fresh()->getStatusId());
        $this->assertEqualsWithDelta(600.00, $order->getUser()->fresh()->getBalance(), 0.001);
    }

    public function test_balance_processor_rejects_an_order_greater_than_the_balance(): void
    {
        $order = $this->createOrder(balance: 100.00, total: 400.00);

        $this->expectException(InsufficientBalanceException::class);

        try {
            app(BalancePaymentProcessor::class)->pay($order);
        } finally {
            $this->assertNull($order->fresh()->getPayment());
            $this->assertEqualsWithDelta(100.00, $order->getUser()->fresh()->getBalance(), 0.001);
        }
    }

    private function createOrder(float $balance, float $total): Order
    {
        $customer = User::factory()->create(['balance' => $balance]);

        $order = new Order;
        $order->setUserId($customer->getId());
        $order->setTotal($total);
        $order->setStatusId(Status::findByName('Pending')->getId());
        $order->save();

        return $order;
    }
}

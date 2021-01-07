<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceFactory extends Factory
{
    protected $model = Invoice::class;

    public function definition() : array
    {
        static $invoiceId = 1;
        $chargeAmount = $this->faker->randomElement([50, 100, 150]);
        $totalAmount = $chargeAmount * 1.21; // 1.21 = tax
        $paymentMethodIds = PaymentMethod::get()->modelKeys();

        return [
            'invoice_sid' => '410-'.str_pad($invoiceId++, 4, "0", STR_PAD_LEFT),
            'store_id' => 1,
            'payment_method_id' => $paymentMethodIds[array_rand($paymentMethodIds, 1)],
            'description' => $this->faker->sentence,
            'is_notified' => $this->faker->boolean(50),
            'is_sent' => $this->faker->boolean(50),
            'is_charged' => $this->faker->boolean(50),
            'charge_amount' => $chargeAmount,
            'total_amount' => $totalAmount,
            'start_at' => $this->faker->dateTime,
            'end_at' => $this->faker->dateTime,
            'sent_at' => $this->faker->boolean(50) ? $this->faker->dateTime : null,
        ];
    }
}

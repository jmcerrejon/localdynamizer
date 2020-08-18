<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Invoice;
use App\Models\PaymentMethod;
use Faker\Generator as Faker;


$factory->define(Invoice::class, function (Faker $faker) {
    static $invoiceId = 1;
    $chargeAmount = $faker->randomElement([50, 100, 150]);
    $discountAmount = $faker->boolean(50) ? $faker->randomElement([10, 20, 30]) : 0;
    $totalAmount = ($chargeAmount - $discountAmount) * 1.21; // 1.21 = tax
    $paymentMethodIds = PaymentMethod::get()->modelKeys();

    return [
        'invoice_sid' => '410-'.str_pad($invoiceId++, 4, "0", STR_PAD_LEFT),
        'store_id' => 1,
        'payment_method_id' => $paymentMethodIds[array_rand($paymentMethodIds, 1)],
        'description' => $faker->sentence,
        'is_notified' => $faker->boolean(50),
        'is_sent' => $faker->boolean(50),
        'is_charged' => $faker->boolean(50),
        'charge_amount' => $chargeAmount,
        'discount_amount' => $discountAmount,
        'total_amount' => $totalAmount,
        'start_at' => $faker->dateTime,
        'end_at' => $faker->dateTime,
        'sent_at' => $faker->boolean(50) ? $faker->dateTime : null,
    ];
});

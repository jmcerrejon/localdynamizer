<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Store;
use App\Models\PaymentMethod;
use Faker\Generator as Faker;

$factory->define(Store::class, function (Faker $faker) {
    $isFemale = $faker->boolean(50);
    $paymentMethodIds = PaymentMethod::get()->modelKeys();

    return [
        'user_id' => 1,
        'payment_method_id' => $paymentMethodIds[array_rand($paymentMethodIds, 1)],
        'comercial_name' => $faker->company,
        'business_name' => $faker->company,
        'is_active' => $faker->boolean(70),
        'contact_name' => $faker->name($isFemale ? 'female' : 'male'),
        'address' => $faker->address,
        'locality' => 'Isla Cristina',
        'population' => 'Isla Cristina',
        'postal_code' => '21410',
        'email' => $faker->email,
        'public_phone' => ltrim($faker->e164PhoneNumber, '+'),
        'contact_phone' => ltrim($faker->e164PhoneNumber, '+'),
        'whatsapp' => ltrim($faker->e164PhoneNumber, '+'),
        'website' => $faker->url,
        'subscription_type' => 1,
        'logo_path' => $faker->imageUrl(1024, 768),
    ];
});

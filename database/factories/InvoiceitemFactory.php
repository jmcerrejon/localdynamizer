<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Invoiceitem;
use Faker\Generator as Faker;

$factory->define(Invoiceitem::class, function (Faker $faker) {
    $service = getRandomService();
    $invoiceId = Invoice::get()->modelKeys();

    return [
        'service_id' => $service->id,
        'invoice_id' => $invoiceId[array_rand($invoiceId, 1)],
        'description' => $service->description,
        'price' => $service->price,
    ];
});

function getRandomService()
{
    $services = Service::get();
    $serviceIds = $services->modelKeys();
    $randomServiceId = $serviceIds[array_rand($serviceIds, 1)];

    return $services->where('id', $randomServiceId)->first();
}
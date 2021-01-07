<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\Service;
use App\Models\Invoiceitem;
use Illuminate\Database\Eloquent\Factories\Factory;

class InvoiceitemFactory extends Factory
{
    protected $model = Invoiceitem::class;

    public function definition() : array
    {
        $service = $this->getRandomService();
        $invoiceId = Invoice::get()->modelKeys();

        return [
            'service_id' => $service->id,
            'invoice_id' => $invoiceId[array_rand($invoiceId, 1)],
            'description' => $service->description,
            'price' => $service->price,
        ];
    }

    private function getRandomService()
    {
        $services = Service::get();
        $serviceIds = $services->modelKeys();
        $randomServiceId = $serviceIds[array_rand($serviceIds, 1)];

        return $services->where('id', $randomServiceId)->first();
    }
}

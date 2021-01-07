<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Service;
use App\Models\Category;
use App\Models\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

class StoreFactory extends Factory
{
    protected $model = Store::class;

    public function definition() : array
    {
        $isFemale = $this->faker->boolean(50);
        $paymentMethodIds = PaymentMethod::get()->modelKeys();
        $serviceIds = Service::get()->modelKeys();
        $categoryIds = Category::get()->modelKeys();

        return [
            'user_id' => 1,
            'payment_method_id' => $paymentMethodIds[array_rand($paymentMethodIds, 1)],
            'service_id' => $serviceIds[array_rand($serviceIds, 1)],
            'location_id' => 3270,
            'category_id' => $categoryIds[array_rand($categoryIds, 1)],
            'comercial_name' => $this->faker->company,
            'business_name' => $this->faker->company,
            'cif' => 'A'.$this->faker->randomNumber(8),
            'contact_name' => $this->faker->name($isFemale ? 'female' : 'male'),
            'address' => $this->faker->address,
            'locality' => 'Isla Cristina',
            'population' => 'Isla Cristina',
            'postal_code' => '21410',
            'email' => $this->faker->email,
            'public_phone' => ltrim($this->faker->e164PhoneNumber, '+'),
            'contact_phone' => ltrim($this->faker->e164PhoneNumber, '+'),
            'whatsapp' => ltrim($this->faker->e164PhoneNumber, '+'),
            'website' => $this->faker->url,
            'subscription_type' => 1,
            'logo_path' => $this->faker->imageUrl(1024, 768),
        ];
    }
}

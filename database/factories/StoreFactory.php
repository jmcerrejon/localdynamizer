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
        $arrPremium = [];
        $isFemale = $this->faker->boolean(50);
        $paymentMethodIds = PaymentMethod::get()->modelKeys();
        $serviceIds = Service::get()->modelKeys();
        $getServiceId = $serviceIds[array_rand($serviceIds, 1)];
        $categoryIds = Category::get()->modelKeys();
        $email = $this->faker->email;

        $store = [
            'user_id' => 1,
            'service_id' => $getServiceId,
            'location_id' => 3270,
            'category_id' => $categoryIds[array_rand($categoryIds, 1)],
            'commercial_name' => $this->faker->company,
            'business_name' => $this->faker->company,
            'cif' => 'A'.$this->faker->randomNumber(8),
            'contact_name' => $this->faker->name($isFemale ? 'female' : 'male'),
            'address' => $this->faker->address,
            'postal_code' => '21042',
            'email' => $email,
            'email_public' => $this->faker->boolean(70) ? $email : null,
            'public_phone' => ltrim($this->faker->e164PhoneNumber, '+'),
            'contact_phone' => ltrim($this->faker->e164PhoneNumber, '+'),
            'whatsapp' => ltrim($this->faker->e164PhoneNumber, '+'),
            'logo_path' => $this->faker->imageUrl(1024, 768),
        ];
        
        if ($getServiceId === 2) {
            $arrPremium = [
                'website' => $this->faker->url,
                'payment_method_id' => $paymentMethodIds[array_rand($paymentMethodIds, 1)],
                'description' => $this->faker->sentence(15),
                'website' => $this->faker->boolean(70) ? $this->faker->url : null,
                'facebook' => $this->faker->word,
                'instagram' => $this->faker->word,
                'twitter' => $this->faker->word,
                'tripadvisor' => $this->faker->word,
                'tiktok' => $this->faker->word,
                'menu_es' => $this->faker->boolean(70) ? $this->faker->url : null,
                'menu' => $this->faker->boolean(50) ? $this->faker->url : null,
            ];
        }

        return array_merge($store, $arrPremium);
    }
}

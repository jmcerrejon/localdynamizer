<?php

namespace Database\Factories;

use App\Models\Store;
use App\Models\Activity;
use App\Models\ActivityStore;
use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityStoreFactory extends Factory
{
    protected $model = ActivityStore::class;

    public function definition() : array
    {
        $activityIds = Activity::get()->modelKeys();
        $storeIds = Store::get()->modelKeys();

        return [
            'activity_id' => $activityIds[array_rand($activityIds, 1)],
            'store_id' => $storeIds[array_rand($storeIds, 1)],
        ];
    }
}

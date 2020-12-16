<?php

namespace App\Http\Controllers\Admin;

use App\Models\{User, Store, Invoice, Resource};

class HomeController
{
    public function index()
    {
        $statistics = [
            'total_users' => User::count(),
            'total_resources' => Resource::count(),
            'total_sum_invoices' => Invoice::sum('charge_amount'),
            'total_stores' => Store::count(),
        ];

        return view('admin.dashboard', compact('statistics'));
    }
}

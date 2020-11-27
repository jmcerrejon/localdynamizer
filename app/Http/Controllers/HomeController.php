<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Resource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home.home');
    }

    public function search(Request $request)
    {
        $results = (new Search())
            ->registerModel(Appointment::class, 'title')
            ->registerModel(Store::class, ['comercial_name', 'business_name', 'contact_name'])
            ->registerModel(Resource::class, 'title')
            ->perform($request->input('q'));

        return view('home.search', compact('results'));
    }
}

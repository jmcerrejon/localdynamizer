<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Hashtag;
use App\Models\Resource;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Spatie\Searchable\ModelSearchAspect;

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
        $userId = auth()->user()->id;
        $results = (new Search())
            ->registerModel(Appointment::class, function(ModelSearchAspect $modelSearchAspect) use ($userId){
                $modelSearchAspect
                   ->addSearchableAttribute('title')
                   ->where('user_id', $userId);
            })
            ->registerModel(Store::class, function(ModelSearchAspect $modelSearchAspect) use ($userId){
                $modelSearchAspect
                   ->addSearchableAttribute('comercial_name')
                   ->addSearchableAttribute('business_name')
                   ->addSearchableAttribute('contact_name')
                   ->where('user_id', $userId);
            })
            ->registerModel(Resource::class, 'title')
            ->registerModel(Hashtag::class, function(ModelSearchAspect $modelSearchAspect) {
                $modelSearchAspect
                   ->addSearchableAttribute('name')
                   ->limit(1);
            })
            ->perform($request->input('q'));

        return view('home.search', compact('results'));
    }
}

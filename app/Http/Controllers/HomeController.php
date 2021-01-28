<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Spatie\Searchable\{Search, ModelSearchAspect};
use App\Models\{Store, Hashtag, Resource, Appointment};

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

    public function index(User $users): View
    {
        $user = $users->whereId(auth()->id())->withCount(['resources', 'stores'])->first();

        return view('home.home', compact('user'));
    }

    public function search(Request $request): View
    {
        $userId = auth()->id;
        $results = (new Search())
            ->registerModel(Appointment::class, function(ModelSearchAspect $modelSearchAspect) use ($userId){
                $modelSearchAspect
                   ->addSearchableAttribute('title')
                   ->where('user_id', $userId);
            })
            ->registerModel(Store::class, function(ModelSearchAspect $modelSearchAspect) use ($userId){
                $modelSearchAspect
                   ->addSearchableAttribute('commercial_name')
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

<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class GetLocationController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $query = Location::whereLike(
            ['name'],
            $request->get('q')
        )->take(5)
        ->get();

        $map = $query->map(function ($items) {
            $data['label'] = $items->name;
            $data['value'] = $items->id;

            return $data;
        });

        return response()->json($map);
    }
}

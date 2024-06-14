<?php

namespace App\Http\Controllers;


use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class RestaurantController extends Controller
{
    public function getRestaurantCoordinates(Request $request)
    {
        $restaurantId = $request->get('restaurant_id');
        $restaurant = Restaurant::where('restaurant_id', $restaurantId)->first();

        if ($restaurant) {
            return response()->json([
                'geometry' => $restaurant->geometry
            ]);
        }

        return response()->json(['error' => 'Nhà hàng không tồn tại'], 404);
    }
}

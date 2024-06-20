<?php

namespace App\Http\Controllers;

use App\Models\BannerHome;
use App\Models\Orders;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Category;
use App\Models\SugarOption;
use App\Models\IceOption;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Detection\MobileDetect;

class HomeController extends Controller
{
    public function index()
    {
        $restaurant = Cache::rememberForever('restaurant', function () {
            return Restaurant::all();
        });
//        $banner = Cache::rememberForever('banner', function () {
//            return BannerHome::all();
//        });
        // $restaurantId = Restaurant::find($restaurant_id);
//        $data['banner'] = $banner;
        $data['restaurant'] = $restaurant;
        // $data['restaurantId'] = $restaurantId;
        return view('pages.home.index', $data);
    }

    public function cart(Products $products, Request $request)
    {
        return view('pages.cart');
    }

    public function create(Request $request)
    {
        Products::create($request->all());

        return redirect()->route('')->with('success', 'Product added successfully');
    }

    public function deleteProductCart(Request $request)
    {
        $rowId = $request->input('rowId');
        Cart::remove($rowId);

        return response()->json(['cartCount' => Cart::count(), 'success' => 'Đã xóa sản phẩm thành công'], 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function showProduct(Products $products, Request $request, $restaurant_id, $category_id = null)
    {
        // $products = Products::all();
        session(['restaurant_id' => $restaurant_id]);
        $data['restaurant_id'] = $restaurant_id;
        // dd($restaurant_id);
        $category = Cache::rememberForever('category', function () {
            return Category::all();
        });
        $data['category'] = $category;

        // Kiểm tra xem có category_id được cung cấp không
        if ($category_id) {
            // Lọc sản phẩm theo category_id nếu được cung cấp
            $products = Products::where('restaurant_id', $restaurant_id)
                ->where('product_status', 1)
                ->where('category_id', $category_id)
                ->orderBy('category_id', 'asc')
                ->get();
        } else {
            // Nếu không có category_id, lấy tất cả sản phẩm
            $products = Products::where('restaurant_id', $restaurant_id)
                ->where('product_status', 1)
                ->orderBy('category_id', 'asc')
                ->get();
        }
        $data['products'] = $products;
        // dd($products);

        $sugar = Cache::rememberForever('sugar', function () {
            return SugarOption::all();
        });
        $data['sugar'] = $sugar;

        $ice = Cache::rememberForever('$ice', function () {
            return IceOption::all();
        });
        $data['ice'] = $ice;

        // $restaurant = Cache::remember('restaurant', $minutes, function () {
        $restaurant = Cache::rememberForever('restaurant', function () {
            return Restaurant::all();
        });
        $data['restaurant'] = $restaurant;
        $order = Orders::all();
        $data['restaurant'] = $order;
        // dd($order);
        $detect = new MobileDetect;
        $user = Auth::user();
        $data['user'] = $user;
        if ($detect->isMobile() || $detect->isTablet()) {
            return view('pages.mobileIndex', $data);
        } else {
            return view('pages.index', $data);
        }
        // return view('pages.index', $data);
    }

    public function addProductCart(Request $request)
    {
        $id = $request->input('id');
        $product = Cache::rememberForever("product_{$id}", function () use ($id) {
            return Products::findOrFail($id);
        });

        $sugarId = $request->input('sugar_id');
        $iceId = $request->input('ice_id');

        $sugar = SugarOption::findOrFail($sugarId);
        $ice = IceOption::findOrFail($iceId);
        // dd($sugar, $ice);
        $cartItem = Cart::add([
            'id' => $id,
            'name' => $product->product_name,
            'price' => $product->product_price,
            'qty' => 1,
            'options' => [
                'sugar' => $sugar->sugar_option,
                'ice' => $ice->ice_option
            ],
            'attributes' => [],
            'associatedModel' => $product
        ]);

        return response()->json([
            'success' => 'Thêm giỏ hàng thành công',
            'cartCount' => Cart::count(),
            'rowId' => $cartItem->rowId,
            'sugarOption' => $sugar->sugar_option,
            'iceOption' => $ice->ice_option
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function updateQuantityProduct(Request $request)
    {
        $rowId = $request->input('rowId');
        $change = $request->input('change');

        $cartItem = Cart::get($rowId);
        // dd($cartItem);
        Cart::update($rowId, $cartItem->qty + $change);

        return response()->json([
            'success' => 'Cập nhật số lượng sản phẩm thành công',
            'cartCount' => Cart::count(),
            'rowId' => $rowId,
            'quantity' => Cart::get($rowId)->qty
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }


    public function clearCart(Request $request)
    {
        Cart::destroy();
        return response()->json([
            'success' => 'Giỏ hàng đã được xóa thành công',
            'cartCount' => Cart::count()
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    public function checkRestaurantChange(Request $request)
    {
        $newRestaurantId = $request->input('newRestaurantId');
        $sessionRestaurantId = session('restaurant_id');
        $needToClearCart = false;

        if ($sessionRestaurantId && $sessionRestaurantId !== $newRestaurantId) {
            // session(['restaurant_id' => $newRestaurantId]);
            $needToClearCart = true;
        }
        // dd($sessionRestaurantId, $newRestaurantId, $needToClearCart);

        return response()->json([
            'needToClearCart' => $needToClearCart,
            'restaurantId' => $sessionRestaurantId,
            'newRestaurantId' => $newRestaurantId // Trả về để cập nhật localStorage trên client
        ]);
    }
}

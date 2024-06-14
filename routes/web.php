<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TelegramWebhookController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Trang chủ - Sản phẩm
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('shop')->group(function () {
    Route::get('shop/{restaurant_id}', [HomeController::class, 'showProduct'])->name('showProduct');
    // Route::get('shop/{restaurant_id}/{category_id?}', [HomeController::class, 'showProduct'])->name('showProductCate');
});

Route::middleware('quanly.giohang')->group(function () {
    Route::get('thanhtoan', [PaymentController::class, 'index'])->name('thanhtoan');
    Route::post('thanhtoan/checkRestaurantTime', [PaymentController::class, 'checkRestaurantTime']);
    Route::post('thanhtoan/validate-input', [PaymentController::class, 'validateInput']);
});

Route::prefix('shop/api/')->middleware('shop')->group(function () {
    Route::post('/clear-cart', [HomeController::class, 'clearCart'])->name('clearCart');
    Route::post('/add-products', [HomeController::class, 'addProductCart'])->name('add.to.cart');
    Route::post('/delete-product', [HomeController::class, 'deleteProductCart'])->name('delete.to.cart');
    Route::post('/update-quantity-product', [HomeController::class, 'updateQuantityProduct'])->name('update.quantity.cart');
    Route::post('/process-checkout', [PaymentController::class, 'processCheckout'])->name('process.checkout');
    Route::post('/get-restaurant', [PaymentController::class, 'calculateDistance'])->name('get.restaurant');
    Route::get('/get-restaurant-id', [PaymentController::class, 'getRestaurantId']);
    Route::post('/check-restaurant-change', [HomeController::class, 'checkRestaurantChange']);
});

// Route::get('/cart-count', [HomeController::class, 'getCartCount'])->name('cart.count');

//Login
Route::get('/login', function () {
    return view('login.index');
});
Route::post('/login', [UserController::class, 'Login'])->name('login');
Route::middleware('check')->group(function () {
    Route::get('/verify-mail', [UserController::class, 'VerifyMail'])->name('verify-mail');
    Route::get('/otp-expiry-time', [UserController::class, 'getOtpExpiryTime']);
    Route::post('/verify-mail', [UserController::class, 'VerifyMail']);
    Route::post('/resend-otp', [UserController::class, 'resendOtp']);
    Route::get('/thankyou', function () {
        return view('pages.thanks');
    })->name('thankyou');
});

Route::get('/otptest', function () {
    return view('donhang.otp');
});

Route::prefix('/donhang')->middleware('check')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('donhang');
    Route::get('/loadList', [OrderController::class, 'loadList']);
    Route::get('/inforRecord', [OrderController::class, 'inforRecord']);
});

//Register
Route::get('/register', function () {
    return view('register.index');
})->name('register');
Route::post('/register', [RegisterController::class, 'addUser'])->name('addUserRegister');
//Quản lý bank
Route::prefix('/system')->middleware('quanly.restaurant')->group(function () {
    Route::get('/dashboard', [DashBoardController::class, 'index'])->name('dashboard');
});

Route::prefix('/system/shop')->middleware('quanly.restaurant')->group(function () {
    Route::get('/{id}', [BankController::class, 'index'])->name('edit-restaurant');
    Route::get('/system/shop', [BankController::class, 'index'])->name('indexBank');
    Route::post('/{restaurant_id}/bank/addBank', [BankController::class, 'addBank'])->name('addBank');
    Route::post('/{restaurant_id}/bank/deleteBank/{accountId}', [BankController::class, 'deleteBank']);
    Route::post('/{restaurant_id}/bank/editBank', [BankController::class, 'editBank']);
    Route::get('/{restaurant_id}/bank/getBankData/{accountId}', [BankController::class, 'getBankData']);
    Route::get('/{restaurant_id}/getDeleteModal/{accountId}', [BankController::class, 'getDeleteModal']);
    Route::post('/{restaurant_id}/bank/updateDefault/{accountId}', [BankController::class, 'updateDefault']);
    Route::post('/{restaurant_id}/updateStatus', [DashBoardController::class, 'updateStatus']);
});
//Quản lý users
Route::prefix('/system/admin/user')->middleware('horizonAccess')->group(function () {
    Route::get('/', [UserController::class, 'indexAdmin'])->name('indexAdmin');
    Route::post('addUser', [UserController::class, 'addUser'])->name('addUser');
    Route::post('updateStatus/{userId}', [UserController::class, 'updateStatus']);
});
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');

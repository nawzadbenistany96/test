<?php

use App\Models\Cart;
use App\Models\Order;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/', function () {
    return view('LandingPage');
})->name('landingpage');
//Route For Set Language
Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
//End Route For Set Language
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\ProductsController::class, 'featuring'])->name('shop.featuring');
Route::get('/shop/{id}', [App\Http\Controllers\ProductsController::class, 'index'])->name('shop.index');
Route::get('/shop/{id}/{category_id}', [App\Http\Controllers\ProductsController::class, 'show'])->name('shop.show');

//Cart Actions Route

Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.index');

//Add Jeans In Cart
Route::post('/cart/jeans', [App\Http\Controllers\CartController::class, 'addJeans'])->name('addJeans');

//Add Laptops In Cart
Route::post('/cart/laptops', [App\Http\Controllers\CartController::class, 'addLaptops'])->name('addLaptops');

//Add PC-Desktops In Cart
Route::post('/cart/pcdesktops', [App\Http\Controllers\CartController::class, 'addPCDesktop'])->name('addPCDesktop');

//Add Phones In Cart
Route::post('/cart/phones', [App\Http\Controllers\CartController::class, 'addPhones'])->name('addPhones');


//Update and Delete Cart Items
Route::PUT('cart/{id}', [App\Http\Controllers\CartController::class, 'Update'])->name('Update');
Route::DELETE('cart/{id}', [App\Http\Controllers\CartController::class, 'Destroy'])->name('Delete');

//Checkout Route
Route::get('/checkout', [App\Http\Controllers\CartController::class, 'checkoutIndex'])->name('cart.checkout');
Route::post('/city', [App\Http\Controllers\CartController::class, 'CityAjax'])->name('ajaxCity');
Route::post('/totalprice', [App\Http\Controllers\CartController::class, 'totalPrice'])->name('totalPrice');


//Order Route
Route::post('/orders', [App\Http\Controllers\OrderController::class, 'store'])->middleware('auth')->name('orders.store');

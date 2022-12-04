<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

/* Route::resource('products', ProductController::class);
Route::resource('orders', OrderController::class)->middleware('auth'); */

/* Route::get('/cart', function(){
    return view('cart');
})->name('cart');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */

/* Auth::routes(); */
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
 
    return redirect('/user/dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
 
    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

/* Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend'); */

//SOLO AUTENTICADOS
Route::group(['middleware' => 'auth'], function(){

    //ADMIN
    Route::group([
        'prefix' => 'admin',
        'middleware' => 'is_admin',
        'as' => 'admin.',
    ], function(){
        Route::resource('products', \App\Http\Controllers\Admin\ProductController::class);
        Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class);
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('users', function () {
            return view('admin.users.index');
        })->name('users.index');
    });
    //USER
    Route::group([
        'prefix' => 'user',
        'middleware' => 'verified',
        'as' => 'user.',
    ], function(){

        Route::resource('products', \App\Http\Controllers\User\ProductController::class);
        Route::resource('orders', \App\Http\Controllers\User\OrderController::class);
        Route::get('dashboard', function () {
            return view('user.dashboard');
        })->name('dashboard');
        Route::get('cart', function(){
            return view('user.cart');
        })->name('cart');
        /* Route::resource('products.index', ProductController::class);
        Route::resource('orders.', ProductController::class); */
    });

});

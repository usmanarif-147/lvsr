<?php

use App\Http\Controllers\ShowProfileController;
use App\Http\Controllers\VCardController;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome.home');
})->name('home');

Route::get('/terms-and-conditions', function () {
    return view('welcome.terms');
})->name('terms');

Route::get('/refund-policy', function () {
    return view('welcome.refund');
})->name('refund');

Route::get('/privacy-policy', function () {
    return view('welcome.privacy');
})->name('privacy');


Route::fallback(function () {
    if (request()->segment(1) == 'admin' || request()->segment(1) == 'admin-login') {
        return redirect()->route('admin.login.form');
    }
    return abort(404);
});

Route::get('/optimize', function () {
    Artisan::call('optimize:clear');
    dd("cache-cleared");
});

Route::get('/create-storage-link', function () {
    Artisan::call('storage:link');
    dd("link created");
});

Route::get('/migrate', function () {
    Artisan::call('migrate');
    dd("migration done");
});

Route::get('/seed', function () {
    Artisan::call('db:seed');
    dd("seeder done");
});

//payment setup
// Route::get('/payment-details', function () {
//     dd("working");
//     return view('payment.payment-method');
// })->name('payment.details');


Route::get('/card_id/{uuid}', [ShowProfileController::class, 'showProfile']);
Route::get('/user/{username}', [ShowProfileController::class, 'showProfile']);

Route::get('add-contact/{id}', [VCardController::class, 'addContact'])->name('add.contact');

Route::get('/show-profile', function () {
    // dd("working");
    return view('user-profile.temp-three');
});


require __DIR__ . '/auth.php';

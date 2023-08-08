<?php

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
    return view('welcome');
});


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
Route::get('/payment-details', function () {
    dd("working");
    return view('payment.payment-method');
})->name('payment.details');

// Profile using card_id
Route::get('/card_id/{uuid}', function ($uuid) {

    $user = Card::join('user_cards', 'cards.id', 'user_cards.card_id')
        ->join('users', 'users.id', 'user_cards.user_id')
        ->where('cards.uuid', $uuid)
        ->get()
        ->first();
    if (!$user) {
        return abort(404);
    }

    $userPlatforms = [];
    $platforms = DB::table('user_platforms')
        ->select(
            'platforms.id',
            'platforms.title',
            'platforms.icon',
            'platforms.input',
            'platforms.baseUrl',
            'user_platforms.created_at',
            'user_platforms.path',
            'user_platforms.label',
            'user_platforms.platform_order',
            'user_platforms.direct',
        )
        ->join('platforms', 'platforms.id', 'user_platforms.platform_id')
        ->where('user_id', $user->id)
        ->orderBy(('user_platforms.platform_order'))
        ->get();

    for ($i = 0; $i < $platforms->count(); $i++) {
        array_push($userPlatforms, $platforms[$i]);
    }

    $userPlatforms = array_chunk($userPlatforms, 4);

    return view('profile', compact('user', 'userPlatforms'));
});

// Profile using username
Route::get('user/{username}', function ($username) {

    $user = User::where('username', request()->username)
        ->first();
    if (!$user) {
        return abort(404);
    }

    $card = DB::table('user_cards')->where('user_id', $user->id)
        ->first();
    if (!$card) {
        return abort(404);
    }


    $userPlatforms = [];
    $platforms = DB::table('user_platforms')
        ->select(
            'platforms.id',
            'platforms.title',
            'platforms.icon',
            'platforms.input',
            'platforms.baseUrl',
            'user_platforms.created_at',
            'user_platforms.path',
            'user_platforms.label',
            'user_platforms.platform_order',
            'user_platforms.direct',
        )
        ->join('platforms', 'platforms.id', 'user_platforms.platform_id')
        ->where('user_id', $user->id)
        ->orderBy(('user_platforms.platform_order'))
        ->get();

    for ($i = 0; $i < $platforms->count(); $i++) {
        array_push($userPlatforms, $platforms[$i]);
    }

    $userPlatforms = array_chunk($userPlatforms, 4);

    return view('profile', compact('user', 'userPlatforms'));
});



require __DIR__ . '/auth.php';

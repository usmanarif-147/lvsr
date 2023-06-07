<?php

use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Admin\Background\BackgroundColors;
use App\Http\Livewire\Admin\Background\Create as BackgroundColorCreate;
use App\Http\Livewire\Admin\Background\Edit as BackgroundColorEdit;
use App\Http\Livewire\Admin\Button\ButtonColors;
use App\Http\Livewire\Admin\Button\Create as ButtonColorCreate;
use App\Http\Livewire\Admin\Button\Edit as ButtonColorEdit;
use App\Http\Livewire\Admin\Card\Cards;
use App\Http\Livewire\Admin\Card\Create as CardCreate;
use App\Http\Livewire\Admin\Card\Edit as CardEdit;
use App\Http\Livewire\Admin\Dashboard;
use App\Http\Livewire\Admin\Font\FontStyles;
use App\Http\Livewire\Admin\Font\Create as FontCreate;
use App\Http\Livewire\Admin\Font\Edit as FontEdit;
use App\Http\Livewire\Admin\Logs;
use App\Http\Livewire\Admin\Plan\Create as PlanCreate;
use App\Http\Livewire\Admin\Plan\Edit as PlanEdit;
use App\Http\Livewire\Admin\Plan\Plans;
use App\Http\Livewire\Admin\Platform\Create as PlatformCreate;
use App\Http\Livewire\Admin\Platform\Edit as PlatformEdit;
use App\Http\Livewire\Admin\Platform\Platforms;
use App\Http\Livewire\Admin\User\Edit as UserEdit;
use App\Http\Livewire\Admin\User\Users;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:admin')->group(function () {

    Route::get('dashboard', Dashboard::class);

    // users
    Route::get('users', Users::class);
    Route::get('user/{id}/edit', UserEdit::class);

    // platforms
    Route::get('platforms', Platforms::class);
    Route::get('platform/create', PlatformCreate::class);
    Route::get('platform/{id}/edit', PlatformEdit::class);

    // background colors
    Route::get('background-colors', BackgroundColors::class);
    Route::get('background-color/create', BackgroundColorCreate::class);
    Route::get('background-color/{id}/edit', BackgroundColorEdit::class);

    // button colors
    Route::get('button-colors', ButtonColors::class);
    Route::get('button-color/create', ButtonColorCreate::class);
    Route::get('button-color/{id}/edit', ButtonColorEdit::class);

    // font styles
    Route::get('font-styles', FontStyles::class);
    Route::get('font-style/create', FontCreate::class);
    Route::get('font-style/{id}/edit', FontEdit::class);

    // plans
    Route::get('stripe-plans', Plans::class);
    Route::get('stripe-plan/create', PlanCreate::class);
    Route::get('stripe-plan/{id}/edit', PlanEdit::class);

    // cards
    Route::get('cards', Cards::class);
    Route::get('card/create', CardCreate::class);
    Route::get('card/{id}/edit', CardEdit::class);
    Route::get('/downloadCardsCSV', [Cards::class, 'downloadCsv'])->name('export');

    // logs
    Route::get('logs', Logs::class);

    // profile
    Route::post('/changePassword', [ProfileController::class, 'changePassword'])->name('profile.change.password');


    // stripe
    Route::get('plans', [PaymentController::class, 'plans']);
    Route::get('get/plans', [PaymentController::class, 'getPlans']);
    Route::get('create-payment-method', [PaymentController::class, 'createPaymentMethod']);

    Route::get('setup-payment-method', [PaymentController::class, 'setupPaymentMethod']);
    Route::post('payment-method-details', [PaymentController::class, 'paymentMethodDetails'])->name('payment-details-details');
    Route::post('user/subscribe', [PaymentController::class, 'userSubscribe'])->name('user-subscribe');
});

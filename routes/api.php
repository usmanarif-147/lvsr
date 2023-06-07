<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BackgroundColorController;
use App\Http\Controllers\Api\ButtonColorController;
use App\Http\Controllers\Api\CardController;
use App\Http\Controllers\Api\PhoneContactController;
use App\Http\Controllers\Api\PlatformController;
use App\Http\Controllers\Api\ProfileController as UserProfileController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConnectController;
use App\Http\Controllers\Api\StripePaymentController;
use App\Http\Controllers\Api\ViewProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('register', [AuthController::class, 'register'])->middleware(['deviceId.headers', 'throttle:6,1']);
Route::post('login', [AuthController::class, 'login'])->middleware(['deviceId.headers', 'throttle:6,1']);
Route::post('forgotPassword', [AuthController::class, 'forgotPassword'])->middleware(['deviceId.headers', 'throttle:6,1']);
Route::post('resetPassword', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {

    Route::middleware('user.status')->group(function () {
        // Category
        // Route::get('/categories', [CategoryController::class, 'index']);

        Route::post('extraDetails', [AuthController::class, 'extraDetails']);
        // User
        Route::post('/connect', [UserController::class, 'connect']);
        Route::get('/analytics', [UserController::class, 'analytics']);
        Route::post('/privateProfile', [UserController::class, 'privateProfile']);
        Route::post('/recoverAccount', [AuthController::class, 'recoverAccount']);
        Route::get('/deactivateAccount', [UserController::class, 'deactivateAccount']);

        // Background Colors
        Route::get('/backgroundColors', [BackgroundColorController::class, 'allBackgroundColors']);
        Route::post('/updateBackgroundColor', [BackgroundColorController::class, 'updateBackgroundColor']);

        // Button Colors
        Route::get('/buttonColors', [ButtonColorController::class, 'allButtonColors']);
        Route::post('/updateButtonColor', [ButtonColorController::class, 'updateButtonColor']);

        // User Profile
        Route::get('/profile', [UserProfileController::class, 'index']);
        Route::post('/updateAccount', [UserProfileController::class, 'update']);
        Route::get('/userDirect', [UserProfileController::class, 'userDirect']);
        Route::get('/privateProfile', [UserController::class, 'privateProfile']);

        // Platform
        Route::get('/allPlatfomrs', [PlatformController::class, 'allPlatforms']);
        Route::post('/addPlatform', [PlatformController::class, 'add']);
        Route::post('/updatePlatform', [PlatformController::class, 'update']);
        Route::post('/removePlatform', [PlatformController::class, 'remove']);
        Route::post('/swapOrder', [PlatformController::class, 'swap']);
        Route::post('/platformDirect', [PlatformController::class, 'direct']);
        Route::post('/platformClick', [PlatformController::class, 'incrementClick']);

        // Phone Contact
        Route::get('/phoneContacts', [PhoneContactController::class, 'index']);
        Route::post('/phoneContact', [PhoneContactController::class, 'phoneContact']);
        Route::post('/addPhoneContact', [PhoneContactController::class, 'add']);
        Route::post('/updatePhoneContact', [PhoneContactController::class, 'update']);
        Route::post('/removeContact', [PhoneContactController::class, 'remove']);

        // Cards
        Route::get('/cards', [CardController::class, 'index']);
        Route::post('/activateCard', [CardController::class, 'activateCard']);
        Route::post('/changeCardStatus', [CardController::class, 'changeCardStatus']);

        // View User Profile
        Route::post('/viewUserProfile', [ViewProfileController::class, 'viewUserProfile']);

        // Connects
        Route::post('/connect', [ConnectController::class, 'connect']);
        Route::post('/disconnect', [ConnectController::class, 'disconnect']);
        Route::post('/connectionProfile', [ConnectController::class, 'getConnectionProfile']);
        Route::get('/connections', [ConnectController::class, 'getConnections']);

        //stripe
        Route::get('/allPlans', [StripePaymentController::class, 'getAllPlans']);
        Route::post('/addPaymentDetails', [StripePaymentController::class, 'addPaymentDetails']);
        Route::get('/allPaymentMethods', [StripePaymentController::class, 'getAllPaymentMethods']);
        Route::post('/paymentMethodDetails', [StripePaymentController::class, 'paymentMethodDetails']);
        Route::post('/subscribePlan', [StripePaymentController::class, 'subscribePlan']);
    });
    Route::get('logout', [AuthController::class, 'logout']);
});

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Stripe\PaymentDetailsRequest;
use App\Http\Requests\Api\Stripe\PaymentMethodRequest;
use App\Http\Requests\Api\Stripe\SubscribePlanRequest;
use App\Models\Plan;
use App\Models\User;
use App\Models\UserPaymentMethod;
use Illuminate\Http\Request;
use Laravel\Cashier\PaymentMethod as CashierPaymentMethod;
use Stripe\PaymentMethod as StripePaymentMethod;
use Stripe\Stripe;

class OldStripePaymentController extends Controller
{
    public $stripe, $stripeClient;

    public function __construct()
    {
        $key = config('services.stripe.secret');

        $this->stripe = Stripe::setApiKey($key);
        $this->stripeClient = new \Stripe\StripeClient($key);
    }

    public function getAllPlans()
    {
        $plans = Plan::select(
            'plans.product_id as plan_id',
            'plans.title',
            'plans.name',
            'plans.amount',
            'plans.currency',
            'plans.interval',
            'plans.interval_count'
        )->get();
        return response()->json(['plans' => $plans]);
    }

    /**
     * Add Payment Details
     */
    public function addPaymentDetails(PaymentDetailsRequest $request)
    {

        $customer = User::find(auth()->id())->createOrGetStripeCustomer();

        $paymentMethod = StripePaymentMethod::create([
            'type' => $request['type'],
            'card' => [
                'number' => $request['number'],
                'exp_month' => $request['exp_month'],
                'exp_year' => $request['exp_year'],
                'cvc' => $request['cvc'],
            ],
        ]);

        UserPaymentMethod::create([
            'user_id' => auth()->id(),
            'pm_method_id' => $paymentMethod->id
        ]);

        $customerPaymentMethod = User::find(auth()->id())->addPaymentMethod($paymentMethod->id);

        return response()->json(['paymentMethod' => $customerPaymentMethod, 'customer' => $customer]);
    }

    /**
     * Get All Payment Methods
     */
    public function getAllPaymentMethods()
    {
        $paymentMethods = User::find(auth()->id())->paymentMethods();
        return response()->json(['paymentMethods' => $paymentMethods]);
    }

    /**
     * Payment Method
     */
    public function paymentMethodDetails(PaymentMethodRequest $request)
    {
        $paymentMethod = User::find(auth()->id())->findPaymentMethod($request['pm_method_id']);
        return response()->json(['paymentMethod' => $paymentMethod]);
    }

    /**
     * Subscribe Plan
     */
    public function subscribePlan(SubscribePlanRequest $request)
    {

        // dd($request->pm_method_id);
        $user = User::find(auth()->id());
        $plan = Plan::where('product_id', $request->plan_id)->first();

        // $price = $this->stripeClient->prices->retrieve(
        //     $planName->price_id,
        //     []
        // );

        // return $price;

        // $user = User::find(auth()->id());


        // $anchor = now()->addMonths(1);
        $anchor = now()->addDays(1);

        $subscription = $user->newSubscription($plan->name)
            ->anchorBillingCycleOn($anchor->startOfDay())
            ->price($plan->price_id)
            ->create($request->pm_method_id);

        return $subscription;
    }
}

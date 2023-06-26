<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Stripe\PaymentMethodRequest;
use App\Http\Requests\Api\Stripe\SubscribePlanRequest;
use App\Http\Resources\Api\PlanResource;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;

class StripePaymentController extends Controller
{
    public $key, $pub_key, $stripe, $stripeClient;

    public function __construct()
    {
        $this->key = config('services.stripe.secret');
        $this->pub_key = config('services.stripe.key');

        $this->stripe = Stripe::setApiKey($this->key);
        $this->stripeClient = new \Stripe\StripeClient($this->key);
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
        return response()->json(['plans' => PlanResource::collection($plans)]);
    }


    /**
     * Choose Plan
     */
    public function userChoosePlan(Request $request)
    {
        $user = User::find(1);
        return view('payment.update-payment-method', [
            'user_id' => $user->id,
            'intent' => $user->createSetupIntent()
        ]);

        DB::table('user_plan_details')->where('user_id', auth()->id())->delete();
        DB::table('user_plan_details')->insert([
            'user_id' => auth()->id(),
            'plan_id' => $request->plan_id,
            'free_trial' => $request->free_trial
        ]);



        return response()->json([
            'data' => DB::table('user_plan_details')->where('user_id', auth()->id())->first()
        ]);
    }

    /**
     * Setup Payment Details
     */
    public function setupPaymentMethod()
    {
        $user = User::find(auth()->id());
        return response()->json([
            'customer_id' => auth()->id(),
            'stripe_key' => $this->pub_key,
            'intent' => $user->createSetupIntent()
        ]);
    }

    /**
     * Store Payment Details
     */
    public function storePaymentDetails(Request $request)
    {
        return $request->payment_method;
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
    // public function subscribePlan(SubscribePlanRequest $request)
    // {

    //     return $request->all();
    //     // dd($request->pm_method_id);
    //     $user = User::find(auth()->id());
    //     $plan = Plan::where('product_id', $request->plan_id)->first();

    //     // $price = $this->stripeClient->prices->retrieve(
    //     //     $planName->price_id,
    //     //     []
    //     // );

    //     // return $price;

    //     // $user = User::find(auth()->id());


    //     // $anchor = now()->addMonths(1);
    //     $anchor = now()->addDays(1);

    //     $subscription = $user->newSubscription($plan->name)
    //         ->anchorBillingCycleOn($anchor->startOfDay())
    //         ->price($plan->price_id)
    //         ->create($request->pm_method_id);

    //     return $subscription;
    // }

    /**
     * Subscribe Plan
     */
    public function subscribePlan(SubscribePlanRequest $request)
    {
        // find user
        $user = User::find(auth()->id());

        //check user is already subscribed
        // if ($user->subscriptions) {
        //     return response()->json(['message' => "You can't subscribe more than 1 plans."]);
        // }

        // find plan
        $plan = Plan::where('product_id', $request->plan_id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Please select valid plan, plan does not exist']);
        }

        // if user is not stripe customer then first make user as stripe customer
        if (!$user->stripe_id) {
            $user->createAsStripeCustomer();
            $user->addPaymentMethod($request->setup_intent['payment_method']);
            $user->updateDefaultPaymentMethod($request->setup_intent['payment_method']);
        }

        // if user already on trial period
        if ($user->subscription($plan->name)) {
            if ($user->subscription($plan->name)->onTrial()) {
                return response()->json(['message' => 'You are on trial period']);
            }
            if ($user->subscription($plan->name)->active()) {
                return response()->json(['message' => 'you already subscribed this plan']);
            }
        }

        // first time when user purchase subscription or select free trial
        $subscription = null;
        if ($request->free_trial) {
            // if user select trial period
            $subscription = $user->newSubscription($plan->name)
                ->trialDays(2)
                ->price($plan->price_id)
                ->create($request->setup_intent['payment_method']);
        } else {
            // if user select subscribe plan
            $anchor = now()->addDays($plan->interval_count);
            $subscription = $user->newSubscription($plan->name)
                ->anchorBillingCycleOn($anchor->startOfDay())
                ->price($plan->price_id)
                ->create($request->pm_method_id);
        }

        return $subscription;
    }

    /**
     * Cancel Subscription
     */
    public function cancelSubscription(SubscribePlanRequest $request)
    {
        $user = User::find(auth()->id());

        //check user is subscribed
        if (!$user->subscriptions) {
            return response()->json(['message' => "You can't cancel subscription, because you are not subscribed to any plan"]);
        }

        //check if user already canceled the plan
        if ($user->subscriptions->first()->ends_at) {
            return response()->json(['message' => "You have already canceled the subscription"]);
        }

        // find plan
        $plan = Plan::where('product_id', $request->plan_id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Please select valid plan, plan does not exist']);
        }

        // check user subscription plan exist
        if (!$user->subscription($plan->name)) {
            return response()->json(['message' => 'You are not eligible to cancel subscription for this plan']);
        }

        $user->subscription($plan->name)->cancel();
        return response()->json(['message' => $user->subscriptions]);
    }

    /**
     * Resume Subscription
     */
    public function resumeSubscription(SubscribePlanRequest $request)
    {
        $user = User::find(auth()->id());

        //check user is subscribed
        if (!$user->subscriptions) {
            return response()->json(['message' => "You can't resume subscription, because you have not selected any subscription"]);
        }

        // find plan
        $plan = Plan::where('product_id', $request->plan_id)->first();
        if (!$plan) {
            return response()->json(['message' => 'Please select valid plan, plan does not exist']);
        }

        //check if user already canceled the plan
        if (!$user->subscriptions->first()->ends_at) {
            return response()->json(['message' => 'This action is invalid because subscription is already active']);
        }

        // check user subscription plan exist
        if (!$user->subscription($plan->name)) {
            return response()->json(['message' => 'You are not eligible to resume subscription for this plan']);
        }

        $user->subscription($plan->name)->resume();
        return response()->json(['message' => $user->subscriptions]);
    }
}

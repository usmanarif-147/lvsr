<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;
use Stripe\PaymentMethod;
use \Stripe\Stripe;

class PaymentController extends Controller
{

    public $stripe;

    public function __construct()
    {
        $key = \config('services.stripe.secret');
        $this->stripe = new \Stripe\StripeClient($key);
    }

    public function plans()
    {
        $plansraw = $this->stripe->plans->all();

        $plans = $plansraw->data;

        // return $plans;
        // die();

        foreach ($plans as $plan) {
            $prod = $this->stripe->products->retrieve(
                $plan->product,
                []
            );
            $plan->product = $prod;

            $plan = Plan::create([
                'product_id' => $plan->product->id,
                'price_id' => $plan->id,
                'title' => $plan->product->name,
                'name' => str_replace(' ', '_', strtolower($plan->product->name)),
                'currency' => $plan->currency,
                'interval' => $plan->interval,
                'interval_count' => $plan->interval_count,
                'amount' => $plan->amount / 100,
            ]);
        }
        // return $plans;

        dd(Plan::all()->toArray());
    }

    public function getPlans()
    {
        dd(Plan::get()->toArray());
    }

    // create payment methods
    public function createPaymentMethod()
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentMethod = PaymentMethod::create([
            'type' => 'card',
            'card' => [
                'number' => '4242 4242 4242 4242',
                'exp_month' => '04',
                'exp_year' => '23',
                'cvc' => '242',
            ],
        ]);

        return $paymentMethod;
    }

    public function setupPaymentMethod()
    {
        $user = User::find(1);
        return view('payment.update-payment-method', [
            'user_id' => $user->id,
            'intent' => $user->createSetupIntent()
        ]);
    }

    // public function paymentMethodDetails(Request $request)
    // {
    //     // dd($request->all());
    //     return [
    //         'data' => [
    //             'client_secret' => $request->data['client_secret'],
    //             'payment_method' => $request->data['payment_method'],
    //             'request' => $request->data
    //         ]
    //     ];
    // }

    public function userSubscribe(Request $request)
    {
        $user = User::find($request->user_id);
        $user->createAsStripeCustomer();
        $payment_method = $user->addPaymentMethod($request->data['payment_method']);
        User::where('id', $user->id)->update([
            'pm_method_id' => $payment_method->id
        ]);
        return User::find($request->user_id);
        die();
        dd($user->defaultPaymentMethod());
        dd($user->findPaymentMethod($request->data['payment_method']));
        $sub = $user->newSubscription(
            'one_day'
        )->create($request->data['payment_method']);

        dd($sub);
    }
}

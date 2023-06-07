<?php

namespace App\Http\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Component;
use Stripe\Stripe;

class Create extends Component
{

    public $heading, $isDisabled, $billing_cycles = [];

    public
        $title,
        $interval,
        $currency,
        $amount;

    protected function rules()
    {
        return [
            'title'                 =>        ['required'],
            'interval'              =>        ['required', 'not_in:0'],
            'amount'                =>        ['required'],
        ];
    }


    public function mount()
    {
        $this->billing_cycles = [
            'day' => 'Daily',
            'week' => 'Weekly',
            'month' => 'Monthly',
            'quarter' => 'Every 3 Months',
            'semiannual' => 'Every 6 Months',
            'year' => 'Yearly',
            'custom' => 'Custom',
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();
        $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));

        $data['currency'] = 'usd';
        $data['interval_count'] = 1;

        if ($data['interval'] == 'quarter') {
            $data['interval'] = 'month';
            $data['interval_count'] = 3;
        }
        if ($data['interval'] == 'semiannual') {
            $data['interval'] = 'month';
            $data['interval_count'] = 6;
        }


        $product = $stripe->products->create([
            'name' => $data['title'],
            'default_price_data' => [
                'unit_amount' => $data['amount'] * 100,
                'currency' => $data['currency'],
                'recurring' => [
                    'interval' => $data['interval'],
                    'interval_count' => $data['interval_count'],

                ],
            ],
            'expand' => ['default_price'],
        ]);


        $plan = Plan::create([
            'product_id' => $product['id'],
            'price_id' => $product['default_price']['id'],
            'title' => $product['name'],
            'name' => str_replace(' ', '_', strtolower($product['name'])),
            'currency' => $product['default_price']['currency'],
            'interval' => $product['default_price']['recurring']['interval'],
            'interval_count' => $product['default_price']['recurring']['interval_count'],
            'amount' => $product['default_price']['unit_amount'] / 100,
        ]);

        dd($plan->toArray());

        // unset($data['color']);
        // $data['name'] = $this->name;
        // $data['color_code'] = $this->color_code;

        // BackgroundColor::create($data);

        // $this->dispatchBrowserEvent('swal:modal', [
        //     'type' => 'success',
        //     'message' => 'Background Color created successfully!',
        // ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.plan.create')
            ->layout('layouts.app');
    }
}

<?php

namespace App\Http\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Component;

class Edit extends Component
{

    public $heading, $isDisabled;

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
            'currency'              =>        ['required'],
            'amount'                =>        ['required'],
        ];
    }


    public function mount($id)
    {
        $plan = Plan::find($id);
        dd($plan);
        $this->title = $plan->title;
        $this->interval = $plan->interval;
        $this->currency = $plan->currency;
        $this->amount = $plan->amount;
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function update()
    {
        $data = $this->validate();

        dd($data);

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
        return view('livewire.admin.plan.edit')
            ->layout('layouts.app');
    }
}

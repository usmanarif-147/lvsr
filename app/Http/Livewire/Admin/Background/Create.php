<?php

namespace App\Http\Livewire\Admin\Background;

use App\Models\BackgroundColor;
use Livewire\Component;


class Create extends Component
{

    protected $listeners = ['colorInfo'];

    public $heading, $isDisabled;

    public
        $color,
        $name,
        $color_code,
        $type;

    protected function rules()
    {
        return [
            'color'                 =>        ['sometimes'],
            'name'                  =>        ['sometimes'],
            'color_code'            =>        ['sometimes'],
            'type'                  =>        ['required', 'not_in:0'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function selectColor($data)
    {
        $this->isDisabled = 1;
        $this->dispatchBrowserEvent('color-info', [
            'color' => $data
        ]);
    }

    public function colorInfo($data)
    {
        $this->color_code = $data[0];
        $this->name = $data[1];
        $this->isDisabled = 0;
    }

    public function store()
    {
        $data = $this->validate();

        unset($data['color']);
        $data['name'] = $this->name;
        $data['color_code'] = $this->color_code;

        // dd($data);

        BackgroundColor::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Background Color created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.background.create')
            ->layout('layouts.app');
    }
}

<?php

namespace App\Http\Livewire\Admin\Background;

use App\Models\BackgroundColor;
use Livewire\Component;

class Edit extends Component
{

    protected $listeners = ['colorInfo'];

    public $heading, $isDisabled = 0;

    public
        $bgColorId,
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

    public function mount($id)
    {
        $this->bgColorId = $id;
        $backgroundColor = BackgroundColor::where('id', $id)->first();
        if ($backgroundColor) {
            $this->color = strtolower($backgroundColor->color_code);
            $this->name = $backgroundColor->name;
            $this->color_code = $backgroundColor->color_code;
            $this->type = $backgroundColor->type;
        } else {
            abort(404);
        }
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

    public function update()
    {
        $data = $this->validate();

        unset($data['color']);
        $data['name'] = $this->name;
        $data['color_code'] = $this->color_code;

        BackgroundColor::where('id', $this->bgColorId)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Background Color updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Update';
        return view('livewire.admin.background.edit')
            ->layout('layouts.app');
    }
}

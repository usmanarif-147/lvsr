<?php

namespace App\Http\Livewire\Admin\Font;

use App\Models\ButtonColor;
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
        $buttonColor = ButtonColor::where('id', $id)->first();
        if ($buttonColor) {
            $this->color = strtolower($buttonColor->color_code);
            $this->name = $buttonColor->name;
            $this->color_code = $buttonColor->color_code;
            $this->type = $buttonColor->type;
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

        ButtonColor::where('id', $this->bgColorId)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Button Color updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Update';
        return view('livewire.admin.font.edit')
            ->layout('layouts.app');
    }
}

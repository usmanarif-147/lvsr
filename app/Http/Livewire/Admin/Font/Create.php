<?php

namespace App\Http\Livewire\Admin\Font;

use App\Models\ButtonColor;
use App\Models\FontStyle;
use Livewire\Component;

class Create extends Component
{

    public $heading, $isDisabled, $styles;

    public
        $name,
        $font_style,
        $type;

    protected function rules()
    {
        return [
            'font_style'            =>        ['required'],
            'type'                  =>        ['required', 'not_in:0'],
        ];
    }

    public function mount()
    {
        $this->styles =
            [
                "0" => "Select Style",
                "Montez" => "Montez",
                "Lobster" => "Lobster",
                "Josefin Sans" => "Josefin Sans",
                "Shadows Into Light" => "Shadows Into Light",
                "Pacifico" => "Pacifico",
                "Amatic SC" => "Amatic SC",
            ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();
        $data['name'] = $this->font_style;

        FontStyle::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Font Style created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.font.create')
            ->layout('layouts.app');
    }
}

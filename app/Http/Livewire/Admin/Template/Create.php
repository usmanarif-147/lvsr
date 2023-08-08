<?php

namespace App\Http\Livewire\Admin\Template;

use App\Models\Template;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $types, $heading;

    public
        $image,
        $type;

    protected function rules()
    {
        return [
            'image'                  =>        ['required', 'mimes:jpeg,jpg,png', 'max:2048'],
            'type'                   =>        ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount()
    {
        $this->types = [
            '1' => 'Free',
            '2' => 'Pro',
        ];
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->image) {
            $image = $this->image;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['image'] = 'uploads/' . $imageName;
        }


        Template::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Template created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.template.create')
            ->layout('layouts.app');
    }
}

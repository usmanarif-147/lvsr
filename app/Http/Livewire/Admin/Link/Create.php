<?php

namespace App\Http\Livewire\Admin\Link;

use App\Models\Link;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $heading;

    public
        $label,
        $icon;

    protected function rules()
    {
        return [
            'label'                  =>        ['required'],
            'icon'                   =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function store()
    {
        $data = $this->validate();

        if ($this->icon) {
            $image = $this->icon;
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['icon'] = 'uploads/' . $imageName;
        }

        Link::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Link created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.link.create')
            ->layout('layouts.app');
    }
}

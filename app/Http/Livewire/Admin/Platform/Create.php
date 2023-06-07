<?php

namespace App\Http\Livewire\Admin\Platform;

use App\Models\Platform;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{

    use WithFileUploads;

    public $heading;

    public
        $title,
        $icon,
        $placeholder_en,
        $placeholder_fr,
        $placeholder_sp,
        $description_en,
        $description_fr,
        $description_sp,
        $base_url;

    protected function rules()
    {
        return [
            'title'                  =>        ['required'],
            'icon'                   =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'placeholder_en'         =>        ['sometimes'],
            'placeholder_fr'         =>        ['sometimes'],
            'placeholder_sp'         =>        ['sometimes'],
            'description_en'         =>        ['sometimes'],
            'description_fr'         =>        ['sometimes'],
            'description_sp'         =>        ['sometimes'],
            'base_url'               =>        ['sometimes'],
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


        Platform::create($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Platform created successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = 'Create';
        return view('livewire.admin.platform.create')
            ->layout('layouts.app');
    }
}

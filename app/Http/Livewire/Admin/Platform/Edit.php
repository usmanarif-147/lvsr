<?php

namespace App\Http\Livewire\Admin\Platform;

use App\Models\Platform;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $heading, $platform_id, $icon_preview = null;

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
        // return [
        //     'title'                  =>        ['required'],
        //     'icon'                   =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2000'],
        //     // 'pro'                    =>        ['required'],
        //     'status'                 =>        ['required'],
        //     'placeholder_en'         =>        ['sometimes'],
        //     'placeholder_sv'         =>        ['sometimes'],
        //     'description_en'         =>        ['sometimes'],
        //     'description_sv'         =>        ['sometimes'],
        //     'baseURL'                =>        ['sometimes'],
        //     // 'input'                  =>        ['required'],
        // ];

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

    public function mount($id)
    {
        $this->platform_id = $id;
        $platform = Platform::where('id', $id)->first();

        $this->title = $platform->title;
        $this->icon_preview = $platform->icon;
        // $this->pro = $platform->pro;
        // $this->status = $platform->status;
        $this->placeholder_en = $platform->placeholder_en;
        $this->placeholder_fr = $platform->placeholder_fr;
        $this->placeholder_sp = $platform->placeholder_sp;
        $this->description_en = $platform->description_en;
        $this->description_fr = $platform->description_fr;
        $this->description_sp = $platform->description_sp;
        $this->base_url = $platform->base_url;
        // $this->input = $platform->input;
    }

    public function deleteImage($image)
    {
        if ($image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
        $this->icon_preview = null;
        Platform::where('id', $this->platform_id)->update([
            'icon' => null
        ]);
    }

    public function update()
    {
        $data = $this->validate();
        // dd($data);

        if (!$data['icon']) {
            $data['icon'] = $this->icon_preview;
        } else {
            $image = $data['icon'];
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['icon'] = 'uploads/' . $imageName;
            if ($this->icon_preview) {
                if (Storage::exists('public/' . $this->icon_preview)) {
                    Storage::delete('public/' . $this->icon_preview);
                }
            }
        }

        Platform::where('id', $this->platform_id)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Platform updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = "Edit";
        return view('livewire.admin.platform.edit')
            ->layout('layouts.app');
    }
}

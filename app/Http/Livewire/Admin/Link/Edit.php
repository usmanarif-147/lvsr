<?php

namespace App\Http\Livewire\Admin\Link;

use App\Models\Link;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $heading, $link_id, $icon_preview = null;

    public
        $label,
        $status,
        $icon;

    protected function rules()
    {
        return [
            'label'                  =>        ['required'],
            'icon'                   =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2000'],
            'status'                 =>        ['sometimes'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount($id)
    {
        $this->link_id = $id;
        $link = Link::where('id', $id)->first();

        $this->label = $link->label;
        $this->icon_preview = $link->icon;
        $this->status = $link->status;
    }

    public function deleteImage($image)
    {
        if ($image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
        $this->icon_preview = null;
        Link::where('id', $this->link_id)->update([
            'icon' => null
        ]);
    }

    public function update()
    {
        $data = $this->validate();

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

        Link::where('id', $this->link_id)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Link updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = "Edit";
        return view('livewire.admin.link.edit')
            ->layout('layouts.app');
    }
}

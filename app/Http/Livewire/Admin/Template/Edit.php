<?php

namespace App\Http\Livewire\Admin\Template;

use App\Models\Template;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $types, $heading, $template_id, $image_preview = null;

    public
        $image,
        $type;

    protected function rules()
    {

        return [
            'image'                  =>        ['nullable', 'mimes:jpeg,jpg,png', 'max:2048'],
            'type'                   =>        ['nullable'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount($id)
    {

        $this->types = [
            '1' => 'Free',
            '2' => 'Pro',
        ];

        $this->template_id = $id;
        $template = Template::where('id', $id)->first();

        $this->image_preview = $template->image;
        $this->type = $template->type;
    }

    public function deleteImage($image)
    {
        if ($image) {
            if (Storage::exists('public/' . $image)) {
                Storage::delete('public/' . $image);
            }
        }
        $this->image_preview = null;
        Template::where('id', $this->template_id)->update([
            'image' => null
        ]);
    }

    public function update()
    {
        $data = $this->validate();

        if (!$data['image']) {
            $data['image'] = $this->image_preview;
        } else {
            $image = $data['image'];
            $imageName = time() . '.' . $image->extension();
            $image->storeAs('public/uploads', $imageName);
            $data['image'] = 'uploads/' . $imageName;
            if ($this->image_preview) {
                if (Storage::exists('public/' . $this->image_preview)) {
                    Storage::delete('public/' . $this->image_preview);
                }
            }
        }

        Template::where('id', $this->template_id)->update($data);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Template updated successfully!',
        ]);
    }

    public function render()
    {
        $this->heading = "Edit";
        return view('livewire.admin.template.edit')
            ->layout('layouts.app');
    }
}

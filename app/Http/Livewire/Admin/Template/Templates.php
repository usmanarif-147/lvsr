<?php

namespace App\Http\Livewire\Admin\Template;

use App\Models\Template;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Templates extends Component
{
    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $template_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $filterByStatus = '', $sortBy = '';

    public $templates, $total, $heading, $statuses = [];

    public function mount()
    {

        $this->statuses = [
            '1' => 'Active',
            '2' => 'Inactive',
        ];
    }

    public function updatedSearchQuery()
    {
        $this->resetPage();
    }
    public function updatedSortBy()
    {
        $this->resetPage();
    }

    /**
     * Activate
     */
    public function activateConfirmModal($id)
    {
        $this->template_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate template!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $template = Template::where('id', $this->template_id);
        $template->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Template activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->template_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate template!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $template = Template::where('id', $this->template_id);
        $template->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Template deactivated successfully',
        ]);
    }

    /**
     * Close Modal
     */
    public function closeModal()
    {
        $this->dispatchBrowserEvent('close-modal');
    }


    public function getFilteredData()
    {
        $filteredData = Template::select(
            'templates.id',
            'templates.image',
            'templates.type',
            'templates.status',
            'templates.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 2) {
                    $query->where('templates.status', 0);
                }
                if ($this->filterByStatus == 1) {
                    $query->where('templates.status', 1);
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy == 'created_asc') {
                    $query->orderBy('created_at', 'asc');
                }
                if ($this->sortBy == 'created_desc') {
                    $query->orderBy('created_at', 'desc');
                }
            })
            ->orderBy('templates.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Templates";
        $this->templates = $data->paginate(10);

        $this->total = $this->templates->total();

        $this->templates = ['templates' => $this->templates];

        return view('livewire.admin.template.templates')
            ->layout('layouts.app');
    }
}

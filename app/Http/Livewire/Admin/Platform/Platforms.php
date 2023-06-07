<?php

namespace App\Http\Livewire\Admin\Platform;

use App\Models\Platform;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Platforms extends Component
{

    use WithFileUploads, WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $platform_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $searchQuery = '', $filterByStatus = '', $sortBy = '';

    public $platforms, $total, $heading, $statuses = [];

    public function mount()
    {
        $this->statuses = [
            '1' => 'Active',
            '2' => 'Inactive',
        ];
    }

    public function updatedFilterByStatus()
    {
        $this->resetPage();
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
        $this->platform_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate platform!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $platform = Platform::where('id', $this->platform_id);
        $platform->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Platform activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->platform_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate platform!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $platform = Platform::where('id', $this->platform_id);
        $platform->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Platform deactivated successfully',
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
        $filteredData = Platform::select(
            'platforms.id',
            'platforms.title',
            'platforms.icon',
            'platforms.status',
            'platforms.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 2) {
                    $query->where('platforms.status', 0);
                }
                if ($this->filterByStatus == 1) {
                    $query->where('platforms.status', 1);
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
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('platforms.title', 'like', "%$this->searchQuery%");
                });
            })
            ->orderBy('platforms.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {

        $data = $this->getFilteredData();

        $this->heading = "Platforms";
        $this->platforms = $data->paginate(10);

        $this->total = $this->platforms->total();

        $this->platforms = ['platforms' => $this->platforms];

        return view('livewire.admin.platform.platforms')
            ->layout('layouts.app');
    }
}

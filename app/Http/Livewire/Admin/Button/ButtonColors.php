<?php

namespace App\Http\Livewire\Admin\Button;

use App\Models\ButtonColor;
use Livewire\Component;
use Livewire\WithPagination;

class ButtonColors extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $button_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $searchQuery = '', $filterByStatus = '', $filterByType = '', $sortBy = '';

    public $buttonColors, $total, $heading, $statuses = [];

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
    public function updatedFilterByType()
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
        $this->button_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate this Button Color!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $button = ButtonColor::where('id', $this->button_id);
        $button->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Button Color activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->button_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate Button Color!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $button = ButtonColor::where('id', $this->button_id);
        $button->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Button Color deactivated successfully',
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
        $filteredData = ButtonColor::select(
            'button_colors.id',
            'button_colors.name',
            'button_colors.color_code',
            'button_colors.status',
            'button_colors.type',
            'button_colors.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('button_colors.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('button_colors.status', 0);
                }
            })
            ->when($this->filterByType, function ($query) {
                if ($this->filterByType == 1) {
                    $query->where('button_colors.type', 1);
                }
                if ($this->filterByType == 2) {
                    $query->where('button_colors.type', 2);
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy == 'created_asc') {
                    $query->orderBy('button_colors.created_at', 'asc');
                }
                if ($this->sortBy == 'created_desc') {
                    $query->orderBy('button_colors.created_at', 'desc');
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('button_colors.name', 'like', "%$this->searchQuery%")
                        ->orWhere('button_colors.color_code', 'like', "%$this->searchQuery%");
                });
            })
            ->orderBy('button_colors.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {
        $data = $this->getFilteredData();

        $this->heading = "Button Colors";
        $this->buttonColors = $data->paginate(10);

        $this->total = $this->buttonColors->total();

        $this->buttonColors = ['buttonColors' => $this->buttonColors];

        return view('livewire.admin.button.button-colors')
            ->layout('layouts.app');
    }
}

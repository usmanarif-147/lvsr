<?php

namespace App\Http\Livewire\Admin\Background;

use App\Models\BackgroundColor;
use Livewire\Component;
use Livewire\WithPagination;


class BackgroundColors extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $background_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $searchQuery = '', $filterByStatus = '', $filterByType = '', $sortBy = '';

    public $backgroundColors, $total, $heading, $statuses = [];

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
        $this->background_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate this background color!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $background = BackgroundColor::where('id', $this->background_id);
        $background->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Background Color activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->background_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate background color!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $background = BackgroundColor::where('id', $this->background_id);
        $background->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Background color deactivated successfully',
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
        $filteredData = BackgroundColor::select(
            'background_colors.id',
            'background_colors.name',
            'background_colors.color_code',
            'background_colors.status',
            'background_colors.type',
            'background_colors.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('background_colors.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('background_colors.status', 0);
                }
            })
            ->when($this->filterByType, function ($query) {
                if ($this->filterByType == 1) {
                    $query->where('background_colors.type', 1);
                }
                if ($this->filterByType == 2) {
                    $query->where('background_colors.type', 2);
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy == 'created_asc') {
                    $query->orderBy('background_colors.created_at', 'asc');
                }
                if ($this->sortBy == 'created_desc') {
                    $query->orderBy('background_colors.created_at', 'desc');
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('background_colors.name', 'like', "%$this->searchQuery%")
                        ->orWhere('background_colors.color_code', 'like', "%$this->searchQuery%");
                });
            })
            ->orderBy('background_colors.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {
        $data = $this->getFilteredData();

        $this->heading = "Background Colors";
        $this->backgroundColors = $data->paginate(10);

        $this->total = $this->backgroundColors->total();

        $this->backgroundColors = ['backgroundColors' => $this->backgroundColors];

        return view('livewire.admin.background.background-colors')
            ->layout('layouts.app');
    }
}

<?php

namespace App\Http\Livewire\Admin\Plan;

use App\Models\Plan;
use Livewire\Component;
use Livewire\WithPagination;

class Plans extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $plan_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $searchQuery = '', $filterByStatus = '', $filterByType = '', $sortBy = '';

    public $plans, $total, $heading, $statuses = [];

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
     * Delete
     */
    public function deleteConfirmModal($id)
    {
        $this->plan_id = $id;
        $this->methodType = 'delete';
        $this->modalActionBtnText = 'Delete';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to delete Plan!';
        $this->dispatchBrowserEvent('confirm-modal');
    }

    /**
     * Activate
     */
    public function activateConfirmModal($id)
    {
        $this->plan_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate Plan!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $background = Plan::where('id', $this->plan_id);
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
        $this->plan_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate background color!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $background = Plan::where('id', $this->plan_id);
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
        $filteredData = Plan::select(
            'plans.id',
            'plans.title',
            'plans.amount',
            'plans.status',
            'plans.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('plans.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('plans.status', 0);
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy == 'created_asc') {
                    $query->orderBy('plans.created_at', 'asc');
                }
                if ($this->sortBy == 'created_desc') {
                    $query->orderBy('plans.created_at', 'desc');
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('plans.name', 'like', "%$this->searchQuery%")
                        ->orWhere('plans.title', 'like', "%$this->searchQuery%");
                });
            })
            ->orderBy('plans.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {
        $data = $this->getFilteredData();

        $this->heading = "Plans";
        $this->plans = $data->paginate(10);


        $this->total = $this->plans->total();

        $this->plans = ['plans' => $this->plans];

        return view('livewire.admin.plan.plans')
            ->layout('layouts.app');
    }
}

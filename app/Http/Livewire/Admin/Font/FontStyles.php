<?php

namespace App\Http\Livewire\Admin\Font;

use App\Models\FontStyle;
use Livewire\Component;
use Livewire\WithPagination;

class FontStyles extends Component
{

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $font_id, $methodType, $modalTitle, $modalBody, $modalActionBtnColor, $modalActionBtnText;

    // filter valriables
    public $searchQuery = '', $filterByStatus = '', $filterByType = '', $sortBy = '';

    public $fontStyles, $total, $heading, $statuses = [];

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
        $this->font_id = $id;
        $this->methodType = 'activate';
        $this->modalActionBtnText = 'Activate';
        $this->modalActionBtnColor = 'bg-success';
        $this->modalBody = 'You want to activate this Font Style!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function activate()
    {
        $font = FontStyle::where('id', $this->font_id);
        $font->update([
            'status' => 1,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Font Style activated successfully',
        ]);
    }

    /**
     * Deactivate
     */
    public function deactivateConfirmModal($id)
    {
        $this->font_id = $id;
        $this->methodType = 'deactivate';
        $this->modalActionBtnText = 'Deactivate';
        $this->modalActionBtnColor = 'bg-danger';
        $this->modalBody = 'You want to deactivate Font Style!';
        $this->dispatchBrowserEvent('confirm-modal');
    }
    public function deactivate()
    {
        $font = FontStyle::where('id', $this->font_id);
        $font->update([
            'status' => 0,
        ]);

        $this->methodType = '';
        $this->modalActionBtnText = '';
        $this->modalActionBtnColor = '';
        $this->modalBody = '';

        $this->dispatchBrowserEvent('close-modal');
        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'message' => 'Font Style deactivated successfully',
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
        $filteredData = FontStyle::select(
            'font_styles.id',
            'font_styles.name',
            'font_styles.font_style',
            'font_styles.status',
            'font_styles.type',
            'font_styles.created_at',
        )
            ->when($this->filterByStatus, function ($query) {
                if ($this->filterByStatus == 1) {
                    $query->where('font_styles.status', 1);
                }
                if ($this->filterByStatus == 2) {
                    $query->where('font_styles.status', 0);
                }
            })
            ->when($this->filterByType, function ($query) {
                if ($this->filterByType == 1) {
                    $query->where('font_styles.type', 1);
                }
                if ($this->filterByType == 2) {
                    $query->where('font_styles.type', 2);
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy == 'created_asc') {
                    $query->orderBy('font_styles.created_at', 'asc');
                }
                if ($this->sortBy == 'created_desc') {
                    $query->orderBy('font_styles.created_at', 'desc');
                }
            })
            ->when($this->searchQuery, function ($query) {
                $query->where(function ($query) {
                    $query->where('font_styles.font_style', 'like', "%$this->searchQuery%")
                        ->orWhere('font_styles.color_code', 'like', "%$this->searchQuery%");
                });
            })
            ->orderBy('font_styles.created_at', 'desc');

        return $filteredData;
    }

    public function render()
    {
        $data = $this->getFilteredData();

        $this->heading = "Font Styles";
        $this->fontStyles = $data->paginate(10);

        $this->total = $this->fontStyles->total();

        $this->fontStyles = ['fontStyles' => $this->fontStyles];

        return view('livewire.admin.font.font-styles')
            ->layout('layouts.app');
    }
}

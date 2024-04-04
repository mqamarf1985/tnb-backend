<?php

namespace App\Livewire;

use App\Models\ContractTwo;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsTableTwo extends Component
{
    use WithPagination;
//    protected $paginationTheme = 'bootstrap';

    public $selectedText;
    public $modalTitle;
    public $showApproved2 = false;
    public $showRejected2 = false;
    public $showNull2 = false;
    public bool $myModal2 = false;
    public function updated($propertyName)
    {
        $this->render();
    }

    public function uncheckAllFilters()
    {
        $this->showApproved2 = false;
        $this->showRejected2 = false;
        $this->showNull2 = false;
    }
    public function getFilteredContractsProperty()
    {
        $query = ContractTwo::query();

        if ($this->showApproved2) {
            $query->orWhere('status', 1);
        }

        if ($this->showRejected2) {
            $query->orWhere('status', 0);
        }

        if ($this->showNull2) {
            $query->orWhereNull('status');
        }

        return $query->orderBy('created_at','desc')->paginate(10);
    }

    public function loadText($title, $reference)
    {
        $contract  = ContractTwo::where('reference', $reference)->first();
//        dd($contract);
        if($title === "Description"){
            $text = $contract->description;
        }else{
            $text = $contract->complaintProcedure;
        }
        $this->modalTitle = $title;
        $this->selectedText = $text;
        $this->myModal2 = true;
//        $this->dispatch('modal-open');
    }

    public function changeStatus($contractId, $status)
    {
        $contract = ContractTwo::find($contractId);
        $contract->status = $status;
        $contract->save();

// Refresh the component to show updated status
        $this->contracts = $this->filteredContracts;
    }

    public function render()
    {
        return view('livewire.contracts-table-two',['contracts2' => $this->filteredContracts]);
    }
}

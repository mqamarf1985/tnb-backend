<?php

namespace App\Livewire;

use App\Models\ContractThree;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsTableThree extends Component
{
    use WithPagination;

    public $selectedText;
    public $modalTitle;
    public $showApproved3 = false;
    public $showRejected3 = false;
    public $showNull3 = false;
    public bool $myModal3 = false;

public function updated($propertyName)
{
    $this->render();
}

    public function uncheckAllFilters()
    {
        $this->showApproved3 = false;
        $this->showRejected3 = false;
        $this->showNull3 = false;
    }
    public function getFilteredContractsProperty()
    {
        $query = ContractThree::query();

        if ($this->showApproved3) {
            $query->orWhere('status', 1);
        }

        if ($this->showRejected3) {
            $query->orWhere('status', 0);
        }

        if ($this->showNull3) {
            $query->orWhereNull('status');
        }

        return $query->orderBy('created_at','desc')->paginate(10);
    }

    public function loadText($title, $reference)
    {
        $contract  = ContractThree::where('contract_id', $reference)->first();
//        dd($contract);
        if($title === "Bid Description"){
            $text = $contract->bid_description;
        }else{
            $text = $contract->complaintProcedure;
        }
        $this->modalTitle = $title;
        $this->selectedText = $text;
        $this->myModal3 = true;
//        $this->dispatch('modal-open');
    }

    public function changeStatus($contractId, $status)
    {
        $contract = ContractThree::where('contract_id',$contractId)->first();
        $contract->status = $status;
        $contract->save();

// Refresh the component to show updated status
        $this->contracts = $this->filteredContracts;
    }

    public function render()
    {
        return view('livewire.contracts-table-three',['contracts3' => $this->filteredContracts]);
    }
}

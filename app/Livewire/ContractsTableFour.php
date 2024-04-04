<?php

namespace App\Livewire;

use App\Models\ContractFour;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsTableFour extends Component
{
    use WithPagination;

    public $selectedText;
    public $modalTitle;
    public $showApproved4 = false;
    public $showRejected4 = false;
    public $showNull4 = false;
    public bool $myModal4 = false;

    public function updated($propertyName)
    {
        $this->render();
    }

    public function uncheckAllFilters()
    {
        $this->showApproved4 = false;
        $this->showRejected4 = false;
        $this->showNull4 = false;
    }
    public function getFilteredContractsProperty()
    {
        $query = ContractFour::query();

        if ($this->showApproved4) {
            $query->orWhere('status', 1);
        }

        if ($this->showRejected4) {
            $query->orWhere('status', 0);
        }

        if ($this->showNull4) {
            $query->orWhereNull('status');
        }

        return $query->orderBy('created_at','desc')->paginate(10);
    }

    public function loadText($title, $reference)
    {
        $contract  = ContractFour::where('id', $reference)->first();
//        dd($contract);
        if($title === "Detail Text"){
            $text = $contract->detail_text;
        }else{
            $text = $contract->detail_text;
        }
        $this->modalTitle = $title;
        $this->selectedText = $text;
        $this->myModal4 = true;
//        $this->dispatch('modal-open');
    }

    public function changeStatus($contractId, $status)
    {
        $contract = ContractFour::where('id',$contractId)->first();
        $contract->status = $status;
        $contract->save();

// Refresh the component to show updated status
        $this->contracts = $this->filteredContracts;
    }

    public function render()
    {
        return view('livewire.contracts-table-four',['contracts4' => $this->filteredContracts]);
    }
}

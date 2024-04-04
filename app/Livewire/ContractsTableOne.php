<?php

namespace App\Livewire;

use App\Models\ContractOne;
use Livewire\Component;
use Livewire\WithPagination;

class ContractsTableOne extends Component
{
    use WithPagination;
//    protected $paginationTheme = 'bootstrap';
//    public $contracts;

    public $selectedText;
    public $modalTitle;
    public $showApproved = false;
    public $showRejected = false;
    public $showNull = false;

    public bool $myModal1 = false;

    public function updated($propertyName)
    {
        $this->render();
    }

    public function uncheckAllFilters()
    {
        $this->showApproved = false;
        $this->showRejected = false;
        $this->showNull = false;
    }
    protected $listeners = [
        'myModal1' => 'show'
    ];

    public function getFilteredContractsProperty()
    {
        $query = ContractOne::query();

        if ($this->showApproved) {
            $query->orWhere('status', 1);
        }

        if ($this->showRejected) {
            $query->orWhere('status', 0);
        }

        if ($this->showNull) {
            $query->orWhereNull('status');
        }

        return $query->orderBy('created_at','desc')->paginate(10);
    }

   public function loadText($title, $contractID)
    {
        $contract = ContractOne::where('contract_id', $contractID)->first();
//        dd($contractID, $contract);
        if ($title === "Description") {
            $text = $contract->description;
        } else {
            $text = $contract->complaintProcedure;
        }
        $this->modalTitle = $title;
        $this->selectedText = $text;
        $this->myModal1 = true;
    }

    public function changeStatus($contractId, $status)
    {
//        dd($contractId,$status);
        $contract = ContractOne::find($contractId);
        $contract->status = $status;
        $contract->save();
//        dd($contract);

// Refresh the component to show updated status
//        $this->contracts = ContractOne::all();
        $this->contracts = $this->filteredContracts;
    }

    public function render()
    {
//        $this->contracts = $this->filteredContracts;
        return view('livewire.contracts-table-one',['contracts' => $this->filteredContracts]);
    }
}

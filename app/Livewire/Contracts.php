<?php

namespace App\Livewire;

use Illuminate\Support\HtmlString;
use Livewire\Component;

class Contracts extends Component
{
    public $contracts;

    public $selectedText;
    public $modalTitle;


    public function mount()
    {
        $this->contracts = \App\Models\Contracts::all();
    }

    public function loadText($title, $contractID)
    {
        $contract  = \App\Models\Contracts::where('contract_id', $contractID)->first();
        if($title === "Description"){
            $text = $contract->description;
        }else{
            $text = $contract->complaintProcedure;
        }
        $this->modalTitle = $title;
        $this->selectedText = $text;
        $this->dispatch('modal-open');
    }

    public function changeStatus($contractId, $newStatus)
    {
        $contract = Contracts::find($contractId);
        $contract->status = $newStatus;
        $contract->save();

// Refresh the contracts list
        $this->contracts = Contracts::all();
    }

    public function render()
    {
        return view('livewire.contracts')->layout('components.layouts.app');
    }
}

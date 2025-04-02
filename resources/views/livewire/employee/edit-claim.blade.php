<?php

use App\Models\Claim;
use Livewire\Volt\Component;

new class extends Component {

    public $claimid;
    public $claim_type;
    public $date;
    public $amount_requested;
    public $notes;
    public $receipt;

    public function submit()
    {
        $updatedData = $this->validate([
            'claim_type' => ['required'],
            'date' => ['required', 'date'],
            'amount_requested' => ['required', 'numeric'],
            'notes' => ['required', 'min:5'],
        ]);

        $claim = Claim::findOrFail($this->claimid);
        $claim->update($updatedData);
        $this->dispatch('success-notif');
        
    }
    
    
}; ?>

<div class="space-y-2">
    <x-notification on="success-notif" >
        <x-alert title="Claim Submitted" positive solid />
    </x-notification>
    
    <div class="text-lg">Edit Claim</div>
    <form class="space-y-5" wire:submit='submit'>
        <div class="">
            <div class="grid grid-cols-2 gap-4">
                <x-native-select
                label="Claim Type"
                wire:model='claim_type'
                placeholder="Select Type"
                :options="['Medical', 'Transportation', 'Meal', 'Miscellaneous']"
             />
                <x-input type="date" label="Date" wire:model="date" />
                
            </div>
            <div>
                <x-input label="Amount Requested" wire:model="amount_requested" />
                <x-textarea label="Notes" wire:model="notes" />
            </div>
        </div>
        <x-button type="submit" label="Save" pink class="w-full" />
    </form>
</div>

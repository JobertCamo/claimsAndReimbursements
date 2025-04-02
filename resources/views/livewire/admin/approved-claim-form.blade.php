<?php

use App\Models\Claim;
use Livewire\Volt\Component;
use App\Models\ApprovedClaims;

new class extends Component {

    public $userid;
    public $id;
    public $name;
    public $notes;
    
    public function mount()
    {
        $claim = Claim::findOrFail($this->id);
        $this->name = $claim->user->name;
    }

    public function submit()
    {
        $claim = Claim::findOrFail($this->id);

        $claim->status = 'approved';
        $claim->save();

        ApprovedClaims::create([
            'user_id' => $this->userid,
            'claim_id' => $this->id,
            'approved_by' => Auth::user()->name,
            'approved_amount' => $claim->amount_requested,
        ]);

        $this->dispatch('success-notif');
        $this->redirect('/pending');
        
    }
    
}; ?>

<form class="space-y-4 " wire:submit='submit'>
    <x-notification on="success-notif" >
        <x-alert title="Claim Approved!" positive solid />
    </x-notification>
    {{-- <x-textarea wire:model='notes' label="Rejection Note" /> --}}
    <div class="flex justify-end items-center gap-4">
        <x-button @click="form = ' '" label="Cancel" white class=""/>
        <x-button type="submit" label="Submit" class=""/>
    </div>
</form>

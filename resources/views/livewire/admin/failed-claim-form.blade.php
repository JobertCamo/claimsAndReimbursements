<?php

use App\Models\Claim;
use App\Models\FailedClaim;
use App\Models\Notification;
use Livewire\Volt\Component;

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

        $claim->status = 'rejected';
        $claim->save();
        
        $data = $this->validate([
            'notes' => ['required','min:8']
        ]);
        
        FailedClaim::create([
            'user_id' => $this->userid,
            'claim_id' => $this->id,
            'notes' => $data['notes'],
            'rejected_by' => Auth::user()->name,
        ]);
        Notification::create([
            'title' => 'Rejected Claim',
            'details' => 'Please resubmit your '. ' ' . $claim->claim_type . ' ' . $claim->amount_requested . ' ' . 'claim to process it again.'
        ]);

        $this->dispatch('fail-notif');
        $this->redirect('/rejected');
    }
    
}; ?>

<form class="space-y-4" wire:submit='submit'>
    <x-notification on="fail-notif" >
        <x-alert title="Claim Submitted" negative solid />
    </x-notification>
    <x-textarea wire:model='notes' label="Rejection Note" />
    <x-button type="submit" label="Submit" class="w-full"/>
</form>

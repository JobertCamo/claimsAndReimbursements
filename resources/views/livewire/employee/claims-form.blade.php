<?php

use App\Models\User;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use App\Models\Claim;

new class extends Component {
  use WithFileUploads;

    public $name;
    public $department;
    public $email;
    public $claim_type;
    public $date;
    public $amount;
    public $notes;
    public $receipt;
    public $Agreement;

    public function mount()
    {
        $user = Auth::user();
        $this->department = $user->department;
        $this->email = $user->email;
        $this->name = $user->name;
    }
    
    public function submit()
{
    $validated = $this->validate([
        'name' => ['required'],
        'department' => ['required'],
        'email' => ['required', 'email', 'unique:claims,email'],
        'claim_type' => ['required'],
        'date' => ['required'],
        'amount' => ['required', 'numeric'],
        'notes' => ['required'],
        'Agreement' => ['required'],
        'receipt' => ['required', 'file', 'mimes:jpeg,png,jpg', 'max:10240'],
    ]);

    $validated['receipt'] = $this->receipt->store('claims', 'public');
    
    Auth::user()->claims()->create([
      'claim_type' => $validated['claim_type'],
      'date' => $validated['date'],
      'amount_requested' => $validated['amount'],
      'notes' => $validated['notes'],
      'receipt' => $validated['receipt'],
    ]);
    $this->dispatch('success-notif');
    
    $this->reset('claim_type', 'date', 'amount', 'notes', 'Agreement', 'receipt',);
    sleep(0);
    $this->redirect('/request', navigate: true);
}

   
    
}; ?>

<div class="py-2">
  <x-notification on="success-notif" >
    <x-alert title="Claim Submitted" positive solid />
  </x-notification>
  <div class="flex items-center justify-between gap-4">
    <div class="flex items-center gap-4">
      <x-icon name="information-circle" />
      <div>
      <h3 class="font-bold text-xs">Claims Form</h3>
      <p class="text-gray-500 text-xs">I confirm that the information provided is accurate and complete.</p>
      </div>
    </div>
    
  </div>
      <form wire:submit="submit" class="mt-2">
          <div class="space-y-2">
            {{-- <div class="grid grid-cols-2 gap-4">
              <x-input wire:model='name' readonly label="Name"/>
              <x-input label="Department" wire:model='department' readonly/>
            </div> --}}
            {{-- <div>
              <x-input wire:model="email" readonly label="Email"/>
            </div> --}}
            <div class="grid grid-cols-2 gap-4">
              <x-native-select
                label="Claim Type"
                wire:model='claim_type'
                placeholder="Select Type"
                :options="['Medical', 'Transportation', 'Meal', 'Miscellaneous']"
             />
              <x-input wire:model='date' type="date" label="Date"/>
            </div>
            <div>
              <x-input wire:model='amount' label="Amount Requested"/>
            </div>
            <div>
              <x-textarea wire:model='notes' label="Notes" placeholder="write your notes" />
            </div>
            <div>
              <x-input wire:model='receipt' type="file" label="Receipt"/>
            </div>
            <x-checkbox wire:model='Agreement' class="mr-4" label="Terms and Policy" />
            <x-button type="submit" label="Submit" />
            </div>
      </form>
</div>

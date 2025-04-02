<?php

use App\Models\Claim;
use Livewire\Volt\Component;
use Livewire\Attributes\Layout;

new #[layout('components.layout')]
 class extends Component {

    public $userid;
    public $name;
    public $claim_type;
    public $date;
    public $amount_requested;
    public $notes;
    public $receipt;
    public $id;

    public function mount(Claim $claim)
    {
        $this->userid = $claim->user->id;
        $this->name = $claim->user->name;
        $this->claim_type = $claim->claim_type;
        $this->date = $claim->date;
        $this->amount_requested = $claim->amount_requested;
        $this->notes = $claim->notes;
        $this->receipt = $claim->receipt;
        $this->id = $claim->id;
    }
    
}; ?>

<div class="bg-white border-[1px] border-gray-200 px-5 py-4 " x-data="{form: ''}">
    @slot('head1') Home @endslot
    @slot('head2') Claims and Reimbursements @endslot
    @slot('head3')  @endslot

    <div class="space-y-4">
        <div class="flex justify-between items-center ">
            <div class="font-bold text-xl lg:text-3xl">{{ $name }}</div>
            <div class="space-x-4 flex gap-4">
                <x-button @click="form = 'reject'" negative label="Reject" />
                <x-button @click="form = 'approve'" positive label="Approve" />
            </div>
        </div>
        <div class="text-xs lg:text-lg">Date Submitted: <span>{{ $date }}</span></div>
        <div class="text-sm">Claim Type: <span class="text-xl">{{ $claim_type }}</span></div>
        <div class="text-sm">Amount Requested: <span class="text-xl">PHP {{ $amount_requested }}</span></div>
        <div class="grid lg:grid-cols-2 space-y-4">
            <div class="  ">
                <h1>Claim Notes</h1>
                <div class="px-3 bg-gray-100 border-[1px] border-gray-300 w-full lg:w-96 h-[200px] p-3">{{ $notes }}</div>
            </div>
            <div class="mx-auto">
                <div>Receipt Proof</div>
                <img class="w-64" src="{{ Storage::url($receipt) }}" alt="">
            </div>
        </div>
        
    </div>
    <div x-show="form === 'reject'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 absolute top-0 left-0 z-50  justify-center items-center">
        <div  @click.away="form = ''" class="bg-white p-4 space-y-4 rounded-lg">
            <div class="text-2xl">Rejection</div>
            <livewire:admin.failed-claim-form :id="$id" :userid="$userid"/>
        </div>
    </div>
    <div x-show="form === 'approve'" x-cloak class="px-2 md:px-0 transition-all duration-300 flex h-screen w-full bg-black/20 absolute top-0 left-0 z-50  justify-center items-center">
        <div  @click.away="reject = false" class="bg-white p-4 space-y-4 rounded-lg">
            <div class="text-2xl">Approval Claim</div>
            <p class="text-center">Are you sure you want to approve this claim? <br> This action cannot be undone.</p>
            <livewire:admin.approved-claim-form :id="$id" :userid="$userid"/>
        </div>
    </div>
    
</div>

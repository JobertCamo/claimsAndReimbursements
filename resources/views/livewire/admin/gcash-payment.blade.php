<?php

use Livewire\Volt\Component;
use App\Models\ApprovedClaims;

new class extends Component {

    public $id;
    public $ids;
    public $amount;

    public function mount()
    {
        $claim = ApprovedClaims::findOrFail($this->id);
        $this->ids = $claim->id;
    }

    public function submit()
    {
        $claim = ApprovedClaims::findOrFail($this->ids);

        $claim->update([
            'payment_status' => 'paid'
        ]);
    }
    
}; ?>

<form wire:submit='submit' class="bg-white shadow-lg border border-gray-200 p-4 rounded-md min-w-[300px] space-y-4">
    <div>
        <div class="flex items-center gap-1">
            <x-icon name="currency-dollar" />
            <h2>Payment</h2>
        </div>
    </div>
    <x-input label="Amount to pay" readonly value="{{ $amount . $id}}" />
    <div class="flex justify-between items-center gap-2">
        <x-button class="w-full" @click="pay = ''" white>Close</x-button>
        <x-button type="submit" class="w-full" @click="pay = ''">Pay</x-button>
    </div>
</form>

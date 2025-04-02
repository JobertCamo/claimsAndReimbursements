<?php

use App\Models\Claim;
use Livewire\Volt\Component;
use App\Models\ApprovedClaims;

new class extends Component {

    public $q = '';
    
    public function getClaims()
    {
        // return Claim::query()
        //             ->where('status', 'approved')
        //             ->when($this->q, fn($query) => $query->where('claim_type', 'LIKE', '%' . $this->q . '%')->orWhere('amount_requested', 'LIKE', '%' . $this->q . '%'))
        //             ->latest()
        //             ->simplepaginate(10);
        return ApprovedClaims::query()
                    ->where('payment_status', 'pending')
                    ->when($this->q, fn($query) => $query->where('claim_type', 'LIKE', '%' . $this->q . '%')->orWhere('amount_requested', 'LIKE', '%' . $this->q . '%'))
                    ->latest()
                    ->simplepaginate(10);
    }

    public function with()
    {
        return [
            'claims' => $this->getClaims(),
        ];
    }
    
    
}; ?>

<div class="relative overflow-x-auto ">
    <div class="px-4 bg-white flex justify-between items-center">
        <div class="mb-4">
            <x-input placeholder="search something ex. firstname or lastname" icon="magnifying-glass" wire:model.live="q" />
        </div>
        {{-- <h1 class="text-xs lg:text-xl font-bold">Approved&nbsp;Claims</h1> --}}
        <div class="px-5 py-3 w-64 hidden lg:block">
            {{ $claims->links() }}
        </div>
    </div>
    <hr>
    <table id="claimsTable" class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-400 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">
                    Name
                </th>
                <th scope="col" class="px-3 py-3">
                    Claims Type
                </th>
                <th scope="col" class="px-3 py-3">
                    Amount
                </th>
                <th scope="col" class="px-3 py-3">
                    Status
                </th>
                <th scope="col" class="px-3 py-3">
                    Payment Status
                </th>
                @if (request()->is('payments'))
                <th scope="col" class="px-3 py-3">
                    Action
                </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($claims as $claim)
            <tr class="bg-white hover:bg-gray-300">
                <td scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    <a href="/employee-profile/{{ $claim->user->id }}" class="flex items-center gap-2">
                        <img class="w-7 h-7 rounded-full object-cover" src="{{ Storage::url($claim->user->profile_pic) }}" alt="">
                        <div class="font-bold">{{ $claim->user->name }}</div>
                    </a>
                </td>
                <td scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $claim->claim->claim_type }}
                </td>
                <td class="px-3 py-4">
                    {{ $claim->approved_amount }}
                </td>
                <td class="px-3 py-4">
                    <button class="bg-green-500 px-1 rounded-sm text-white">
                        {{ $claim->status }}
                    </button>
                </td>
                <td class="px-3 py-4">
                    <button class="bg-yellow-500 px-1 rounded-sm text-white">
                        Pending
                    </button>
                </td>
                @if (request()->is('payments'))
                <td class=" px-3 py-4" x-data="{ pay: '', selectedOption: '' }">
                    <!-- Pay Button -->
                    <button @click="pay = 'm1'">Pay</button>
                
                    <!-- First Modal (Payment Selection) -->
                    <div x-show="pay === 'm1'" x-cloak class="fixed inset-0 z-40 flex items-center justify-center bg-black/20 backdrop-blur-sm">
                        <div @click.away="pay = ''" class="bg-white shadow-lg border border-gray-200 p-4 rounded-md min-w-[300px]">
                            <form class="space-y-4">
                                <div>
                                    <div class="flex items-center gap-1">
                                        <x-icon name="currency-dollar" />
                                        <h2 class="text-xl">Payment {{ $claim->status }}</h2>
                                    </div>
                                    <p>How would you like to pay?</p>
                                </div>
                
                                <!-- Payment Options -->
                                <div class="grid gap-2">
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="radio" name="option" value="m2" x-model="selectedOption">
                                            <span>Gcash</span>
                                        </label>
                                        <img class="w-8 h-8" src="{{ asset('images/s.png') }}" alt="">
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <label class="flex items-center space-x-2 cursor-pointer">
                                            <input type="radio" name="option" value="m3" x-model="selectedOption">
                                            <span>PayPal</span>
                                        </label>
                                        <img class="w-8 h-8" src="{{ asset('images/p.png') }}" alt="">
                                    </div>
                                </div>
                
                                <!-- Continue Button -->
                                <x-button label="Continue" class="w-full"
                                    @click.prevent="if (selectedOption) pay = selectedOption" />
                            </form>
                        </div>
                    </div>
                
                    <!-- Gcash Payment Modal -->
                    <div x-show="pay === 'm2'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">
                        <livewire:admin.gcash-payment :amount="$claim->amount_requested" :id="$claim->id"/>
                    </div>
                
                    <!-- PayPal Payment Modal -->
                    <div x-show="pay === 'm3'" x-cloak class="fixed inset-0 z-50 flex items-center justify-center bg-black/20 backdrop-blur-sm">
                        <livewire:admin.gcash-payment :amount="$claim->amount_requested" :id="$claim->id"/>
                    </div>
                </td>
                
            </tr>
            @endif
            
            @empty
                
            @endforelse
        </tbody>
    </table>
    
    <div class="px-5 py-3 block lg:hidden">
        {{ $claims->links() }}
    </div>
</div>

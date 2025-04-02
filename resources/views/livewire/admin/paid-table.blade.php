<?php

use Livewire\Volt\Component;
use App\Models\ApprovedClaims;

new class extends Component {
    
    public $q = '';
    
    public function getClaims()
    {
        return ApprovedClaims::query()
                    ->where('payment_status', 'paid')
                    ->when($this->q, fn($query) => $query->where('approved_amount', 'LIKE', '%' . $this->q . '%')->orWhere('amount_requested', 'LIKE', '%' . $this->q . '%'))
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
            <x-input placeholder="search amount" icon="magnifying-glass" wire:model.live="q" />
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
                    Approved Date
                </th>
                <th scope="col" class="px-3 py-3">
                    Payment Status
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse ($claims as $claim)
            <tr class="bg-white hover:bg-gray-300">
                <td scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap ">
                    <a wire:navigate href="/employee-profile/{{ $claim->user->id }}" class="flex items-center gap-2">
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
                    {{ $claim->created_at->format('d M, Y') }}
                </td>
                <td class="px-3 py-4">
                    <button class="bg-green-500 px-1 rounded-sm text-white uppercase">
                        {{ $claim->payment_status }}
                    </button>
                </td>
                
            </tr>

            
            @empty
                
            @endforelse
        </tbody>
    </table>
    
    <div class="px-5 py-3 block lg:hidden">
        {{ $claims->links() }}
    </div>
</div>

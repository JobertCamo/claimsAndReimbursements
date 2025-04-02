<?php

use App\Models\Claim;
use Livewire\Volt\Component;

new class extends Component {

    public $q = '';
    
    public function getClaims()
    {
        return Claim::query()
                    ->where('status', 'pending')
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
    <div class="px-4 bg-white flex  justify-between items-center">
        <div class="mb-4">
            <x-input placeholder="search something ex. firstname or lastname" icon="magnifying-glass" wire:model.live="q" />
        </div>
        {{-- <h1 class="text-xs lg:text-xl font-bold">Pending&nbsp;Claims</h1> --}}
        <div class="px-5 py-3 w-64 hidden lg:block">
            {{ $claims->links() }}
        </div>
    </div>
    <hr>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
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
                    Date
                </th>
                <th scope="col" class="px-3 py-3">
                    Status
                </th>
                <th scope="col" class="px-3 py-3">
                    Action
                </th>
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
                <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $claim->claim_type }}
                </th>
                <td class="px-3 py-4">
                    {{ $claim->amount_requested }}
                </td>
                <td class="px-3 py-4">
                    {{ $claim->date }}
                </td>
                <td class="px-3 py-4 ">
                    <button class="bg-yellow-500 px-1 rounded-sm text-white">
                        {{ $claim->status }}
                    </button>
                </td>
                <td class="flex items-center px-3 py-4">
                    <a wire:navigate href="/view-claim/{{ $claim->id }}" class="font-medium text-blue-900  hover:underline ">View Claim</a>
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

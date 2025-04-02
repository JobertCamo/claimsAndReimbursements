<?php

use Livewire\Volt\Component;
use App\Models\ApprovedClaims;

new class extends Component {
    
    public $q = '';
    
    public function getClaims()
    {
        return ApprovedClaims::query()
                    ->where('user_id', Auth::user()->id)
                    ->when($this->q, fn($query) => $query->where('claim_type', 'LIKE', '%' . $this->q . '%')->orWhere('amount_requested', 'LIKE', '%' . $this->q . '%'))
                    ->latest()
                    ->paginate(10);
    }

    public function delete(Claim $claim)
    {
        $claim->delete();
        $this->redirect('dashboard', navigate: true);
        $this->dispatch('success');
    }

    

    public function with()
    {
        return [
          'claims' => $this->getClaims(),  
        ];
    }
    
}; ?>

<div class=" overflow-x-auto  ">
    <x-notification on="success" >
        <x-alert title="Claim Deleted" negative solid />
    </x-notification>
    <div class=" px-4  flex justify-between items-center">
        <div class="">
            <x-input placeholder="search something ex. firstname or lastname" icon="magnifying-glass" wire:model.live="q" />
        </div>
        <h1 class="text-xs lg:text-xl text-white">Claims & Reimbursement Lists</h1>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="border-b-[1px] border-gray-600 text-xs text-gray-400 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-3 py-3">
                    Claims Type
                </th>
                <th scope="col" class="px-3 py-3">
                    Approved Amount
                </th>
                <th scope="col" class="px-3 py-3">
                    Approved By
                </th>
                <th scope="col" class="px-3 py-3">
                    Status
                </th>
                <th scope="col" class="px-3 py-3">
                    Payment Status
                </th>
                {{-- <th scope="col" class="px-3 py-3">
                    Action
                </th> --}}
            </tr>
        </thead>
        <tbody>
            @forelse ($claims as $claim)
            <tr wire:key='{{ $claim->id }}' class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                <th scope="row" class="px-3 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $claim->claim->claim_type }}
                </th>
                <td class="px-3 py-4">
                    {{ $claim->approved_amount }}
                </td>
                <td class="px-3 py-4">
                    {{ $claim->approved_by }}
                </td>
                <td class="px-3 py-4">
                    <button class="bg-green-500 px-1 rounded-sm text-white">
                        {{ $claim->status }}
                    </button>
                </td>
                <td class="px-3 py-4">
                    <button class="{{ $claim->payment_status === 'paid' ? 'bg-green-500' : 'bg-yellow-500' }} px-1 rounded-sm text-white">
                        {{ $claim->payment_status }}
                    </button>
                </td>
                <td class="flex items-center px-3 py-4 gap-1" x-data="{del: false, edit: false}">
                    {{-- <a @click=" del = true "> <x-icon color="red"  name="trash" /> </a> --}}
                    {{-- <a @click=" edit = true "> <x-icon name="pencil-square" color="blue" /> </a> --}}

                    {{-- delete --}}
                    <div x-show="del" x-cloak class="h-screen w-full bg-black/20 fixed top-0 left-0 z-40 flex justify-center items-center backdrop-blur-sm" >
                        <div  class="bg-white shadow-lg border-[1px] border-gray-200 p-4 rounded-md transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
                            <div class="flex items-center gap-1">
                                <x-icon name="exclamation-triangle" class="w-12 h-12" color="red" />
                                <div>
                                    <h2 class="text-lg">Delete Claim</h2>
                                    <p>Are you sure you want to delete this?</p>
                                </div>
                            </div>
                            <div class="mt-10 text-right">
                                <x-button @click="del = false" label="Cancel" white />
                                <x-button @click="del = false" wire:click="delete({{ $claim->id }})" label="Confirm" rose />
                            </div>
                        </div>
                    </div>
                    {{-- delete --}}

                    {{-- edit --}}
                    {{-- <div x-show="edit" x-cloak class="h-screen w-full bg-black/20 fixed top-0 left-0 z-40 flex justify-center items-center backdrop-blur-sm">
                        <div @click.away="edit = false" class="bg-white shadow-lg border-[1px] border-gray-200 p-4 rounded-md">
                            <livewire:employee.edit-claim :claimid="$claim->id" :claim_type="$claim->claim_type" :date="$claim->date" :amount_requested="$claim->amount_requested" :notes="$claim->notes" :receipt="$claim->receipt" />
                        </div>
                    </div> --}}
                    {{-- edit --}}
                    
                </td>
            </tr>
            @empty
                
            @endforelse
        </tbody>
    </table>
    <div class="px-5 py-3">
        {{ $claims->links() }}
    </div>
</div>
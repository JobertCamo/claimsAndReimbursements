<?php

use Carbon\Carbon;
use App\Models\Claim;
use Livewire\Volt\Component;

new class extends Component {

    public function getClaims()
    {
        // return Claim::query()->latest()->limit(5)->get();
        return Claim::where('created_at', '>=', Carbon::now()->subDays(2))->latest()->limit(5)->get();
    }

    public function with()
    {
        return [
            'claims' => $this->getClaims()
        ];
    }
    
}; ?>

<div class="space-y-4">
    @forelse ($claims as $claim)
    <div class="grid grid-cols-2 px-4">
        <div class="flex items-center gap-3 text-start">
            @if ($claim->claim_type == 'Medical')
                <x-icon name="plus-circle" fill="green" class="w-9 h-9"/>
            @elseif ($claim->claim_type == 'Transportation')
                <x-icon name="map-pin" fill="red" class="w-9 h-9"/>
            @elseif($claim->claim_type == 'Meal')
                <x-icon name="cake" fill="orange" class="w-9 h-9"/>
            @elseif($claim->claim_type == 'Miscellaneous')
                <x-icon name="briefcase" fill="gold" class="w-9 h-9"/>
            @endif
            <div style="line-height: 1">
                <div class="text-md">{{ $claim->user->name }}</div>
                <p class="text-sm text-gray-500">Submitted Date {{ $claim->date }}</p>
            </div>
        </div>
        <div class="text-right">
          <div>{{ $claim->claim_type }} Claims</div>
          <p class="text-sm text-gray-500">Amount: {{ $claim->amount_requested }}</p>
        </div>
    </div>
    @empty
        
    @endforelse
  </div>

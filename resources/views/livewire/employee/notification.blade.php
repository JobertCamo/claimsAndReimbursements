<?php

use Carbon\Carbon;
use App\Models\Notification;
use Livewire\Volt\Component;

new class extends Component {
    
    public function with()
    {
        return [
            'notifs' => Notification::latest()->limit(5)->get(),
            'new' => Notification::where('created_at', '>=', Carbon::now()->subDays(1))->get(),
        ];
    }
    
}; ?>

<div>
    <button class="relative">
        @cannot('view-page')
        <x-icon name="bell-alert"  color="gray" @click="notif = true" />
        <div class="absolute top-0 right-6 text-red-500 font-bold">{{ count($new) }}</div>
        @endcannot
    </button>
    {{-- NOTIFICATION CONTAINER --}}
    <template x-if="true">
        <div x-show="notif" x-cloak @click.away="notif = false" x-transition class="overflow-auto space-y-2 p-3 absolute -bottom-80 lg:-bottom-73 -left-64 lg:-left-64  h-72 lg:h-80 w-72 lg:w-80 rounded-md bg-white shadow-lg">
            @forelse ($notifs as $notif)
            <div class="w-full h-16 bg-gray-100 border-[1px] border-gray-300 flex justify-center items-center gap-2 px-2" >
                <x-avatar sm src="https://avatarfiles.alphacoders.com/364/364538.png" />
                <div>
                    <div class="text-sm font-bold">{{ $notif->title }}</div>
                    <div class="text-[10px] lg:text-[11px]">{{ $notif->details }}</div>
                </div>
            </div>
            @empty
                
            @endforelse
        </div>
    </template>
</div>
<?php

use App\Models\User;
use App\Models\Claim;
use Livewire\Volt\Component;
use App\Models\ApprovedClaims;
use Livewire\Attributes\Layout;

new #[layout('components.layout')]
 class extends Component {

    public $name;
    public $email;
    public $department;
    public $role;
    public $profile;
    public $total;
    public $totalClaims;
    public $pendingClaims;

    public function mount(User $user)
    {
        $this->name = $user->name;
        $this->email = $user->email;
        $this->department = $user->department;
        $this->role = $user->role;
        $this->profile = $user->profile_pic;

        $this->total = $user->claims;

        $this->totalClaims = ApprovedClaims::where('user_id', $user->id)->where('payment_status','paid')->sum('approved_amount');

        $this->pendingClaims = Claim::query()->where('user_id', $user->id)->where('status', 'pending')->get();

    }
    
}; ?>

<div>
    @slot('head1') Home @endslot
    @slot('head2') Employee Profile @endslot
    @slot('head3')  @endslot
    <div class="grid lg:grid-cols-5 p-4 bg-white">
        <div class="col-span-2 ">
            <x-button icon="arrow-long-left" class="text-left" label="back" white />
            <div class="text-center flex flex-col items-center justify-center space-y-5">
                <img class="ring-2 ring-green-500 w-44 h-44 rounded-full object-cover shadow-xl" src="{{ Storage::url($profile) }}" alt="">
                <div class="text-left">
                    <h2 class="text-2xl">{{ $name }}</h2>
                    <p class="text-sm">Head Security {{ count($total) }}</p>
                </div>
                <div class="grid gap-3 text-2xl">
                    <button>Profile</button>
                </div>
            </div>
            
        </div>
        <div class="col-span-3 space-y-5">
            <div class="text-right text-2xl font-bold font-serif">C&R System</div>
            <div class="p-4 space-y-5">
                <div class="text-xl">Employee Information</div>
                <div class="space-y-5">
                    <div class="flex items-center gap-3 bg-[#f8fcfc] border-[1px] border-gray-300 p-2">
                        <x-icon name="users" color="Green"/>
                        <span>Sales Department</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[#f8fcfc] border-[1px] border-gray-300 p-2">
                        <x-icon name="user-circle" color="blue" />
                        <span>Employee Role</span>
                    </div>
                    <div class="flex items-center gap-3 bg-[#f8fcfc] border-[1px] border-gray-300 p-2">
                        <x-icon name="at-symbol" color="red" />
                        <span>{{ $email }}</span>
                    </div>
                </div>
                <div class="grid lg:grid-cols-3 gap-5">
                    <div class="rounded-lg px-3 py-2 bg-gradient-to-r from-fuchsia-600 to-purple-600 text-white">
                        <div class="text-xl">Total Claims</div>
                        <div class="text-right mt-3">{{ count($total) }}</div>
                    </div>
                    <div class="rounded-lg px-3 py-2 bg-gradient-to-r from-emerald-400 to-cyan-400 text-white">
                        <div class="text-xl">Paid Claims</div>
                        <div class="text-right mt-3">{{ $totalClaims }}</div>
                    </div>
                    <div class="rounded-lg px-3 py-2 bg-gradient-to-r from-indigo-400 to-cyan-400 text-white">
                        <div class="text-xl">Pending Claims</div>
                        <div class="text-right mt-3">{{ count($pendingClaims) }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php

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
    public $job_position;
    public $profile;
    public $total;
    public $totalClaims;
    public $pendingClaims;

    public function mount()
    {

        $user = Auth::user();
        
        $this->name = $user->name;
        $this->email = $user->email;
        $this->department = $user->department;
        $this->role = $user->role;
        $this->job_position = $user->job_position;
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
    <div class="grid lg:grid-cols-5 p-4 bg-white" x-data="{nav: 'profile', cprofile: false}">
        <div class="col-span-2">
            <x-button @click="cprofile = true" icon="photo" class="text-left" label="Change Profile" white />
            <div class="text-center flex flex-col items-center justify-center space-y-5 relative">
                <img class="hover:opacity-90 cursor-pointer ring-2 ring-green-500 w-44 h-44 rounded-full object-cover shadow-xl" src="{{ Storage::url($profile) }}" alt="">
                <div class="text-left">
                    <h2 class="text-2xl">{{ $name }}</h2>
                    <p class="text-sm">{{ $job_position }}</p>
                </div>
                <div class="grid gap-5 text-2xl">
                    <button @click="nav = 'profile'" :class="nav === 'profile' ? 'text-black ' : 'text-gray-400'" class="">Profile</button>
                    <button @click="nav = 'cpas'" :class="nav === 'cpas' ? 'text-black ' : 'text-gray-400'" class="">Change Password</button>
                </div>
            </div>
            {{-- Change Profile --}}
            
            <div x-show="cprofile" x-cloak class="h-screen w-full bg-black/20 fixed top-0 left-0 z-40 flex justify-center items-center backdrop-blur-sm" >
                <div @click.away="cprofile = false" class="bg-white shadow-lg border-[1px] border-gray-200 p-4 rounded-md transition delay-150 duration-300 ease-in-out hover:-translate-y-1 hover:scale-110">
                    <livewire:employee.change-profile />
                </div>
            </div>
            {{-- Change Profile --}}
        </div>
        <div x-show="nav === 'profile'" x-cloak class="col-span-3 space-y-5">
            <div class="text-right text-2xl font-bold font-serif">C&R System</div>
            <div class="p-4 space-y-8">
                <div class="text-xl">Employee Information</div>
                <div class="space-y-8">
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
        {{-- Change Password --}}
        <div x-show="nav === 'cpas'" x-cloak class="col-span-3 space-y-5">
            <div class="text-right text-2xl font-bold font-serif">C&R System</div>
            <livewire:employee.change-password />
        </div>
        {{-- Change Password --}}
    </div>
</div>

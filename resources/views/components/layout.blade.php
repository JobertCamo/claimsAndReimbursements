<!DOCTYPE html>
<html lang="en" class="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/css/app.css'])
    <wireui:scripts />
    @livewireStyles
</head>

<body class="flex transition-all ease-linear duration-300 bg-[#f8fcfc]"  x-data="{sb:false, sb2:true}">

    <button class="z-30 block lg:hidden fixed top-4 left-0 pl-3" href="" @click="sb = true" x-show="!sb"><x-icon name="bars-3" /></button>
    {{-- <button class="z-10 fixed top-16 -left-2 h-10 pl-3 bg-gray-900 rounded-full" href="" @click="sb2 = true" x-show="!sb2">></button> --}}

    {{-- MOBILE SIDEBAR --}}
    <div class="fixed z-30 bg-[#c6005c] h-screen text-white w-72 md:static lg:hidden overflow-y-scroll" x-show="sb"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="-translate-x-72"
        x-transition:enter-end="translate-x-0" 
        x-transition:leave="transition ease-in duration-300 "
        x-transition:leave-start="translate-x-0" 
        x-transition:leave-end="-translate-x-72" 
        x-cloak>
        <div class="  flex justify-center items-center  py-6">
            <div class="">
                <div class="text-lg font-bold p-6">Claims <br> & Reimbursements</div>
            </div>
            <button class="absolute top-0 right-0" href="" @click="sb = false"><x-icon name="x-circle" /></button>
        </div>
        <div class=" pl-6 mt-4 text-[11px] text-white">MAIN MENU</div>
        {{-- <hr class=" h-0.5 border-t-0 bg-neutral-100 dark:bg-white/10" /> --}}
        
        <div class="mt-4 px-4  grid gap-3">
            @can('view-page')
            <div class="flex justify-between items-center px-3 py-3 rounded-md hover:bg-[#f8fcfc] hover:text-black">
                <a href="/dashboard" class="flex items-center gap-1">
                    <x-icon name="squares-2x2" />
                    Dashboard
                </a>
            </div>
            <div x-data="{ dp2: false }">
                <div @click="dp2 = true" class="  py-3  cursor-pointer  rounded-md hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                    <div class="flex justify-between items-center ">
                        <a class=" flex items-center gap-1 px-2">
                            <x-icon name="users" />
                            Claims management
                        </a>
                    </div>
                    
                </div>
                <div x-show="dp2" @click.away="dp2 = false" class="text-center grid text-sm">
                    <a href="/pending" class="hover:bg-[#f8fcfc] hover:text-black py-2">Pending Approval</a>
                    <a href="/approved" class="hover:bg-[#f8fcfc] hover:text-black py-2">Approved Claims</a>
                    <a href="/rejected" class="hover:bg-[#f8fcfc] hover:text-black py-2">Rejected Claims</a>
                </div>
            </div>
            <div class="flex justify-between items-center px-3 py-3 rounded-md hover:bg-[#f8fcfc] hover:text-black">
                <a href="/reports" class="flex items-center gap-1">
                    <x-icon name="squares-2x2" />
                    Reports
                </a>
            </div>
            <div class="flex justify-between items-center px-3 py-3 rounded-md hover:bg-[#f8fcfc] hover:text-black">
                <a href="/payments" class="flex items-center gap-1">
                    <x-icon name="squares-2x2" />
                    Payments
                </a>
            </div>
            @endcan
            @cannot('view-page')
            
            <div class="flex justify-between items-center px-3 py-3 rounded-md hover:bg-gray-800">
                <a href="/dashboard" class="flex items-center gap-1">
                    <x-icon name="squares-2x2" />
                    Dashboard
                </a>
            </div>
            <div class=" px-3 py-3 rounded-md hover:bg-gray-800" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center">
                    <a wire:navigate href="/request" @click="dropdown1=true" @click.away="dropdown1=false" class="flex items-center gap-1">
                        <x-icon name="document-arrow-up" />
                        Request Claims
                    </a>
                </div>
            </div>
            <div class=" px-3 py-3 rounded-md hover:bg-gray-800" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center">
                    <a wire:navigate href="/history" @click="dropdown1=true" @click.away="dropdown1=false" class="flex items-center gap-1">
                        <x-icon name="user-group" />
                        My Claims History
                    </a>
                </div>
            </div>
                
            @endcannot
        </div>

    </div>
    {{-- MOBILE SIDEBAR --}}

    {{-- LARGE SCREEN SIDEBAR --}}
    <div  :class="!sb2 ? 'w-0' : 'w-72'" class="fixed transition-all duration-300 z-10 bg-[#c6005c] h-screen text-white hidden lg:block md:static overflow-y-scroll" 
        
    x-cloak>
        
    
        <div class="  relative text-center ">
            <div class="py-4  flex items-center justify-center gap-3">
                <div class="text-2xl font-bold font-serif ">C&R System</div>
            </div>
        </div>
        <div class=" pl-6 mt-4 text-[11px] text-white">MAIN MENU</div>
        <div class="   grid gap-3 ">
            @can('view-page')
            <div class="{{ request()->is('admin-dashboard') ? 'bg-[#f8fcfc] text-black hover:bg-none' : '' }} flex justify-between items-center px-3 py-3 rounded-l-full hover:bg-[#f8fcfc] hover:text-black" >
                <a href="/admin-dashboard" class="flex items-center gap-4 px-2">
                    <x-icon name="squares-2x2" />
                    Dashboard
                </a>
            </div>
            <div x-data="{ dp1: false }">
                <div @click="dp1 = true" class=" px-3 py-3  cursor-pointer  {{ request()->is('pending') ? 'bg-[#f8fcfc] text-black rounded-l-full' : '' }} rounded-l-full hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                    <div class="flex justify-between items-center ">
                        <a wire:navigate href="/pending" class=" flex items-center gap-4 px-2">
                            <x-icon name="users" />
                            Claims management
                        </a>
                    </div>
                    
                </div>
                {{-- <div x-show="dp1" @click.away="dp1 = false" class="text-center grid text-sm">
                    <a href="/pending" class="hover:bg-[#f8fcfc] hover:text-black py-2">Pending Approval</a>
                    <a href="/approved" class="hover:bg-[#f8fcfc] hover:text-black py-2">Approved Claims</a>
                    <a href="/rejected" class="hover:bg-[#f8fcfc] hover:text-black py-2">Rejected Claims</a>
                </div> --}}
            </div>
            <div class="{{ request()->is('reports') ? 'bg-[#f8fcfc] text-black hover:bg-none' : '' }} flex justify-between items-center px-3 py-3 rounded-l-full hover:bg-[#f8fcfc] hover:text-black" >
                <a  href="/reports" class="flex items-center gap-4 px-2">
                    <x-icon name="flag" />
                    Reports
                </a>
            </div>
            <div class="{{ request()->is('payments') ? 'bg-[#f8fcfc] text-black hover:bg-none' : '' }} flex justify-between items-center px-3 py-3 rounded-l-full hover:bg-[#f8fcfc] hover:text-black" >
                <a wire:navigate href="/payments" class="flex items-center gap-4 px-2">
                    <x-icon name="currency-dollar" />
                    Payments
                </a>
            </div>
            @endcan
            @can('view-page-employee')
            <div class=" px-3 py-3    {{ request()->is('dashboard') ? 'bg-[#f8fcfc] text-black rounded-l-full' : '' }} rounded-l-full hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center ">
                    <a wire:navigate href="/dashboard" @click="dropdown1=true" @click.away="dropdown1=false" class=" flex items-center gap-4 px-2">
                        <x-icon name="squares-2x2" />
                        Dashboard
                    </a>
                </div>
            </div>
            <div class=" px-3 py-3    {{ request()->is('request') ? 'bg-[#f8fcfc] text-black rounded-l-full' : '' }} rounded-l-full hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center ">
                    <a wire:navigate href="/request" @click="dropdown1=true" @click.away="dropdown1=false" class=" flex items-center gap-4 px-2">
                        <x-icon name="document-arrow-up" />
                        Request Claims
                    </a>
                </div>
            </div>
            <div class=" px-3 py-3    {{ request()->is('history') ? 'bg-[#f8fcfc] text-black rounded-l-full' : '' }} rounded-l-full hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center ">
                    <a wire:navigate href="/history" @click="dropdown1=true" @click.away="dropdown1=false" class=" flex items-center gap-4 px-2">
                        <x-icon name="rectangle-stack" />
                        My claims history
                    </a>
                </div>
            </div>
            <div class=" px-3 py-3    {{ request()->is('task-management') ? 'bg-[#f8fcfc] text-black rounded-l-full' : '' }} rounded-l-full hover:bg-[#f8fcfc] hover:text-black" x-data="{dropdown1:false}">
                <div class="flex justify-between items-center ">
                    <a wire:navigate href="/history" @click="dropdown1=true" @click.away="dropdown1=false" class=" flex items-center gap-4 px-2">
                        <x-icon name="currency-dollar" />
                        Payment History
                    </a>
                </div>
            </div>
            @endcan
        </div>

    </div>
    {{-- LARGE SCREEN SIDEBAR --}}

    {{-- CONTAINER --}}
    <div class=" w-full h-screen flex flex-col overflow-auto">
        {{-- NAV BAR --}}
        <div class="z-20 w-full h-12 flex justify-between bg-white lg:flex lg:items-center lg:justify-between px-4 py-4 lg:px-5 sticky top-0 shadow-lg">
            <div class="relative hidden lg:flex items-center">
                <button class="cursor-pointer pr-2 mr-2 transition-all duration-300  rounded-full text-black text-center" href="" @click="!sb2 ? sb2 = true : sb2 = false"><x-icon name="bars-3" /></button>
            </div>
            <div>
                &nbsp;
            </div>
            <div class="ml-10 lg:hidden">
                HRGWA
            </div>
            <div class="relative flex justify-center items-center space-x-3 " x-cloak x-data="{notif: false, logout: false}">
                
                {{-- NOTIFICATION CONTAINER --}}
                    <livewire:employee.notification />
                {{-- NOTIFICATION CONTAINER --}}
                <button class="">
                    {{-- <x-icon name="question-mark-circle"  color="gray" class="" /> --}}
                </button>
                <button class=" lg:flex lg:items-center" @click=" logout = true ">
                    <x-avatar sm src="{{ Storage::url(Auth::user()->profile_pic) }}" class="bg-gray-600 ring-1 ring-green-500" />
                </button>
                {{-- Logout --}}
                <template x-if="true">
                    <div x-show="logout" x-cloak @click.away="logout = false" x-transition class="overflow-auto grid gap-3 p-3 absolute  top-10 rounded-md bg-white shadow-[rgba(0,_0,_0,_0.24)_0px_3px_8px]">
                        <div>
                            <a href="/my-profile">Profile</a>
                            <form action="/logout" method="POST">
                                @csrf
                                <button type="submit">Logout</button>
                            </form>
                        </div>
                    </div>
                </template>
                {{-- Logout --}}
            </div>
            
        </div>
        {{-- NAV BAR --}}

        {{-- CONTENT AREA --}}
        <div class="w-full p-4 space-y-4 ">
            <nav class="flex py-1" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    @if (!empty($head1))
                        
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                            <svg class="w-3 h-3 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
                            </svg>
                            {{ $head1 }}
                        </a>
                    </li>
                    @endif
                  <li>
                    <div class="flex items-center">
                      <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <a href="#" class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">{{ $head2 }}</a>
                    </div>
                  </li>
                  <li aria-current="page">
                    <div class="flex items-center">
                      <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                      </svg>
                      <span class="ms-1 text-sm font-medium text-gray-500 md:ms-2 dark:text-gray-400">{{ $head3 }}</span>
                    </div>
                  </li>
                </ol>
            </nav>
           {{ $slot }}
        </div>
        {{-- CONTENT AREA --}}
    </div>
    @livewireScripts
</body>
</html>
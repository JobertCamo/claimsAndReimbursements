<x-layout>
@slot('head1') Home @endslot
@slot('head2') Dashboard @endslot
@slot('head3')  @endslot

<div class="grid  gap-4  lg:grid-cols-3">
    <div class="flex flex-col justify-between shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] w-full lg:w-full h-24 lg:h-36 rounded-sm bg-gradient-to-t from-sky-600/70 to-cyan-500 relative overflow-hidden">
        <div class="absolute bg-white/20 w-36 h-36 -top-[120px] md:-top-[70px] -right-5 rotate-45"></div>
        <div class="absolute bg-white/20 w-32 h-32 -bottom-[90px] -left-5 rotate-45"></div>
        <div class="absolute bg-white/20 w-32 h-32 -bottom-[90px] -left-5 rotate-12"></div>
        <div class="p-2 lg:p-4 grid gap-2">
            <div class="flex items-center gap-2 ">
                <x-icon name="check-circle"  color="white" class="w-5 h-5"/>
                <div class="text-white font-bold text-xs lg:text-md">Approved Claims</div>
            </div>
            <div class="text-white text-xs lg:text-lg">2123</div>
        </div>
        <div class="pb-1 lg:pb-2 px-4 lg:space-y-2">
            <div class="flex justify-between">
                <div class="text-white font-bold text-[10px] lg:text-xs">Non Priority</div>
                <div class="text-white font-bold text-xs s lg:text-md">111</div>
            </div>
        </div>
    </div>
    <div class="flex flex-col justify-between shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] w-full lg:w-full h-24 lg:h-36 rounded-sm bg-green-200 bg-gradient-to-t from-violet-600/80 to-violet-500/70 relative overflow-hidden">
        <div class="absolute bg-white/10 w-36 h-36 -top-[120px] md:-top-[70px] -right-5 rotate-45 rounded-full"></div>
        <div class="absolute bg-white/10 w-32 h-32 -bottom-[90px] -left-5 rotate-45 rounded-full"></div>
        <div class="absolute bg-white/10 w-24 h-24 -bottom-[20px] left-10 rotate-12 rounded-full"></div>
        <div class="p-2 lg:p-4 grid gap-2">
            <div class="flex items-center gap-2 ">
                <x-icon name="folder"  color="white" class="w-5 h-5"/>
                <div class="text-white font-bold text-xs lg:text-md">Pending Claims</div>
            </div>
            <div class="text-white text-xs lg:text-lg">2123</div>
        </div>
        <div class="pb-1 lg:pb-2 px-4 lg:space-y-2">
            <div class="flex justify-between items-center">
                <div class="text-white font-bold text-[10px] lg:text-xs">Priority</div>
                <div class="text-white font-bold text-[10px]  lg:text-[12px] border-[2px] border-white h-8 w-8 md:h-10 md:w-10 rounded-full flex justify-center items-center">100%</div>
            </div>
            
        </div>
    </div>
    <div class="flex flex-col justify-between shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] w-full lg:w-full h-24 lg:h-36 rounded-sm bg-green-200 bg-gradient-to-t from-rose-700 to-rose-400 relative overflow-hidden">
        <div class="w-0 h-0 border-l-[50px] border-l-transparent border-b-[75px] border-b-white/20 rotate-12 bottom-0 right-0 border-r-[50px] border-r-transparent absolute"></div>
        <div class="w-0 h-0 border-l-[50px] border-l-transparent border-b-[75px] border-b-white/10 rotate-6 top-0 left-0 border-r-[50px] border-r-transparent absolute"></div>
        <div class="absolute bg-white/10 w-36 h-36 -top-[120px] md:-top-[70px] -right-5 rotate-45 rounded-full"></div>
        <div class="p-2 lg:p-4 grid gap-2">
            <div class="flex items-center gap-2 ">
                <x-icon name="information-circle"  color="white" class="w-5 h-5"/>
                <div class="text-white font-bold text-xs lg:text-md">Rejected Claims</div>
            </div>
            <div class="text-white text-xs lg:text-lg">2123</div>
        </div>
        <div class="pb-1 lg:pb-2 px-4 lg:space-y-2">
            <div class="flex justify-between items-center">
                <div class="text-white font-bold text-[10px] lg:text-xs">Priority</div>
                <div class="text-white font-bold text-[10px]  lg:text-[12px] border-[2px] border-white h-8 w-8 md:h-10 md:w-10 rounded-full flex justify-center items-center">100%</div>
            </div>
            
        </div>
    </div>
</div>
{{-- TABLE --}}
<div class="">

    <livewire:employee.overview-table />
    
</div>
{{-- TABLE --}}

</x-layout>
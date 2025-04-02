<x-layout>
    @slot('head1') Home @endslot
    @slot('head2') Claims and Reimbursements @endslot
    @slot('head3')  @endslot
    
    {{-- <div class="grid lg:grid-cols-3 gap-4 text-white">
        <div class="bg-gradient-to-r from-indigo-400 to-cyan-400 px-3 py-2 space-y-2 shadow-lg border-[1px] border-gray-200">
            <x-icon name="users" />
            <div>
                <div>Sales Department</div>
                <div class="text-right">Total Claims</div>
            </div>
            <div class="text-right">9000000</div>
        </div>
        <div class="bg-gradient-to-r from-fuchsia-600 to-purple-600 px-3 py-2 space-y-2 shadow-lg border-[1px] border-gray-200">
            <x-icon name="users" />
            <div>
                <div>IT Department</div>
                <div class="text-right">Total Claims</div>
            </div>
            <div class="text-right">9000000</div>
        </div>
        <div class="bg-gradient-to-r from-violet-500 to-purple-500 px-3 py-2 space-y-2 shadow-lg border-[1px] border-gray-200">
            <x-icon name="users" />
            <div>
                <div>Marketing Department</div>
                <div class="text-right">Total Claims</div>
            </div>
            <div class="text-right">9000000</div>
        </div>
    </div> --}}
    
    {{-- <div class="grid lg:grid-cols-3 gap-4">
        <div class="shadow-lg border-[1px] border-gray-200 text-center pt-2 px-2 flex flex-col justify-between">
            <img class="lg:min-h-[224px] lg:max-h-[224px]" src="https://www.lystloc.com/blog/wp-content/uploads/2022/12/ezgif.com-gif-maker-80.webp" alt="">
            <div class="py-2"><x-button label="Sales Department" class="w-full"/></div>
            
        </div>
        <div class="shadow-lg border-[1px] border-gray-200 text-center pt-2 px-2 flex flex-col justify-between">
            <img class="lg:min-h-[224px] lg:max-h-[224px]" src="https://images.businessprocessincubator.com/auraportal-blog/what-is-the-role-of-the-it-department/equipo-ti-2-1024x771-1.webp" alt="">
            <div class="py-2"><x-button label="IT Department" class="w-full"/></div>
        </div>
        <div class="shadow-lg border-[1px] border-gray-200 text-center pt-2 px-2 flex flex-col justify-between">
            <img class="lg:min-h-[224px] lg:max-h-[224px]" src="https://everyonesocial.com/wp-content/uploads/2019/07/internal-marketing-strategy-984x513.jpg" alt="">
            <div class="py-2"><x-button label="Marketing Department" class="w-full"/></div>
        </div>
    </div> --}}
    
    <div class="shadow-lg border-[1px] border-gray-200 rounded-lg">
        <div  x-data="{subnav: 'approved'}">
            <div class=" w-full  py-4 px-5 space-y-3 rounded-md" >
                <div class="mt-3 mb-2 flex justify-between items-center">
                    <div x-cloak x-show="subnav === 'approved'" class="text-md md:text-2xl font-bold">Approved Claims</div>
                </div>
                <div>
                    <div  class="flex items-center gap-5 h-8 border-b-2 border-gray-100">
                        <button @click="subnav = 'approved'" :class="subnav === 'approved' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Approved Claims </button>
                    </div>
                </div>
                
            </div>
            <div x-show="subnav === 'approved'" x-cloak>
                <livewire:admin.approved-table />
            </div>
        
        </div>
    </div>
    
    

</x-layout>
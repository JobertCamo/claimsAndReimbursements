<x-layout>
@slot('head1') Claims & Reimbursements @endslot
@slot('head2') History @endslot
@slot('head3')  @endslot
{{-- TABLE --}}

<div class="shadow-lg border-[1px] border-gray-200 rounded-lg" x-data="{subnav: 'applicants'}">
    <div class=" w-full  py-4 px-5 space-y-3 rounded-md" >
        <div class="mt-3 mb-2 flex justify-between items-center">
            <div x-cloak x-show="subnav === 'applicants'" class="text-md md:text-2xl font-bold">Claims History</div>
            <div x-cloak x-show="subnav === 'priority'" class="text-md md:text-2xl font-bold">Rejected Claims</div>
            <div x-cloak x-show="subnav === 'passed'" class="text-md md:text-2xl font-bold">Pending Claims</div>
            {{-- <div x-cloak x-show="subnav === 'failed'" class="text-md md:text-2xl font-bold">Failed Applicants</div> --}}
            {{-- <x-button label="Add Applicant" class=" lg:py-3" /> --}}
        </div>
        <div>
            <div  class="flex items-center gap-5 h-8 border-b-2 border-gray-200">
                <button @click="subnav = 'applicants'" :class="subnav === 'applicants' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Claims History </button>
                {{-- <button @click="subnav = 'priority'" :class="subnav === 'priority' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Rejected Claims </button> --}}
                {{-- <button @click="subnav = 'passed'" :class="subnav === 'passed' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Passed </button> --}}
            </div>
        </div>
        
    </div>
    <livewire:employee.history-table />
</div>
{{-- TABLE --}}

</x-layout>
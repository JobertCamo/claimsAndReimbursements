<x-layout>
  @slot('head1') Home @endslot
  @slot('head2') Claims and Reimbursements @endslot
  @slot('head3')  @endslot

  <div class="shadow-lg border-[1px] border-gray-200 rounded-lg" x-data="{form: false}">
    {{-- <div>
        <div class="text-3xl font-bold text-gray-600">Claims and Reimbursement Form</div>
         <livewire:employee.claims-form />
        </div>
    </div> --}}
    <div  x-data="{subnav: 'pending'}">
      <div class=" w-full  py-4 px-5 space-y-3 rounded-md" >
        <div class="mt-3 mb-2 flex justify-between items-center">
            <div x-cloak x-show="subnav === 'pending'" class="text-md md:text-2xl font-bold">Pending History</div>
            <div x-cloak x-show="subnav === 'approved'" class="text-md md:text-2xl font-bold">Approved Claims</div>
            <div x-cloak x-show="subnav === 'rejected'" class="text-md md:text-2xl font-bold">Rejected Claims</div>
            {{-- <div x-cloak x-show="subnav === 'failed'" class="text-md md:text-2xl font-bold">Failed Applicants</div> --}}
            <x-button @click="form = true" label="Submit Claim" class=" lg:py-3" />
        </div>
        <div>
            <div  class="flex items-center gap-5 h-8 border-b-2 border-gray-100">
                <button @click="subnav = 'pending'" :class="subnav === 'pending' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Claims History </button>
                <button @click="subnav = 'approved'" :class="subnav === 'approved' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Approved Claims </button>
                <button @click="subnav = 'rejected'" :class="subnav === 'rejected' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Rejected Claims </button>
            </div>
        </div>
        
      </div>
      <div x-show="subnav === 'pending'" x-cloak>
        <livewire:employee.overview-table />
      </div>
      <div x-show="subnav === 'approved'" x-cloak>
        <livewire:employee.approved-table />
      </div>
      <div x-show="subnav === 'rejected'" x-cloak>
        <livewire:employee.failed-table />
      </div>
      <div>
        
      </div>
    </div>
    <div x-show="form" x-cloak class="h-screen w-full bg-black/20 fixed top-0 left-0 z-40 flex justify-center items-center backdrop-blur-sm" >
      <div @click.away="form = false" class="bg-white py-2 px-4 rounded-md">
        {{-- <div class="text-xl font-bold text-gray-600">Claims and Reimbursement Form</div> --}}
         <livewire:employee.claims-form />
        </div>
    </div>
    </div>
  </div>
</x-layout>
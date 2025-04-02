<x-layout>
    @slot('head1') Home @endslot
    @slot('head2') Claims and Reimbursements @endslot
    @slot('head3')  @endslot

    {{-- CHART --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- CHART --}}
    
    <livewire:admin.report-status-card />
    
    <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col  justify-center items-center shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] h-60  rounded-xl lg:col-span-2 min-w-[300px] lg:h-80 xl:h-80 p-3 lg:py-4">
            <div class="w-full text-center uppercase">Claims per departments</div>
            <canvas class=" " id="myChart"></canvas>
        </div>
        <div class="flex flex-col  justify-center items-center shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] h-60  rounded-xl lg:col-span-2 min-w-[300px] lg:h-80 xl:h-80 p-3 lg:py-4">
            <div class="w-full text-center uppercase">Claims Reports</div>
            <canvas class=" " id="myChart2"></canvas>
        </div>
    </div>
    
    <div class="shadow-lg border-[1px] border-gray-200 rounded-lg">
      <div  x-data="{subnav: 'approved'}">
          <div class=" w-full  py-4 px-5 space-y-3 rounded-md" >
              <div class="mt-3 mb-2 flex justify-between items-center">
                  <div x-cloak x-show="subnav === 'approved'" class="text-md md:text-2xl font-bold">Paid Claims</div>
                  <x-button onclick="printTable()" right-icon="printer" label="Print table" slate class=" lg:py-3" />
              </div>
              <div>
                  <div  class="flex items-center gap-5 h-8 border-b-2 border-gray-100">
                      <button @click="subnav = 'approved'" :class="subnav === 'approved' ? 'border-b-2 border-blue-500 text-blue-500' : 'text-gray-500'" class="h-8 text-[12px] flex items-center">Approved Claims </button>
                  </div>
              </div>
              
          </div>
          <div x-show="subnav === 'approved'" x-cloak>
              <livewire:admin.paid-table />
          </div>
      
      </div>
  </div>
    
    <script>
        const ctx = document.getElementById('myChart');
      
      new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['January', 'February', 'March', 'April'],
          datasets: [{
            label: 'Sample',
            data: [12, 19, 6, 15],
            backgroundColor:[
              'rgba(255, 99, 132)',
              'rgba(54, 162, 235)',
              'rgba(255, 206, 86)',
              'rgba(75, 192, 192)',
              'rgba(153, 102, 255)',
              'rgba(255, 159, 64)',
          ],
            borderWidth: 1
          }]
        },
        options: {
          aspectRatio: 2,
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });


      const ctx2 = document.getElementById('myChart2');
      
      new Chart(ctx2, {
        type: 'bar',
        data: {
          labels: ['January', 'February', 'March', 'April', 'May', 'June'],
          datasets: [{
            label: 'Sample',
            data: [12, 19, 6, 15, 2, 13],
            backgroundColor:[
              'rgba(255, 99, 132)',
              'rgba(54, 162, 235)',
              'rgba(255, 206, 86)',
              'rgba(75, 192, 192)',
              'rgba(153, 102, 255)',
              'rgba(255, 159, 64)',
          ],
            borderWidth: 1
          }]
        },
        options: {
          aspectRatio: 2,
          scales: {
            y: {
              beginAtZero: true
            }
          },
          animations: {
      tension: {
        duration: 1000,
        easing: 'linear',
        from: 1,
        to: 0,
        loop: true
      }
    },
        }
      });



      function printTable() {
        let printContent = document.getElementById("claimsTable").outerHTML;
        let originalContent = document.body.innerHTML;

        document.body.innerHTML = `<html><head><title>Print Report</title></head><body>${printContent}</body></html>`;
        window.print();
        document.body.innerHTML = originalContent;
        window.location.reload();
      }
    </script>
</x-layout>
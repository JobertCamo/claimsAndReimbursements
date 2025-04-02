<x-layout>
@slot('head1') Home @endslot
@slot('head2') Dashboard @endslot
@slot('head3')  @endslot

<livewire:admin.status-card />

{{-- CHART --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{{-- CHART --}}

  <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
      <div class="flex flex-col  justify-center items-center shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] h-60  rounded-xl lg:col-span-2 min-w-[300px] lg:h-80 xl:h-96 p-3 lg:py-4">
          <div class="w-full text-center">STATUSSSSSSS</div>
          <canvas class=" " id="myChart"></canvas>
      </div>
      <div class="space-y-4 shadow-[rgba(17,_17,_26,_0.1)_0px_0px_16px] h-60  rounded-xl lg:col-span-2 min-w-[300px] lg:h-80 xl:h-96 p-3 lg:py-2">
          <div class=" font-bold p-2">Recent Claims</div>
          <livewire:admin.recent-claims />
      </div>
  </div>

<script>
    const ctx = document.getElementById('myChart');
  
  new Chart(ctx, {
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
      }
    }
  });


  const ctx2 = document.getElementById('myChart2');
  
  new Chart(ctx2, {
    type: 'line',
    data: {
      labels: ['January', 'February', 'March', 'April', 'May', 'June'],
      datasets: [{
        label: 'Sample',
        data: [12, 19, 6, 15, 2, 13],
        
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
</script>

</x-layout>
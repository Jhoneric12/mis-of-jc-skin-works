<div>
    <x-Essentials.page-title>Sales Report</x-Essentials.page-title>

    <div class="flex justify-between mb-6">
        <div></div>
        <div class="flex gap-4">
           <div class="flex gap-4 items-center">
            
                <div role="status" wire:loading>
                    <svg aria-hidden="true" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                    </svg>
                    <span class="sr-only">Loading...</span>
                </div>
                <div class="flex gap-2 items-center">
                    <label for="start_date" class="text-sm">From:</label>
                    <input wire:model="startDate" type="date" id="start_date" class="text-sm w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
                </div>
                <div class="flex gap-2 items-center">
                    <label for="end_date" class="text-sm">To:</label>
                    <input wire:model="endDate" type="date" id="end_date" class=" text-sm w-full border-gray-300 focus:border-green-500 focus:ring-green-500 rounded-md shadow-sm p-3">
                </div>
           </div>
           <x-button class="flex gap-2" wire:loading.attr="disabled" wire:click='export'>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                </svg>          
            {{ __('Generate Report') }}
        </x-button>
           
       </div>
    </div>

    <div class="col-span-12 mt-8 mb-6">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                href="#">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-yellow-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>

                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8">₱ {{number_format($total_sales, 0, ',', '.');}}</div>

                            <div class="mt-1 text-base text-gray-600">Total Revenue</div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
            href="{{route('manage-product-table')}}">
            <div class="p-5">
                <div class="flex justify-between">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-blue-400"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <div class="ml-2 w-full flex-1">
                    <div>
                        <div class="mt-3 text-3xl font-bold leading-8">₱ {{number_format($product_sales, 0, ',', '.');}}</div>

                        <div class="mt-1 text-base text-gray-600">Product Sales</div>
                    </div>
                </div>
            </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                href="{{route('manage-patients')}}">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-green-400"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" />
                        </svg>
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8">₱ {{number_format($service_sales, 0, ',', '.');}}</div>

                            <div class="mt-1 text-base text-gray-600">Service Sales</div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="transform  hover:scale-105 transition duration-300 shadow-xl rounded-lg col-span-12 sm:col-span-6 xl:col-span-3 intro-y bg-white"
                href="{{route('manage-inventory')}}">
                <div class="p-5">
                    <div class="flex justify-between">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-pink-600"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z" />
                        </svg>
                        
                    </div>
                    <div class="ml-2 w-full flex-1">
                        <div>
                            <div class="mt-3 text-3xl font-bold leading-8">₱ {{number_format($monthly_sales, 0, ',', '.');}}</div>

                            <div class="mt-1 text-base text-gray-600">Monthly Sales</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="flex gap-6 mb-6">
        <div class="p-6 bg-white rounded-lg shadow-md w-full">
            <h1 class="font-bold">Monthly Sales</h1>
            <div id="sales-chart"></div>
        </div>
        <div class="p-6 bg-white rounded-lg shadow-md w-full">
            <h1 class="font-bold">Products and Services Sales</h1>
            <div id="sales-pie-chart"></div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-md p-6">
        <h1 class="font-bold">Daily sales statistics</h1>
        <div id="daily-sales-chart"></div>
    </div>

    <div class="relative overflow-x-auto sm:rounded-lg shadow-md px-6 py-8 border-2 border-solid mt-6">
        <div class="mb-4 flex gap-2 items-center justify-between">
            <div class="flex gap-2 items-center w-full">
                <h1 class="font-bold">Recent Transactions</h1>
            </div>
            <div class="20%">
            </div>
        </div>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 sm:rounded-lg shadow-xl py-6 border border-solid">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 border-b-2 border-b-solid">
                <tr>
                    <th scope="col" class="px-6 py-6">
                        Transaction ID
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Recipient
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Date & Time
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Payment Mode
                    </th>
                    <th scope="col" class="px-6 py-6">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 rounded-lg">
                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$transaction->id}}
                    </td>
                    <th scope="row" class="flex items-center px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos()  && $transaction->patient )
                        <div class="flex-shrink-0 h-10 w-10"> <img class="h-10 w-10 rounded-full" src="{{ $transaction->patient->profile_photo_url }}" alt="{{ $transaction->patient->name }}"> </div>
                        <div class="ml-4">
                            <div class="text-xs font-medium text-gray-900"> {{ $transaction->patient->first_name .  " " . $transaction->patient->last_name }} </div>
                            <div class="text-xs text-gray-500"> {{ $transaction->patient->email }} </div>
                        </div>
                        @else
                            <div>
                                <div class="text-sm font-medium text-gray-900"> {{ $transaction->first_name . " " . $transaction->last_name }} </div>
                                {{-- <div class="text-xs text-gray-500"> {{ $appointment->email }} </div> --}}
                            </div>
                        @endif
                    </th>
                    <td class="px-6 py-6">
                        <div>
                            <div class="text-xs font-medium text-gray-900"> {{\Carbon\Carbon::parse($transaction->created_at)->format('M, d, Y')}} </div>
                            <div class="text-xs text-gray-500"> {{\Carbon\Carbon::parse($transaction->created_at)->format('g: i a')}} </div>
                        </div>
                    </td>
                    <td class="px-6 py-6">
                        {{$transaction->payment_mode}}
                    </td>
                    <td class="px-6 py-6">
                        {{$transaction->total_amount}}
                    </td>
                </tr>
                @empty
                    <tr class="w-full">
                        <td colspan="6" class="text-center py-4">
                            <div class="flex flex-col items-center justify-center">
                                <img src="{{ asset('assets/Essentials/No data-cuate.png') }}" alt="" class="h-40 w-40">
                                <h1 class="text-md font-semibold mb-2">No Results Found</h1>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-6">
            {{$transactions->links()}}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    document.addEventListener('livewire:init', function () {
        var salesData = @json($sales->pluck('total', 'month')->toArray());
        var months = Object.keys(salesData).map(function(month) {
            // Convert month number to month name
            var monthNames = ["January", "February", "March", "April", "May", "June",
                              "July", "August", "September", "October", "November", "December"];
            var monthIndex = parseInt(month.split('-')[1]) - 1;
            return monthNames[monthIndex];
        });
        var totals = Object.values(salesData);

        var monthlyColors = totals.map(function(sale) {
            if (sale > 10000) {
                return '#4EBB59'; 
            } else if (sale >= 5000 && sale <= 10000) {
                return '#FFC234'; 
            } else {
                return '#FF4069'; 
            }
        });

        // Monthly Sales Chart
        var salesChartOptions = {
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    }
                }
            },
            colors: monthlyColors,
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            series: [{
                name: 'Monthly Sales Amount',
                data: totals
            }],
            xaxis: {
                categories: months,
            },
            // yaxis: {
            //     title: {
            //         text: 'Sales Amount ($)'
            //     }
            // },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "P" + val + "K";
                    }
                }
            },
            stroke: {
                curve: 'smooth'
            }
        };

        var salesChart = new ApexCharts(document.querySelector("#sales-chart"), salesChartOptions);
        salesChart.render();

        // Pie chart for sales in services and products
        var pieChartOptions = {
            chart: {
                type: 'pie',
                height: 350,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    }
                }
            },
            series: [{{$servicesSales}}, {{$productsSales}}],
            labels: ['Services', 'Products'],
            colors: ['#FFC234', '#FF4069'],
            legend: {
                show: true,
                position: 'bottom'
            },
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var pieChart = new ApexCharts(document.querySelector("#sales-pie-chart"), pieChartOptions);
        pieChart.render();

        // Line chart for daily sales in the current week
        var dailySalesData = @json($dailySales);
        var days = Object.keys(dailySalesData).map(function(day) {
            return new Date(day).toLocaleDateString('en-US', { weekday: 'short' });
        });
        var dailyTotals = Object.values(dailySalesData);

        var dailySalesChartOptions = {
            chart: {
                type: 'line',
                height: 350,
                toolbar: {
                    show: true,
                    tools: {
                        download: true,
                    }
                }
            },
            series: [{
                name: 'Daily Sales',
                data: dailyTotals
            }],
            xaxis: {
                categories: days
            },
            // yaxis: {
            //     title: {
            //         text: 'Sales Amount ($)'
            //     }
            // },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "P" + val + "K";
                    }
                }
            },
            stroke: {
                curve: 'smooth'
            },
        };

        var dailySalesChart = new ApexCharts(document.querySelector("#daily-sales-chart"), dailySalesChartOptions);
        dailySalesChart.render();

    });
</script>

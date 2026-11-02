@extends('backend.master')

@section('title')
    Admin Dashboard
@endsection

@section('content')
    <div class="main-container container-fluid">        
        <!-- PAGE-HEADER -->
        <div class="page-header">
            <div>
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div class="ms-auto pageheader-btn">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>
        </div>
        <!-- PAGE-HEADER END -->

        <!-- ROW-1 -->
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden" onclick="window.location='{{ route('admin.orders') }}'" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $orderCurrentMonthCount }}</h3>
                                <p class="text-muted fs-13 mb-0">Total Orders Current Month</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                    <span class="icn-box {{ $orderIsIncrease ? 'text-success' : 'text-danger' }} fw-semibold fs-13 me-1">
                                        <i class="fa fa-long-arrow-{{ $orderIsIncrease ? 'up' : 'down' }}"></i>
                                        {{ $orderPercentageChange }}%
                                    </span>
                                    since last month
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-info dash ms-auto box-shadow-info">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M7.5,12C7.223877,12,7,12.223877,7,12.5v5.0005493C7.0001831,17.7765503,7.223999,18.0001831,7.5,18h0.0006104C7.7765503,17.9998169,8.0001831,17.776001,8,17.5v-5C8,12.223877,7.776123,12,7.5,12z M19,2H5C3.3438721,2.0018311,2.0018311,3.3438721,2,5v14c0.0018311,1.6561279,1.3438721,2.9981689,3,3h14c1.6561279-0.0018311,2.9981689-1.3438721,3-3V5C21.9981689,3.3438721,20.6561279,2.0018311,19,2z M21,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H5c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V5c0.0014038-1.1040039,0.8959961-1.9985962,2-2h14c1.1040039,0.0014038,1.9985962,0.8959961,2,2V19z M12,6c-0.276123,0-0.5,0.223877-0.5,0.5v11.0005493C11.5001831,17.7765503,11.723999,18.0001831,12,18h0.0006104c0.2759399-0.0001831,0.4995728-0.223999,0.4993896-0.5v-11C12.5,6.223877,12.276123,6,12,6z M16.5,10c-0.276123,0-0.5,0.223877-0.5,0.5v7.0005493C16.0001831,17.7765503,16.223999,18.0001831,16.5,18h0.0006104C16.7765503,17.9998169,17.0001831,17.776001,17,17.5v-7C17,10.223877,16.776123,10,16.5,10z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden" onclick="window.location='{{ route('admin.show-messages') }}'" style="cursor: pointer;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">{{ $messageCurrentMonthCount }}</h3>
                                <p class="text-muted fs-13 mb-0">Total Messages This Month</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                    <span class="icn-box {{ $messageIsIncrease ? 'text-success' : 'text-danger' }} fw-semibold fs-13 me-1">
                                        <i class="fa fa-long-arrow-{{ $messageIsIncrease ? 'up' : 'down' }}"></i>
                                        {{ $messagePercentageChange }}%
                                    </span>
                                    since last month
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-secondary dash ms-auto box-shadow-secondary">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M19.5,7H16V5.9169922c0-2.2091064-1.7908325-4-4-4s-4,1.7908936-4,4V7H4.5C4.4998169,7,4.4996338,7,4.4993896,7C4.2234497,7.0001831,3.9998169,7.223999,4,7.5V19c0.0018311,1.6561279,1.3438721,2.9981689,3,3h10c1.6561279-0.0018311,2.9981689-1.3438721,3-3V7.5c0-0.0001831,0-0.0003662,0-0.0006104C19.9998169,7.2234497,19.776001,6.9998169,19.5,7z M9,5.9169922c0-1.6568604,1.3431396-3,3-3s3,1.3431396,3,3V7H9V5.9169922z M19,19c-0.0014038,1.1040039-0.8959961,1.9985962-2,2H7c-1.1040039-0.0014038-1.9985962-0.8959961-2-2V8h3v2.5C8,10.776123,8.223877,11,8.5,11S9,10.776123,9,10.5V8h6v2.5c0,0.0001831,0,0.0003662,0,0.0005493C15.0001831,10.7765503,15.223999,11.0001831,15.5,11c0.0001831,0,0.0003662,0,0.0006104,0C15.7765503,10.9998169,16.0001831,10.776001,16,10.5V8h3V19z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-6 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-2 fw-semibold">${{ number_format($totalEarn) }}</h3>
                                <p class="text-muted fs-13 mb-0">Total Earn Current Month</p>
                                <p class="text-muted mb-0 mt-2 fs-12">
                                    <span class="icn-box {{ $totalEarnIsIncrease ? 'text-success' : 'text-danger' }} fw-semibold fs-13 me-1">
                                        <i class="fa fa-long-arrow-{{ $totalEarnIsIncrease ? 'up' : 'down' }}"></i>
                                        {{ $totalEarnPercentageChange }}%
                                    </span>
                                    since last month
                                </p>
                            </div>
                            <div class="col col-auto top-icn dash">
                                <div class="counter-icon bg-warning dash ms-auto box-shadow-warning">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-white" enable-background="new 0 0 24 24" viewBox="0 0 24 24"><path d="M9,10h2.5c0.276123,0,0.5-0.223877,0.5-0.5S11.776123,9,11.5,9H10V8c0-0.276123-0.223877-0.5-0.5-0.5S9,7.723877,9,8v1c-1.1045532,0-2,0.8954468-2,2s0.8954468,2,2,2h1c0.5523071,0,1,0.4476929,1,1s-0.4476929,1-1,1H7.5C7.223877,15,7,15.223877,7,15.5S7.223877,16,7.5,16H9v1.0005493C9.0001831,17.2765503,9.223999,17.5001831,9.5,17.5h0.0006104C9.7765503,17.4998169,10.0001831,17.276001,10,17v-1c1.1045532,0,2-0.8954468,2-2s-0.8954468-2-2-2H9c-0.5523071,0-1-0.4476929-1-1S8.4476929,10,9,10z M21.5,12H17V2.5c0.000061-0.0875244-0.0228882-0.1735229-0.0665283-0.2493896c-0.1375732-0.2393188-0.4431152-0.3217773-0.6824951-0.1842041l-3.2460327,1.8603516L9.7481079,2.0654297c-0.1536865-0.0878906-0.3424072-0.0878906-0.4960938,0l-3.256897,1.8613281L2.7490234,2.0664062C2.6731567,2.0227661,2.5871582,1.9998779,2.4996338,1.9998779C2.2235718,2.000061,1.9998779,2.223938,2,2.5v17c0.0012817,1.380188,1.119812,2.4987183,2.5,2.5H19c1.6561279-0.0018311,2.9981689-1.3438721,3-3v-6.5006104C21.9998169,12.2234497,21.776001,11.9998169,21.5,12z M4.5,21c-0.828064-0.0009155-1.4990845-0.671936-1.5-1.5V3.3623047l2.7412109,1.5712891c0.1575928,0.0872192,0.348877,0.0875854,0.5068359,0.0009766L9.5,3.0761719l3.2519531,1.8583984c0.157959,0.0866089,0.3492432,0.0862427,0.5068359-0.0009766L16,3.3623047V19c0.0008545,0.7719116,0.3010864,1.4684448,0.7803345,2H4.5z M21,19c0,1.1045532-0.8954468,2-2,2s-2-0.8954468-2-2v-6h4V19z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-1 END-->

        <!-- ROW-2 -->
        {{-- dynamic sales data in chart  --}}
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h3 class="card-title">Sales</h3>
                        @php
                            $startYear = now()->year -2;
                            $endYear = now()->year; // 2 years ahead (or more)
                            $years = range($startYear, $endYear);
                        @endphp

                        <div class="btn-group p-0 ms-auto" role="group" aria-label="Year selection">
                            @foreach($years as $year)
                                <a href="{{ route('admin.dashboard', ['year' => $year]) }}" 
                                class="btn btn-primary-light btn-sm {{ $selectedYear == $year ? 'disabled' : '' }}">
                                {{ $year }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="sales-stats d-flex">
                            <div>
                                <div class="text-muted fs-13">Total Sales
                                    <span class="p-2 br-5 {{ $salesIsIncrease ? 'text-success' : 'text-danger' }}">
                                        <i class="fe {{ $salesIsIncrease ? 'fe-arrow-up-right' : 'fe-arrow-down-right' }}"></i>
                                    </span>
                                </div>
                                <h3 class="fw-semibold">${{ number_format($totalSalesCurrentYear, 2) }}</h3>
                                <div>
                                    <span class="{{ $salesIsIncrease ? 'text-success' : 'text-danger' }} fs-13 me-1">
                                        {{ $salesPercentageChange }}%
                                    </span>
                                    {{ $salesIsIncrease ? 'Increase' : 'Decrease' }} Since Last Year
                                </div>
                            </div>
                        </div>
                        <div id="sales-chart"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ROW-2 END -->

        <!-- ROW-3 -->
        {{-- <div class="row">
            <div class="col-xl-12 col-md-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h4 class="card-title fw-semibold">Daily Activity</h4>
                    </div>
                    <div class="card-body pb-0">
                        <ul class="task-list">
                            <li>
                                <i class="task-icon bg-primary"></i>
                                <p class="fw-semibold mb-1 fs-13">New Products Introduced<span class="text-muted fs-12 ms-2 ms-auto float-end">1:43 pm</span></p>
                                <p class="text-muted fs-12">Lorem ipsum dolor sit.<a href="#"
                                        class="fw-semibold ms-1">Product Light Launched</a></p>
                            </li>
                            <li>
                                <i class="task-icon bg-secondary"></i>
                                <p class="fw-semibold mb-1 fs-13">Hermoine Replied<span class="text-muted fs-12 ms-2 float-end">6:12 am</span></p>
                                <p class="text-muted fs-12">Hermoine replied to your post on<a href="#"
                                        class="fw-semibold ms-1"> Detailed Blog</a></p>
                            </li>
                            <li>
                                <i class="task-icon bg-info"></i>
                                <p class="fw-semibold mb-1 fs-13">New Request<span class="text-muted fs-12 ms-2 float-end">11:22 am</span></p>
                                <p class="text-muted fs-12">Corner sent you a request<a href="#"
                                        class="fw-semibold ms-1"> Facebook</a></p>
                            </li>
                            <li>
                                <i class="task-icon bg-warning"></i>
                                <p class="fw-semibold mb-1 fs-13">Task Due<span class="text-muted fs-12 ms-2 float-end">4:32 pm</span></p>
                                <p class="text-muted mb-0 fs-12">Task has to be completed <a href="#"
                                        class="fw-semibold ms-1"> New Project</a></p>
                            </li>
                            <li class="mb-2">
                                <i class="task-icon bg-primary"></i>
                                <p class="fw-semibold mb-1 fs-13">Maggice Liked<span class="text-muted fs-12 ms-2 float-end">5 mins ago</span></p>
                                <p class="text-muted mb-0 fs-12">Maggice bruce liked your article <a href="#"
                                        class="fw-semibold ms-1"> Article on Projects</a></p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- ROW-3 END -->

        
    </div>

    {{-- chart scripts to show sales data  --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const options = {
            chart: {
                type: 'area',
                height: 350,
                zoom: {
                    enabled: true,
                    type: 'x',
                    autoScaleYaxis: true,
                    zoomedArea: {
                        fill: {
                            color: '#90CAF9',
                            opacity: 0.4
                        },
                        stroke: {
                            color: '#0D47A1',
                            opacity: 0.4,
                            width: 1
                        }
                    }
                },
                toolbar: {
                    show: true,
                    offsetX: 0,
                    offsetY: 0,
                    tools: {
                        download: true,
                        selection: true,
                        zoom: true,
                        zoomin: true,
                        zoomout: true,
                        pan: true,
                        reset: true,
                    },
                    autoSelected: 'zoom' // toolbar auto-selected zoom tool
                },
                animations: {
                    enabled: true,
                    easing: 'easeinout',
                    speed: 800,
                    animateGradually: {
                        enabled: true,
                        delay: 150
                    },
                    dynamicAnimation: {
                        enabled: true,
                        speed: 350
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function(val) {
                    return "$" + val.toFixed(2);
                },
                style: {
                    fontSize: '12px',
                    colors: ['#304758']
                },
                background: {
                    enabled: true,
                    foreColor: '#fff',
                    borderRadius: 3,
                    padding: 4,
                    opacity: 0.8,
                    borderWidth: 1,
                    borderColor: '#555'
                }
            },
            markers: {
                size: 5,
                colors: ['#00ab55'],
                strokeColors: '#fff',
                strokeWidth: 2,
                hover: {
                    size: 7
                }
            },
            series: [{
                name: "Total Sales",
                data: @json(array_values($monthlySales->toArray()))
            }],
            xaxis: {
                categories: @json(array_keys($monthlySales->toArray())),
                tooltip: {
                    enabled: true
                },
                labels: {
                    rotate: -45,
                    style: {
                        fontSize: '12px',
                        fontWeight: 600
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#78909C'
                },
                axisTicks: {
                    show: true,
                    color: '#78909C'
                }
            },
            yaxis: {
                labels: {
                    formatter: function (val) {
                        return '$' + val.toFixed(0);
                    }
                },
                axisBorder: {
                    show: true,
                    color: '#78909C'
                },
                axisTicks: {
                    show: true,
                    color: '#78909C'
                }
            },
            grid: {
                borderColor: '#e0e0e0',
                row: {
                    colors: ['#f3f3f3', 'transparent'],
                    opacity: 0.5
                }
            },
            tooltip: {
                enabled: true,
                theme: 'dark',
                x: {
                    format: 'MMM'
                },
                y: {
                    formatter: function (val) {
                        return '$' + val.toFixed(2);
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    opacityFrom: 0.7,
                    opacityTo: 0.1,
                    stops: [0, 90, 100]
                }
            },
            colors: ['#00ab55'],
            legend: {
                position: 'top',
                horizontalAlign: 'left',
                fontWeight: 600
            }
        };

        const chart = new ApexCharts(document.querySelector("#sales-chart"), options);
        chart.render();
    </script>

@endsection
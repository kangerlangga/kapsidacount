<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<div class="wrapper">
    <div class="main-header">
        @include('layouts.admin.nav')
    </div>
    @include('layouts.admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="panel-header" style="background: linear-gradient(to bottom right, #357e4e, #2b653f);">
                <div class="page-inner">
                    <div class="mt-2 mb-4">
						<h2 class="text-white pb-2">Welcome back, {{ Auth::user()->name }}!</h2>
						<h5 class="text-white op-7 mb-4">The journey to transformation starts with the self before it reaches the world.</h5>
					</div>
                </div>
            </div>
            <div class="page-inner mt--5">
                <div class="row mt--2">
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #357e4e">
                                            <i class="flaticon-analytics"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Pengukuran</p>
                                            <h4 class="card-title">{{ $cP }} Kali</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #357e4e">
                                            <i class="flaticon-inbox"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Total Kekurangan</p>
                                            <h4 class="card-title">{{ $cK }} Kapsul</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="card card-stats card-round">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-icon">
                                        <div class="icon-big text-center icon-info bubble-shadow-small" style="background-color: #357e4e">
                                            <i class="flaticon-stopwatch"></i>
                                        </div>
                                    </div>
                                    <div class="col col-stats ml-3 ml-sm-0">
                                        <div class="numbers">
                                            <p class="card-category">Waktu Saat Ini</p>
                                            <h4 class="card-title" id="dynamic-time">5 Nov 2024 - 10:07:20</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php if ($cK > 0) : ?>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Statistik Kekurangan Obat</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="obatStatistics"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    <?php if ($cK > 0) : ?>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Statistik Keseluruhan</div>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="summaryChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif;?>
                    @if (Auth::user()->level == 'Super Admin')
                    <div class="col-md-4">
                        <div class="card text-white" style="background: linear-gradient(to bottom right, #357e4e, #2b653f);">
                            <div class="card-body">
                                <h4 class="mt-3 b-b1 pb-2 mb-3 fw-bold">Current Active Visitors</h4>
                                <h1 class="mb-4 fw-bold">{{ $cVO }}</h1>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
<script>
    @if(session('successprof'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successprof') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @elseif(session('successlog'))
        Swal.fire({
            icon: "success",
            title: "{{ session('successlog') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif
    function updateTime() {
        const timeElement = document.getElementById('dynamic-time');
        const now = new Date();

        const options = { day: 'numeric', month: 'short', year: 'numeric' };
        const formattedDate = now.toLocaleDateString('en-GB', options);
        const formattedTime = now.toLocaleTimeString('en-GB', { hour12: false });

        timeElement.textContent = `${formattedDate} - ${formattedTime}`;
    }
    setInterval(updateTime, 1000);
    updateTime();
</script>
@include('layouts.admin.script')
<script>
    var obatStatistics = document.getElementById('obatStatistics').getContext('2d'),
    summaryChart = document.getElementById('summaryChart').getContext('2d');

    var myObatChart = new Chart(obatStatistics, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets : [{
                label: "Kekurangan Kapsul",
                backgroundColor: '#cd030c',
                borderColor: '#cd030c',
                data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero:true
                    }
                }]
            },
        }
    });

    var mySummaryChart = new Chart(summaryChart, {
        type: 'bar',
        data: {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets : [{
                label: "Sempurna",
                backgroundColor: '#285b3a',
                borderColor: '#285b3a',
                data: [30, 45, 22, 41, 54, 59, 78, 56, 88, 90, 21, 45],
            },{
                label: "Cacat",
                backgroundColor: '#cd030c',
                borderColor: '#cd030c',
                data: [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                position : 'bottom'
            },
            tooltips: {
                mode: 'index',
                intersect: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                    stacked: true,
                }],
                yAxes: [{
                    stacked: true
                }]
            }
        }
    });

</script>
@endsection

<body>
    @yield('content')
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.admin.head')
</head>

@section('content')
<style>
@media (max-width: 768px) {
    .page-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    .breadcrumbs {
        padding-left: 0 !important;
        margin-left: 0 !important;
    }
}
</style>
<div class="wrapper">
    <div class="main-header">
        @include('layouts.admin.nav')
    </div>
    @include('layouts.admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="page-header">
                    <h4 class="page-title">{{ $judul }}</h4>
                    <ul class="breadcrumbs">
                        <a href="{{ route('detect.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #357e4e">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Detections
                        </a>
                    </ul>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><b>Hasil Pengukuran</b></h4>
                            </div>
                            <div class="card-body">
                                @if ($cP >= 7)
                                <div class="chart-container">
                                    <canvas id="obatStatistics"></canvas>
                                </div>
                                @endif
                                @if ($cT >= 7)
                                <div class="chart-container">
                                    <canvas id="summaryChart"></canvas>
                                </div>
                                <hr>
                                @endif
                                <div class="table-responsive pt-3">
                                    <table id="basic-datatables-detect" class="display table table-striped table-hover">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Waktu</th>
                                                <th>Kekurangan</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach ($DataD as $D)
                                                <tr>
                                                    <td>{{ $no++ }}</td>
                                                    <td>{{ $D->created_at }}</td>
                                                    <td>{{ $D->kekurangan }}</td>
                                                    <td>{{ $D->keterangan }}</td>
                                                    <td>
														<div class="form-button-action">
                                                            <a href="{{ route('detect.edit', $D->id_detections) }}">
                                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-warning btn-lg" data-original-title="Edit">
                                                                    <i class="fa fa-edit"></i>
                                                                </button>
                                                            </a>
                                                            <a href="{{ route('detect.delete', $D->id_detections) }}" class="but-delete">
                                                                <button type="button" data-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Delete">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </a>
														</div>
													</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
<script>
    $(document).ready(function() {
        $('#basic-datatables-detect').DataTable({
        });
    });

    $(document).on('click','.but-delete',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "This data will be Permanently Deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'DELETE',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });

    @if(session('success'))
    Swal.fire({
        icon: "success",
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @elseif(session('error'))
    Swal.fire({
        icon: "error",
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000
    });
    @endif

    @if ($cP >= 7)
    var obatStatistics = document.getElementById('obatStatistics').getContext('2d');
    @endif
    @if ($cT >= 7)
    var summaryChart = document.getElementById('summaryChart').getContext('2d');
    @endif

    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('kekurangan.data') }}')
            .then(response => response.json())
            .then(data => {
                var deficiencies = data.deficiencies.reverse();
                var createdAt = data.createdAt.reverse();
                var formattedDates = createdAt.map(function(date) {
                    var parsedDate = new Date(date);
                    var month = parsedDate.toLocaleString('default', { month: 'short' });
                    var day = parsedDate.getDate();
                    var hours = parsedDate.getHours();
                    var minutes = parsedDate.getMinutes().toString().padStart(2, '0');
                    return `${day} ${month} (${hours}:${minutes})`;
                });
                var myObatChart = new Chart(obatStatistics, {
                    type: 'bar',
                    data: {
                        labels: formattedDates,
                        datasets : [{
                            label: "Kekurangan Kapsul",
                            backgroundColor: '#cd030c',
                            borderColor: '#cd030c',
                            data: deficiencies,
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
            })
        .catch(error => console.error('Error fetching data:', error));
    });

    document.addEventListener('DOMContentLoaded', function() {
        fetch('{{ route('pengukuran.data') }}')
            .then(response => response.json())
            .then(data => {
                var dates = data.dates;
                var perfectData = data.perfect;
                var defectiveData = data.defective;

                var mySummaryChart = new Chart(summaryChart, {
                    type: 'bar',
                    data: {
                        labels: dates,
                        datasets : [{
                            label: "Sempurna",
                            backgroundColor: '#285b3a',
                            borderColor: '#285b3a',
                            data: perfectData,
                        },{
                            label: "Cacat",
                            backgroundColor: '#cd030c',
                            borderColor: '#cd030c',
                            data: defectiveData,
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
            })
        .catch(error => console.error('Error fetching data:', error));
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>

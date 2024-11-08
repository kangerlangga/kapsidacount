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
                        <a href="{{ route('home.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #feb300">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Home Sliders
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataHS as $H)
                    <div class="col-md-4">
                        <div class="card card-post card-round">
                            <img class="card-img-top" src="{{ url('') }}/assets/public/img/HomeSlider/{{ $H->image_home_sliders }}" alt="...">
                            <div class="card-body">
                                <div class="d-flex">
                                    <div class="info-post ml-2">
                                        <p class="username">{{ $H->title_home_sliders }}</p>
                                        <p class="date text-muted">{{ $H->created_at->format('F d, Y') }}</p>
                                    </div>
                                </div>
                                <div class="separator-solid"></div>
                                <a href="{{ route('home.edit', $H->id_home_sliders) }}">
                                    <button type="button" class="btn btn-icon btn-round btn-warning">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                </a>
                                <a href="{{ route('home.delete', $H->id_home_sliders) }}" class="but-delete">
                                    <button type="button" class="btn btn-icon btn-round btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-icon btn-round btn-primary" data-toggle="modal" data-target="#{{ $H->id_home_sliders }}D">
                                    <i class="fas fa-info"></i>
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="{{ $H->id_home_sliders }}D" tabindex="-1" role="dialog" aria-labelledby="{{ $H->id_home_sliders }}DLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ $H->id_home_sliders }}DLabel"><b>Description</b></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ $H->desc_home_sliders }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (Auth::user()->level == 'Super Admin')
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#{{ $H->id_home_sliders }}">
                                        <i class="fas fa-history"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="{{ $H->id_home_sliders }}" tabindex="-1" role="dialog" aria-labelledby="{{ $H->id_home_sliders }}Label" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ $H->id_home_sliders }}Label"><b>Activity History</b></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Created : <br>{{ $H->created_by }} <b>({{ $H->created_at }})</b></p>
                                                    <p>Last Modified : <br>{{ $H->modified_by }} <b>({{ $H->updated_at }})</b></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
@include('layouts.admin.script')
<script>
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

    //message with sweetalert
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
</script>
@endsection

<body>
    @yield('content')
</body>
</html>

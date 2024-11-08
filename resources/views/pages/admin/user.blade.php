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
                        <a href="{{ route('user.add') }}" class="btn btn-round text-white ml-auto fw-bold" style="background-color: #feb300">
                            <i class="fa fa-plus-circle mr-1"></i>
                            New Users
                        </a>
                    </ul>
                </div>
                <div class="row">
                    @foreach ($DataU as $U)
                    <div class="col-md-4">
                        <div class="card card-profile">
                            <div class="card-header" style="background-color: #feb300">
                                <div class="profile-picture">
                                    <div class="avatar avatar-xl">
                                        <img src="{{  url('') }}/assets/admin/img/user.png" alt="..." class="avatar-img rounded-circle" style="background-color: white">
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="user-profile text-center">
                                    <div class="name">{{ $U->name }}</div>
                                    <div class="job">{{ $U->jabatan }}</div>
                                    <div class="desc">{{ $U->email }}</div>
                                    <div class="view-profile">
                                        <a href="{{ route('user.edit', $U->id_akun) }}">
                                            <button type="button" class="btn btn-icon btn-round btn-warning">
                                                <i class="fas fa-pen"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('user.delete', $U->id_akun) }}" class="but-delete">
                                            <button type="button" class="btn btn-icon btn-round btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </a>
                                        <a href="{{ route('user.resetpass', $U->id_akun) }}" class="but-resetpass">
                                            <button type="button" class="btn btn-icon btn-round btn-primary">
                                                <i class="fas fa-undo-alt"></i>
                                            </button>
                                        </a>
                                        @if (Auth::user()->level == 'Super Admin')
                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-icon btn-round btn-success" data-toggle="modal" data-target="#{{ $U->id_akun }}">
                                                <i class="fas fa-history"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="{{ $U->id_akun }}" tabindex="-1" role="dialog" aria-labelledby="{{ $U->id_akun }}Label" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="{{ $U->id_akun }}Label"><b>Activity History</b></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body" style="text-align: start">
                                                            <p>Created : <br>{{ $U->created_by }} <b>({{ $U->created_at }})</b></p>
                                                            <p>Last Modified : <br>{{ $U->modified_by }} <b>({{ $U->updated_at }})</b></p>
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

    $(document).on('click','.but-resetpass',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'The Password for This Account Will Be Reset!',
            text: "Default = Rambak*Ikaba.90681",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'RESET PASSWORD',
            cancelButtonText: 'BATAL'
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

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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" action="{{ route('prof.update.pass') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="Old-Pass">Current Password</label>
                                            <input type="password" class="form-control" id="Old-Pass" name="oldPass" value="{{ old('oldPass') }}" placeholder="Input Your Current Password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="New-Pass">New Password</label>
                                            <input type="password" class="form-control" id="New-Pass" name="newPass" value="{{ old('newPass') }}" placeholder="Input Your New Password" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Confirm-Pass') has-error has-feedback @enderror">
                                            <label for="Confirm-Pass">Confirm New Password</label>
                                            <input type="password" class="form-control" id="Confirm-Pass" name="Confirm-Pass" value="{{ old('Confirm-Pass') }}" placeholder="Input Your New Password" required>
                                            @error('Confirm-Pass')
                                            <small id="Confirm-Pass" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-check">
                                            <label class="form-check-label" for="lihat-password">
                                                <input class="form-check-input" type="checkbox" value="" id="lihat-password">
                                                <span class="form-check-sign">Show Password</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('admin.dash') }}" class="btn btn-warning fw-bold text-uppercase but-back">
                                                <i class="fas fa-chevron-circle-left mr-2"></i>Back
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.admin.footer')
    </div>
</div>
<form id="logout-admin" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
@include('layouts.admin.script')
<script>
    @if(session('success'))
        Swal.fire({
        icon: 'success',
        title: "{{ session('success') }}",
        text: 'You will be Logout in a Few Seconds!',
        showConfirmButton: false,
        timer: 5000
        })
        setTimeout(
        function(){
            document.getElementById('logout-admin').submit();
        },
        5000);
    @elseif(session('error'))
        Swal.fire({
            icon: "error",
            title: "{{ session('error') }}",
            showConfirmButton: false,
            timer: 3000
        });
    @endif

    $(document).ready(function() {
        $('#lihat-password').click(function() {
            if ($(this).is(':checked')) {
                $('#Old-Pass').attr('type', 'text');
                $('#New-Pass').attr('type', 'text');
                $('#Confirm-Pass').attr('type', 'text');
            } else {
                $('#Old-Pass').attr('type', 'password');
                $('#New-Pass').attr('type', 'password');
                $('#Confirm-Pass').attr('type', 'password');
            }
        });
    });

    $(document).on('click','.but-back',function(e) {

        e.preventDefault();
        const href1 = $(this).attr('href');

        Swal.fire({
            title: 'Are you sure?',
            text: "Changes will not be Saved!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'BACK',
            cancelButtonText: 'CANCEL'
            }).then((result) => {
            if (result.isConfirmed) {
                document.location.href = href1;
            }
        });
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>

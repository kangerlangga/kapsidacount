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
                            <form method="POST" action="{{ route('user.update', $EditUser->id_akun) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Nama') has-error has-feedback @enderror">
                                            <label for="Nama">Name</label>
                                            <input type="text" id="Nama" name="Nama" value="{{ old('Nama', $EditUser->name) }}" class="form-control" required>
                                            @error('Nama')
                                            <small id="Nama" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Address') has-error has-feedback @enderror">
                                            <label for="Address">Address</label>
                                            <input type="text" id="Address" name="Address" value="{{ old('Address', $EditUser->alamat) }}" class="form-control" required>
                                            @error('Address')
                                            <small id="Address" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Position') has-error has-feedback @enderror">
                                            <label for="Position">Position</label>
                                            <input type="text" id="Position" name="Position" value="{{ old('Position', $EditUser->jabatan) }}" class="form-control" required>
                                            @error('Position')
                                            <small id="Position" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Email">Email (Cannot Be Changed)</label>
                                            <input class="form-control" name="Email" value="{{ $EditUser->email }}" id="Email" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Phone') has-error has-feedback @enderror">
                                            <label for="Phone">Phone Number</label>
                                            <input type="tel" id="Phone" name="Phone" value="{{ old('Phone', $EditUser->telp) }}" class="form-control" required>
                                            @error('Phone')
                                            <small id="Phone" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Level">Level User</label>
                                            <select class="form-control" id="Level" name="Level">
                                                <option name='Level' value='Admin' {{ $EditUser->level == 'Admin' ? 'selected' : '' }}>Admin</option>
                                                <option name='Level' value='Super Admin' {{ $EditUser->level == 'Super Admin' ? 'selected' : '' }}>Super Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('user.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
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
@include('layouts.admin.script')
<script type="text/javascript">
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

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
                            <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Nama') has-error has-feedback @enderror">
                                            <label for="Nama">Name</label>
                                            <input type="text" id="Nama" name="Nama" value="{{ old('Nama') }}" class="form-control" required>
                                            @error('Nama')
                                            <small id="Nama" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Address') has-error has-feedback @enderror">
                                            <label for="Address">Address</label>
                                            <input type="text" id="Address" name="Address" value="{{ old('Address') }}" class="form-control" required>
                                            @error('Address')
                                            <small id="Address" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Position') has-error has-feedback @enderror">
                                            <label for="Position">Position</label>
                                            <input type="text" id="Position" name="Position" value="{{ old('Position') }}" class="form-control" required>
                                            @error('Position')
                                            <small id="Position" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Email') has-error has-feedback @enderror">
                                            <label for="Email">Email</label>
                                            <input type="email" id="Email" name="Email" value="{{ old('Email') }}" class="form-control" required>
                                            @error('Email')
                                            <small id="Email" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Phone') has-error has-feedback @enderror">
                                            <label for="Phone">Phone Number</label>
                                            <input type="tel" id="Phone" name="Phone" value="{{ old('Phone') }}" class="form-control" required>
                                            @error('Phone')
                                            <small id="Phone" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Level">Level User</label>
                                            <select class="form-control" id="Level" name="Level">
                                                <option name='Level' value='Admin'>Admin</option>
                                                <option name='Level' value='Super Admin'>Super Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <button type="reset" class="btn btn-warning fw-bold text-uppercase">
                                                <i class="fas fa-undo mr-2"></i>Reset
                                            </button>
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
<script>
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

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
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                            <form method="POST" action="{{ route('home.update', $EditHomeS->id_home_sliders) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Images') has-error has-feedback @enderror">
                                            <label for="Images">
                                                Image Sliders (PNG, JPG, JPEG)
                                                <span class="d-sm-none"><br></span>
                                                <span style="color: red;">Max 3 MB</span>
                                                <span class="d-none d-sm-inline"> | </span>
                                                <span class="d-sm-none"><br></span>
                                                Standard Size 1920px x 1080px
                                            </label>
											<input type="file" class="form-control-file" id="Images" name="Images" accept=".png, .jpg, .jpeg">
                                            @error('Images')
                                            <small id="Images" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Title') has-error has-feedback @enderror">
                                            <label for="Title">Title</label>
                                            <input type="text" id="Title" name="Title" value="{{ old('Title', $EditHomeS->title_home_sliders) }}" class="form-control" required>
                                            @error('Title')
                                            <small id="Title" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group @error('Desc') has-error has-feedback @enderror">
                                            <label for="Desc">Description</label>
                                            <input type="text" id="Desc" name="Desc" value="{{ old('Desc', $EditHomeS->desc_home_sliders) }}" class="form-control" required>
                                            @error('Desc')
                                            <small id="Desc" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="visibility">Visibility</label>
                                            <select class="form-control" id="visibility" name="visibility">
                                                <option name='visibility' value='Showing' {{ $EditHomeS->visib_home_sliders == 'Showing' ? 'selected' : '' }}>Showing (Publish)</option>
                                                <option name='visibility' value='Hiding' {{ $EditHomeS->visib_home_sliders == 'Hiding' ? 'selected' : '' }}>Hiding (Unpublish)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('home.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
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

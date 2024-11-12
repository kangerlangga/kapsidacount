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
                            <form method="POST" action="{{ route('detect.update', $EditDetection->id_detections) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Blitzer') has-error has-feedback @enderror">
                                            <label for="Blitzer">Jumlah Blitzer</label>
                                            <input type="number" id="Blitzer" name="Blitzer" min="1" value="{{ old('Blitzer', $EditDetection->blitzer) }}" class="form-control" required onchange="calculateDeficiency()">
                                            @error('Blitzer')
                                            <small id="Blitzer" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @error('Capsule') has-error has-feedback @enderror">
                                            <label for="Capsule">Jumlah Kapsul</label>
                                            <input type="number" id="Capsule" name="Capsule" min="0" value="{{ old('Capsule', $EditDetection->kapsul) }}" class="form-control" required onchange="calculateDeficiency()">
                                            @error('Capsule')
                                            <small id="Capsule" class="form-text text-muted">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Deficiency">Kekurangan Kapsul</label>
                                            <input type="number" id="Deficiency" name="Deficiency" min="0" class="form-control" value="{{ $EditDetection->kekurangan }}" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="Status">Keterangan</label>
                                            <input type="text" id="Status" name="Status" class="form-control" value="{{ $EditDetection->keterangan }}" readonly style="cursor: not-allowed">
                                        </div>
                                    </div>
                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success fw-bold text-uppercase">
                                                <i class="fas fa-save mr-2"></i>Save
                                            </button>
                                            <a href="{{ route('detect.data') }}" class="btn btn-warning fw-bold text-uppercase but-back">
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

    function calculateDeficiency() {
        const blitzer = document.getElementById('Blitzer').value || 0;
        const capsuleInput = document.getElementById('Capsule');
        const requiredCapsules = blitzer * 12;
        const capsule = capsuleInput.value || 0;
        const deficiency = requiredCapsules - capsule;
        capsuleInput.max = requiredCapsules;
        document.getElementById('Deficiency').value = deficiency > 0 ? deficiency : 0;
        document.getElementById('Status').value = deficiency > 0 ? "Cacat" : "Sempurna";
    }
</script>
@endsection

<body>
    @yield('content')
</body>
</html>

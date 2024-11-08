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
                            <form method="POST" action="{{ route('message.update', $DetailM->id_messages) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Sender Name</label>
                                            <p class="form-control-static">{{ $DetailM->name_messages }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Sender Email</label>
                                            <p class="form-control-static">{{ $DetailM->email_messages }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Sender Phone</label>
                                            <p class="form-control-static">{{ $DetailM->phone_messages }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Subject</label>
                                            <p class="form-control-static">{{ $DetailM->subject_messages }}</p>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label class="control-label">Message</label>
                                            <p class="form-control-static">{!! nl2br(e($DetailM->content_messages)) !!}</p>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 mt-1">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger fw-bold text-uppercase but-unread">
                                                <i class="fas fa-envelope mr-2"></i>Mark as Unread
                                            </button>
                                            <a href="{{ route('message.data') }}" class="btn btn-success fw-bold text-uppercase">
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
    $(document).on('click', '.but-unread', function(e) {

        e.preventDefault();

        Swal.fire({
            title: 'Are you sure?',
            text: "This message will be marked as unread!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#fd7e14',
            confirmButtonText: 'Mark as Unread',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                $(this).closest('form').submit();
            }
        });
    });
</script>
@endsection

<body>
    @yield('content')
</body>
</html>

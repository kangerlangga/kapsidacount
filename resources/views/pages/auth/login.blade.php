<!DOCTYPE html>
<html lang="en">
<head>
    <!-- PRECONNECT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="preconnect" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://www.w3.org">
    <link rel="preconnect" href="https://www.w3.org">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- SIMPLE META -->
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="id-ID">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name="google" content="notranslate">
    <meta name="googlebot" content="index,follow">
    <meta name="author" content="Kapsida">
    <meta name="language" content="id">
    <meta name="geo.country" content="id">
    <meta name="geo.placename" content="Indonesia">
    <meta name="robots" content="all,index,follow">
	<meta NAME="Distribution" CONTENT="Global">
	<meta NAME="Rating" CONTENT="General">

    <!-- WEBSITE META -->
    <title>{{ $judul }} | Kapsida Count</title>
    <link rel="icon" type="image/png" href="{{  url('') }}/assets/logo/logo.png">

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

    <!-- Source Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">

</head>
<body>
    <div id="preloader"></div>
    <style>
    #preloader {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 9999;
    overflow: hidden;
    background: #fff;
    }
    #preloader:before {
    content: "";
    position: fixed;
    top: calc(50% - 30px);
    left: calc(50% - 30px);
    border: 6px solid #357e4e;
    border-top-color: #e7e4fe;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    animation: animate-preloader 1s linear infinite;
    }
    @keyframes animate-preloader {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
    </style>
    <main class="container my-5">
    <div class="row">
        <section class="col-md-6 my-5 offset-md-3">

        <div class="card shadow p-5">
        <form method="POST" action="{{ route('login.verifikasi') }}" enctype="multipart/form-data">
            @csrf

            <h3 class="text-center mb-4" style="font-family: Roboto;">Login Admin</h3>
            <hr>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <label for="password">Password</label>
            <div class="input-group mb-3">
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Your Password" aria-label="Enter Password" aria-describedby="basic-addon2" required>
                <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2"><i class="fa fa-eye" aria-hidden="true"></i>
                </span>
                </div>
            </div>

            <button class="btn btn-block rounded-pill mt-3 pt-2 pb-2 fw-bold text-white" style="font-size: medium;"><b>LOGIN</b></button>

            <p class="mt-3">Back to Home? <a href="{{ url('') }}">Click Here</a></p>

        </form>
        </div>
        </section>
    </div>
    </main>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap');
        main .card {
        background-color: #fff;
        }

        body {
        background: #357e4e;
        color: black;
        }

        h3 {
        font-family: Times New Roman;
        font-weight: bold;
        }
        hr {
        border-bottom: solid black 1px;
        }

        .btn {
        background: #357e4e;
        border-color: #357e4e;
        }

        .btn:hover {
        background: #2b653f;
        border-color: #2b653f;
        }

        input {
        background-color: #fff !important;
        color: black !important;
        }

        ::placeholder {
        color: darkslategrey !important;
        }
    </style>
    <script type="text/javascript">
    $(document).ready(function () {
        $("#basic-addon2").click(function () {
            let passwordField = $("#password");
            let passwordFieldAttr = passwordField.attr("type");

            if (passwordFieldAttr == "password") {
            passwordField.attr("type", "text");
            $(this).html('<i class="fa fa-eye-slash" aria-hidden="true"></i>');
            } else {
            passwordField.attr("type", "password");
            $(this).html('<i class="fa fa-eye" aria-hidden="true"></i>');
            }
        });
    });

    @error('email')
        Swal.fire({
            icon: 'error',
            title: 'Login Failed!',
            text: 'Your email or password is incorrect!',
            showConfirmButton: false,
            timer: 3000
        });
    @enderror

    @error('password')
        Swal.fire({
            icon: 'error',
            title: 'Login Failed!',
            text: 'Your email or password is incorrect!',
            showConfirmButton: false,
            timer: 3000
        });
    @enderror

</script>
<!-- Template Main JS File -->
<script src="{{  url('') }}/assets/public/js/main2.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

</body>
</html>

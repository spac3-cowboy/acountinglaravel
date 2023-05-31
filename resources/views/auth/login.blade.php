<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="" name="description" />
    <meta content="" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- Theme Config Js -->
    <script src="{{ asset('backend/assets/js/hyper-config.js') }}"></script>

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app-saas.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="authentication-bg">
<div class="account-pages pt-2 pt-sm-5 pb-4 pb-sm-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xxl-4 col-lg-5">
                <div class="card">

                    <!-- Logo -->
                    <div class="card-header py-4 text-center bg-primary">
                        <a href="#">
                            <span><img src="{{ asset('front-end/assets/images/Red.png')}}" alt="logo" height="50"></span>
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <h4 class="text-dark-50 text-center pb-0 fw-bold">Sign In</h4>
                            <p class="text-muted mb-4">Enter your email address and password to access admin panel.</p>
                        </div>


                        <form action="{{ route('login') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email"  required="" >
                            </div>

                            <div class="mb-3">
                                {{-- <a href="pages-recoverpw.html" class="text-muted float-end"><small>Forgot your password?</small></a> --}}
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" name="password" class="form-control" placeholder="Enter your password"  required="" >
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="mb-3 mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div> --}}

                            <div class="mb-3 mb-0 text-center">
                                <button type="submit" class="btn btn-primary"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


                <!-- end row -->

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>
<!-- end page -->

<footer class="footer footer-alt">
    <script>document.write(new Date().getFullYear())</script> ©<a href=""></a>
</footer>
<!-- Vendor js -->
<script src="{{ asset('backend/assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('backend/assets/js/app.min.js') }}"></script>

</body>


</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Registration</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a class="h1"><b>Admin</b>LTE</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form action="{{ route('registerSave') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" value="{{ old('name')}}"
                            class="form-control @error('name') is-invalid @enderror" name="name"
                            placeholder="Full name">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    @error('name')
                        <span class="error text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="number" value="{{ old('mobile')}}"
                            class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                            placeholder="1234567890">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                    </div>
                    @error('mobile')
                        <span class="error text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="email" value="{{ old('email')}}"
                            class="form-control @error('email') is-invalid @enderror" name="email"
                            placeholder="Example@gmail.com">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                            <span class="error text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="input-group mt-3">
                        <input type="password" value="{{ old('password')}}"
                            class="form-control @error('password') is-invalid @enderror" name="password"
                            placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @error('password')
                        <span class="error text-danger">{{$message}}</span>
                    @enderror
                    <div class="input-group mt-3">
                        <input type="password" value="{{ old('password_confirmation')}}"
                            class="form-control @error('password_confirmation') is_invalid @enderror"
                            name="password_confirmation" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password_confirmation')
                            <span class="error text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="input-group mt-3">
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">Select Role</option>
                            <option value="reader">Reader</option>
                            <option value="admin">Admin</option>
                        </select>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user-gear"></span>
                            </div>
                        </div>
                        @error('role')
                            <span class="error text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="row mt-4">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                                <label for="agreeTerms">
                                    I agree to the <a href="#">terms</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">
                    <a href="#" class="btn btn-block btn-primary">
                        <i class="fab fa-facebook mr-2"></i>
                        Sign up using Facebook
                    </a>
                    <a href="#" class="btn btn-block btn-danger">
                        <i class="fab fa-google-plus mr-2"></i>
                        Sign up using Google+
                    </a>
                </div>

                <a href="{{route('login')}}" class="text-center">I already have a membership</a>

                {{-- @if ($error->any())
                <div class="card-footer text-body-secoundry">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($error->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif --}}
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
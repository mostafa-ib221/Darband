<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.boss.head.meta')
    <title>Darband Restaurant: Login to manager panel</title>
    @include('layouts.boss.head.style')
    @yield('css')
    @include('layouts.boss.head.js')
    <style>
        #layoutAuthentication {
            background-image: url("{{ asset('home/img/bg_index.png') }}");
            height: 100vh;
            background-repeat: no-repeat;
            display: flex;
            /*align-items: center;*/
        }
    </style>
</head>
{{--<body class="bg-primary">--}}
<body>
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5 persianAll">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Login</h3></div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Email</label>
                                        <input name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror py-4" id="inputEmailAddress" type="email" placeholder="Please enter email" />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input name="password" class="form-control @error('password') is-invalid @enderror py-4" id="inputPassword" type="password" placeholder="Please enter password" />
                                    </div>
                                    {{--<div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" name="remember" />
                                            <label class="custom-control-label" for="rememberPasswordCheck" {{ old('remember') ? 'checked' : '' }}>مرا به خاطر داشته باش</label>
                                        </div>
                                    </div>--}}
                                  @if (Route::has('password.request'))
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        {{--<a class="small" href="{{ route('password.request') }}">گذرواژه را فراموش کردید؟</a>--}}
                                        <button type="submit" class="btn" style="background-color: #17B68D;color: #FFF !important;">Login</button>
                                    </div>
                                  @endif
                                </form>
                            </div>
                            {{-- <div class="card-footer text-center">
                                 <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                             </div>--}}
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    {{--<div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2019</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>--}}
</div>
@include('layouts.boss.body.js')
</body>
</html>

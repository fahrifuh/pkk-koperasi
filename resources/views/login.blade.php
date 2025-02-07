<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <title>Login | RW 14 Cihurip</title>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image" style="max-width: 300px">
                    <img src="{{ asset('/img/logo-koperasi.png') }}" width="100%" >
                </div>
            </div>
            <div class="col-md-6 right-box">
                <div class="row align-items-center">
                    <div class="header-text mb-4 text-center">
                        <h2>Log In</h2>
                        <p>Log In ke akun koperasi Anda.</p>
                    </div>
                    <form action="{{ route('login.submit') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                                    @foreach ($errors->all() as $item)
                                        <p class="text-danger mw-100 fst-italic">{{ $item }}</p>
                                    @endforeach
                        @endif
                        <div class="input-group mb-3">
                            <input type="text" class="form-control form-control-lg border-dark rounded-pill fs-6"
                                placeholder="Username" name="username" id="username" autocomplete="off" />
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg border-dark rounded-pill fs-6"
                                placeholder="Password" name="password" id="password" />
                        </div>
                        {{-- <div class="input-group mb-5 d-flex justify-content-between">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="formCheck" />
                                <label for="formCheck" class="form-check-label text-secondary"><small>Remember
                                        Me</small></label>
                            </div>
                            <div class="forgot">
                                <small><a href="#" class="nav-link">Forgot Password?</a></small>
                            </div>
                        </div> --}}
                        <div class="input-group my-3">
                            <button class="btn btn-lg btn-dark rounded-pill mx-auto w-50 fw-bold fs-6">Log In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/scripts.js') }}"></script>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Login Modern</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&display=swap'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
        @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
    </div>
        @endif

        @if (session('loginError'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('loginError') }}
    </div>
        @endif
            <div class="login-header">
                <span>Login</span>
            </div>
            @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    <ul>
                        @foreach($errors->all() as $item)
                            <li>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input_box">
                    <input type="email" id="email" name="email" class="form-control input-field @error('email')is-invalid @enderror" autofocus required value="{{ old('email') }}" required>
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" id="password" name="password" class="input-field form-control" required>
                    <label for="password" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                    @error('name')
                    <div class="invalid-feedback">
                    Please fill in a valid email address.
                    </div>
                    @enderror
                </div>
                <div class="remember-forgot">
                    <div class="remember-me">
                        <input type="checkbox" id="remember">
                        <label for="remember">Remember me</label>
                    </div>
                    <div class="forgot">
                        <a href="{{ route('password.request') }}">Forgot the password?</a>
                    </div>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="Login">
                </div>
                <div class="register">
                    <span>Don't have an account yet? <a href="{{ route('register') }}">Register</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Reset</span>
            </div>
            <h2>Reset Password</h2>

            <!-- Menampilkan pesan error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Menampilkan pesan sukses -->
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <!-- Formulir untuk reset password -->
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input_box">
                    <input type="email" id="email" name="email" class="form-control input-field" autofocus required value="{{ old('email') }}" autocomplete="email">
                    <label for="email" class="label">Email address</label>
                </div>
                <div class="input_box">
                    <input type="password" class="input-field" id="password" name="password" required autocomplete="new-password">
                    <label for="password" class="label">New Password</label>
                </div>
                <div class="input_box">
                    <input type="password" class="input-field" id="password_confirmation" name="password_confirmation" required autocomplete="password-confirmation">
                    <label for="password_confirmation" class="label">Confirm Password</label>
                </div>
                <button type="submit" class="input-submit">Reset Password</button>
            </form>
        </div>
    </div>
</body>
</html>

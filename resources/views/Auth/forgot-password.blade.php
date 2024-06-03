<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="{{ asset('css/login.css') }}" rel="stylesheet">
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Forgot</span>
            </div>
            <h2>Forgot Password</h2>

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

            <!-- Formulir untuk mengirim email reset password -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input_box">
                    <input type="email" id="email" name="email" class="form-control input-field" autofocus required>
                    <label for="email" class="label">Email address</label>
                </div>
                <button type="submit" class="input-submit">Send Password Reset Link</button>
            </form>
        </div>
    </div>
</body>
</html>

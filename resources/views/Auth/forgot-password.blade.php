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

            <!-- Formulir untuk mengirim email reset password -->
            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="input_box">
                    <input type="email" id="email" name="email" class="form-control input-field" autofocus required>
                    <label for="email" class="label">Email address</label>
                </div>
                <button type="submit" class="input-submit">Send Password Reset Link</button>
            </form><br>
            <div class="register">
                <span>Already have an account? <a href="{{ route('login') }}">Login</a></span>
            </div>
        </div>
    </div>

    <!-- jQuery and SweetAlert2 -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert2 for displaying messages -->
    <script>
        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: '{!! implode('<br>', $errors->all()) !!}'
            });
        @endif

        @if (session('status'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('status') }}'
            });
        @endif
    </script>
</body>
</html>

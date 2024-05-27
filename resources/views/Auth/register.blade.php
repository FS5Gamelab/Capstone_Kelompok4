<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Registrasi Modern</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&display=swap'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }
        :root {
            --primary-color: #c6c3c3;
            --second-color: #ffffff;
            --black-color: #000000;
        }
        body {
            background-image: url("http://codingstella.com/wp-content/uploads/2024/01/download-6-scaled.jpeg");
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
        a {
            text-decoration: none;
            color: var(--second-color);
        }
        a:hover {
            text-decoration: underline;
        }
        .wrapper {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: rgba(0, 0, 0, 0.2);
            padding: 20px;
        }
        .login_box {
            position: relative;
            width: 450px;
            backdrop-filter: blur(25px);
            border: 2px solid var(--primary-color);
            border-radius: 15px;
            padding: 7.5em 2.5em 4em 2.5em;
            color: var(--second-color);
            box-shadow: 0px 0px 10px 2px rgba(0, 0, 0, 0.2);
        }
        
        .login-header {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: var(--primary-color);
            width: 140px;
            height: 70px;
            border-radius: 0 0 20px 20px;
        }
        .login-header span {
            font-size: 25px;
            color: var(--black-color);
        }
        .input_box {
            position: relative;
            display: flex;
            flex-direction: column;
            margin: 20px 0;
        }
        .input-field {
            width: 100%;
            height: 55px;
            font-size: 16px;
            background: transparent;
            color: var(--second-color);
            padding-inline: 20px 50px;
            border: 2px solid var(--primary-color);
            border-radius: 30px;
            outline: none;
        }
        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            transition: 0.2s;
        }
        .input-field:focus ~ .label,
        .input-field:valid ~ .label {
            top: -10px;
            left: 20px;
            font-size: 14px;
            background-color: var(--primary-color);
            border-radius: 30px;
            color: var(--black-color);
            padding: 0 10px;
        }
        .icon {
            position: absolute;
            top: 18px;
            right: 25px;
            font-size: 24px;
        }
        .input-submit {
            width: 100%;
            height: 50px;
            background: #ececec;
            font-size: 16px;
            font-weight: 500;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            transition: 0.3s;
        }
        .input-submit:hover {
            background: var(--second-color);
        }
        .register {
            text-align: center;
            color: var(--black-color);
        }
        .register a {
            font-weight: 500;
        }
        @media only screen and (max-width: 768px) {
            .login_box {
                width: 100%;
                padding: 6em 1.5em 4em 1.5em;
            }
            .login-header {
                width: 180px;
                height: 70px;
                font-size: 20px;
            }
        }
        @media only screen and (max-width: 480px) {
            .login_box {
                width: 100%;
                padding: 7.5em 1em 4em 1em;
            }
            .login-header {
                width: 150px;
                height: 60px;
                font-size: 18px;
            }
            .input-field {
                height: 50px;
                font-size: 16px;
            }
            .label {
                font-size: 14px;
            }
            .input-field:focus ~ .label,
            .input-field:valid ~ .label {
                top: -10px;
                left: 15px;
                font-size: 12px;
                padding: 0 8px;
            }
            .icon {
                font-size: 20px;
            }
            .input-submit {
                height: 45px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="login_box">
            <div class="login-header">
                <span>Registrasi</span>
            </div>
            <!-- Form Registrasi -->
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="input_box mb-3">
                    <input type="text" id="name" name="name" class="form-control input-field @error('name')is-invalid @enderror" autofocus required required value="{{ old('name') }}">
                    <label for="name" class="label">Name</label>
                    <i class="bx bx-user icon"></i>
                    @error('name')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Mohon masukkan nama Anda.
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="text" id="username" name="username" class="form-control input-field @error('username')is-invalid @enderror" required value="{{ old('username') }}">
                    <label for="username" class="label">Username</label>
                    <i class="bx bx-lock-alt icon"></i>
                    @error('username')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Username harus diisi
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="email" id="email" name="email" class="form-control input-field @error('email')is-invalid @enderror" required value="{{ old('email') }}">
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-envelope icon"></i>
                    @error('email')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Mohon isi dengan alamat email yang valid
                    </div>
                    @enderror
                </div>
                <div class="input_box mb-3">
                    <input type="password" id="pass" name="password" class="form-control input-field @error('password')is-invalid @enderror" required>
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                    @error('password')
                    <div id="validationServerUsernameFeedback" class="invalid-feedback">
                    Password tidak boleh kosong
                    </div>
                    @enderror
                <div class="input_box mb-3">
                    <input type="submit" class="input-submit btn btn-primary text-dark" value="Registrasi">
                </div>
            </form>
            <!-- Tautan untuk login -->
            <div class="register">
                <span>Sudah punya akun? <a href="{{ route('login') }}">Login</a></span>
            </div>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Registrasi Modern</title>
    <link rel='stylesheet' href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins&display=swap'>
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
            font-size: 30px;
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
        #user {
            margin-bottom: 10px;
        }
        .label {
            position: absolute;
            top: 15px;
            left: 20px;
            transition: 0.2s;
        }
        .input-field:focus ~ .label,
        .input-field:valid ~ .label {
            position: absolute;
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
            font-size: 20px;
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
        }
        .register a {
            font-weight: 500;
        }
        @media only screen and (max-width: 564px) {
            .wrapper {
                padding: 20px;
            }
            .login_box {
                padding: 7.5em 1.5em 4em 1.5em;
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
            <form action="#" method="POST">
                <div class="input_box">
                    <input type="text" id="user" name="username" class="input-field" required>
                    <label for="user" class="label">Username</label>
                    <i class="bx bx-user icon"></i>
                </div>
                <div class="input_box">
                    <input type="email" id="email" name="email" class="input-field" required>
                    <label for="email" class="label">Email</label>
                    <i class="bx bx-envelope icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" id="pass" name="password" class="input-field" required>
                    <label for="pass" class="label">Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="password" id="confirm_pass" name="confirm_password" class="input-field" required>
                    <label for="confirm_pass" class="label">Konfirmasi Password</label>
                    <i class="bx bx-lock-alt icon"></i>
                </div>
                <div class="input_box">
                    <input type="submit" class="input-submit" value="Registrasi">
                </div>
            </form>
            <!-- Tautan untuk login -->
            <div class="register">
                <span>Sudah punya akun? <a href="#">Login</a></span>
            </div>
        </div>
    </div>
</body>
</html>

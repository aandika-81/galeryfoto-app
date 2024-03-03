<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="{{ asset('css/build.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: '', sans-serif;
            background-color: #a1d4d2;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .container h3 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #4CAF50;
        }

        .btn-container {
            text-align: center;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .text-small {
            font-size: 12px;
            color: #888;
            text-align: center;
            margin-top: 20px;
        }

        .text-small a {
            color: #4CAF50;
            text-decoration: none;
        }

        .text-small a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3>Register</h3>
        @if ($errors->has('password'))
        <script>
            alert("{{ $errors->first('password') }}");
        </script>
        @endif
        @if(Session::has('error'))
        <div class="notification is-danger">
            <button class="delete"></button>
            Email sudah terdaftar.
        </div>
        @endif
        <form action="/buat_akun" method="post" onsubmit="return validateForm()">
            @csrf
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn">Register</button>
            </div>
            <p class="text-small">Already a member? <a href="sign_in">Log in</a></p>
        </form>
    </div>
</body>

</html>

{{-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Office maintenance System</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <p><b>Admin </b>Login</p>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <form method="POST" action="{{ url('admin/login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="text" placeholder="Username or Email" class="form-control"
                            name="email" :value="old('email')" required autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" id="password"
                            type="password" name="password" required autocomplete="current-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </div>
                </form>
                <p class="mb-1">
                </p>
                <p class="mb-0">
            </div>
        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('admin-assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('admin-assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin-assets') }}/dist/js/adminlte.min.js"></script>
</body>

</html> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        .form-wrapper {
            display: flex;
            flex-direction: row;
            height: 100%;
        }

        .left-section {
            flex: 1;
            background-color: #3B4CB8;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .left-section h1 {
            margin-bottom: 10px;
        }

        .left-section a {
            color: white;
            text-decoration: none;
        }

        .left-section form {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
        }

        .left-section form input {
            margin-bottom: 15px;
            padding: 15px;
            border: none;
            border-radius: 5px;
        }

        label {
            margin-bottom: 7px;
            color: #bcdde7;
        }

        .left-section form button {
            padding: 15px;
            border: none;
            border-radius: 5px;
            background-color: #7A96D5;
            color: white;
            cursor: pointer;
            margin-top: 20px;
            transition: .3s;
            font-weight: 600
        }

        .left-section form button:hover {
            background-color: #3749a3;
        }

        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .right-section img {
            max-width: 100%;
            height: auto;
        }

        .link a{
            font-size: 14px;
            color: rgb(241, 239, 239);
            margin-right: 10px !important;
        }
        
        .link a:hover{
            color: rgb(147, 191, 236);
            border-bottom: 1px solid rgb(147, 191, 236);
        }

        @media (max-width: 767px) {
            .form-wrapper {
                flex-direction: column;
                height: auto;
            }

            .left-section form input {
                margin-bottom: 15px;
                padding: 15px;
                font-size: 14px;
                border: none;
                border-radius: 5px;
            }

            label {
                font-size: 14px;
                margin-bottom: 7px;
                color: #bcdde7;
            }

            .right-section {
                order: -1;
                /* Ensures the logo appears above the form */
                padding: 20px;
            }

            .left-section h1 {
                font-size: 28px;
            }

            .left-section p {
                font-size: 14px;
            }

            .right-section img {
                width: 50px;
                height: auto;
            }
        }

        @media (min-width: 768px) {

            .left-section form input {
                margin-bottom: 15px;
                padding: 15px;
                font-size: 14px;
                border: none;
                border-radius: 5px;
            }

            label {
                font-size: 14px;
                margin-bottom: 7px;
                color: #bcdde7;
            }

            .form-wrapper {
                flex-direction: row;
                height: 100%;
                /* Ensure height is 100% for larger screens */
            }

            .right-section {
                order: 2;
                flex: 1;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .left-section h1 {
                font-size: 28px;
            }

            .left-section p {
                font-size: 14px;
            }
            .left-section {
                order: 1;
                flex: 1;
            }
        }
    </style>
</head>

<body>
    <div class="form-wrapper">
        <div class="right-section">
            <img src="{{ asset('admin-assets/dist/img/logo.JPG') }}" alt="Flat Master Logo">
        </div>
        <div class="left-section">
            <h1>Let's you sign in</h1>
            <p>Welcome to Flat Master</p>
            @if (Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    <strong class="text-danger">{{ Session::get('message') }}!</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="POST" action="{{ url('admin/login') }}">
                @csrf
                <label for="">Email</label>
                <input type="email" placeholder="Email" class="mt-2" name="email" required>
                <label for="">Password</label>
                <input type="password" placeholder="Password" name="password" required>
                <button type="submit">Sign In</button>
            </form>
            
        </div>
    </div>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AutoHub</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('{{ asset('images/cars.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: #fff;
            text-shadow: 0 2px 4px rgba(0,0,0,0.6);
        }
        .overlay {
            background-color: rgba(0, 0, 0, 0.55);
            height: 100%;
            width: 100%;
            position: absolute;
            top: 0; left: 0;
        }
        .content {
            position: relative;
            z-index: 2;
            text-align: center;
            top: 30%;
        }
    </style>
</head>

<body>
    <div class="overlay"></div>

    <div class="content">
        <h1 class="display-4 fw-bold"> Welcome to <span class="text-warning">AutoHub</span></h1>
        <p class="lead mb-5">Manage your factories, cars, and dealers in one place.</p>
        <a href="{{ route('login') }}" class="btn btn-lg btn-primary mx-2">Login</a>
        <a href="{{ route('register') }}" class="btn btn-lg btn-outline-light mx-2">Register</a>
    </div>
</body>
</html>

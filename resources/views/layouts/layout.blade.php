<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cars Factory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- HEADER -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Cars Factory</a>
            <div>
                <a class="nav-link d-inline text-white" href="/cars">Cars</a>
                <a class="nav-link d-inline text-white" href="/factories">Factories</a>
                <a class="nav-link d-inline text-white" href="/dealers">Dealers</a>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <div class="container">
        @yield('content')
    </div>

    <!-- FOOTER -->
    <footer class="bg-dark text-white text-center py-3 mt-4">
        <p>&copy; 2025 Cars Factory Project</p>
    </footer>

</body>
</html>

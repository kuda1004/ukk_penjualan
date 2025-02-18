<!-- resources/views/errors/404.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .error-container {
            text-align: center;
        }
        .error-container h1 {
            font-size: 6rem;
            font-weight: bold;
            color: #dc3545;
        }
        .error-container h3 {
            font-size: 2rem;
            margin-top: 20px;
        }
        .error-container a {
            margin-top: 30px;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        .error-container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="error-container">
        <h1>404</h1>
        <h3>Oops! The page you are looking for does not exist.</h3>
        <a href="{{ url('/') }}">Back to Home</a>
    </div>

</body>
</html>

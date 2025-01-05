<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .container {
            text-align: center;
        }
        .container h1 {
            font-size: 10rem;
            margin: 0;
        }
        .container h2 {
            font-size: 2rem;
            margin: 0;
        }
        .container p {
            font-size: 1.2rem;
            margin: 20px 0;
        }
        .container a {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007bff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .container a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for does not exist.</p>
        <a href="{{ url('/') }}">Go to Homepage</a>
    </div>
</body>
</html>
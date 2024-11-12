<!-- In resources/views/errors/admin.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8d7da;
            color: #721c24;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .error-container {
            text-align: center;
        }
        .error-title {
            font-size: 3rem;
            font-weight: bold;
        }
        .error-message {
            font-size: 1.5rem;
        }
        .error-icon {
            font-size: 5rem;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-icon">🚫</div>
        <div class="error-title">Access Denied</div>
        <div class="error-message">You do not have permission to access this page.</div>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Go to Homepage</a>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blocked Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .blocked-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .blocked-card {
            max-width: 400px;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .blocked-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #dc3545;
        }
        .blocked-text {
            margin-bottom: 20px;
        }
        .blocked-back-btn {
            display: block;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="blocked-container">
        <div class="blocked-card">
            <h2 class="blocked-title">Account Blocked</h2>
            <p class="blocked-text">Your account has been blocked due to violation of our terms of use. If you believe this is a mistake, please contact our support team.</p>
            <a href="index.php" class="btn btn-danger blocked-back-btn">Back to Home</a>
        </div>
    </div>
</body>
</html>

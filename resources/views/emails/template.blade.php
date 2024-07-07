<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins';
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(10px);
            position: relative;
            z-index: 1;
        }
        .content {
            padding: 40px 30px;
            text-align: center;
            background-color: rgba(2, 48, 71, 0.9);
            border-radius: 8px;
        }
        .content h2 {
            color: #FFB703;
            font-size: 24px;
            margin: 0 0 20px;
            font-weight: 600;
        }
        .content p {
            font-size: 16px;
            line-height: 1.6;
            color: #FFB703;
            margin: 0 0 20px;
        }
        .footer {
            background-color: rgba(242, 242, 242, 0.9);
            color: #999999;
            padding: 20px 30px;
            text-align: center;
            font-size: 14px;
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
        }
        .footer p {
            margin: 0;
        }
    </style>
    <title>Welcome Email</title>
</head>
<body>
    <div class="background"></div>
    <div class="container">
        <div class="content">
            <h2>Welcome {{ $name }}</h2>
            <p>{{ $text }}</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Laraveldude. All rights reserved.</p>
        </div>
    </div>
</body>
</html>

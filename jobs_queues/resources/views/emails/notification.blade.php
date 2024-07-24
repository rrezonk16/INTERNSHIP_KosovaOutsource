<!DOCTYPE html>
<html>
<head>
    <title>Notification Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
        }
        .header img {
            max-width: 150px;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            padding-top: 20px;
            border-top: 1px solid #eaeaea;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="https://localhost:8000/logo.png" alt="KosovoOutsource Logo">
            <!-- Doesnt open we need a domain for that  -->
        </div>
        <div class="content">
            <p>Hello,</p>
            <h1>{{ $details['title'] }}</h1>
            <p>{{ $details['body'] }}</p>
        </div>
        <div class="footer">
            <p>This email is from KosovoOutsource.</p>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #123524;
            margin: 0;
            font-family: Arial, sans-serif;
            padding: 16px;
        }
        .container {
            width: 800px;
            margin: auto;
            max-width: 400px;
            background-color: #1D3A12;
            padding: 24px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        h1{
            color: white;
            font-size: 20px;
        }
        h2 {
            color: #E0E0E0;
            font-size: 18px;
        }
        p {
            color: #A0A0A0;
            margin-bottom: 16px;
        }
        .button {
            background-color: #16a34a;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 100%;
            max-width: 250px;
            cursor: pointer;
        }

        .button:hover {
            background-color: #15803d;
            text-decoration: none;
        }
        a {
            color: #1E90FF;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        .footer-link {
            margin-top: 16px;
            font-size: 14px;
            color: #A0A0A0;
        }
        .footer-link a {
            color: #A0A0A0;
            text-decoration: underline;
        }
        .description {
            border-bottom: 2px solid #A0A0A0;
            padding-bottom: 16px;
            margin-bottom: 16px;
        }
        .image-small {
            width: 96px;
            margin: 24px auto;
            border-radius: 12px;
        }
        .logo {
            width: 100px;
            margin-bottom: 20px;
        }
        @media (max-width: 480px) {
            .container {
                padding: 16px;
            }
            h2 {
                font-size: 20px;
            }
            p {
                font-size: 14px;
            }
            button {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="img">
        <img src="https://img.icons8.com/?size=100&id=JHPnLnKgEV8m&format=png&color=000000" alt="Logo" class="logo"> <!-- Change URL to your image URL -->

    </div>

    <h1>Hello {{ $email  }}</h1>

    <h2>Reset your password</h2>

    <p class="description">
        If you have forgotten your password, click the button below to receive a reset link via email.
    </p>

    <a href="" class="button">Send Reset Link</a>

    <div class="footer-link">
        <p><a href="http://localhost:3000/auth/login">Go back to Login</a></p>
    </div>
</div>
</body>
</html>

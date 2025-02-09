<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            background-color: #123524;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #1D3A12;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
            padding: 20px;
        }

        .name_website {
            color: white !important;
        }

        .content {
            padding: 20px;
        }

        .content p {
            color: white;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .content .font-bold {
            font-weight: bold;
        }

        .link {
            display: flex;
            justify-content: center;
        }

        .button {
            background-color: #16a34a;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
            text-align: center;
            margin-bottom: 24px;
            transition: background-color 0.3s ease;
            display: inline-block;
            width: 100%;
            max-width: 250px;
        }

        .button:hover {
            background-color: #15803d;
        }

        .image img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            margin-bottom: 24px;
        }

        .list {
            list-style-type: disc;
            list-style-position: inside;
            color: white;
            margin-left: 24px;
            margin-bottom: 24px;
        }

        .list li {
            margin-bottom: 8px;
            line-height: 28px;
        }

        .image-small {
            width: 96px;
            margin: 24px auto;
            border-radius: 12px;
        }

        @media screen and (max-width: 768px) {
            .container {
                max-width: 100%;
                margin: 10px;
                padding: 15px;
            }

            .header h1 {
                font-size: 20px;
            }

            .content p {
                font-size: 16px;
            }

            .list li {
                font-size: 14px;
            }

            .button {
                width: 100%;
            }

            .footer p {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Welcome to agriculture.com</h1>
    </div>

    <div class="content">
        <p>Hi <span class="font-bold name_website">{{ $full_name }}</span>,</p>

        <p>Thank you for signing up! To explore our resources and features, please verify your email address:</p>

        <div class="text-center link">
            <a href="http://localhost:80/validate/email" class="button">Verify My Account</a>
        </div>

        <div class="image">
            <img src="https://images.unsplash.com/photo-1509099381441-ea3c0cf98b94?q=80&w=2072&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Farmer in a field">
        </div>

        <p class="font-bold">Once your account is verified, you’ll gain access to:</p>
        <ul class="list">
            <li><span class="font-bold">Like and Comment on Blogs:</span> Share your thoughts and connect with others.</li>
            <li><span class="font-bold">Share Blogs Easily:</span> Spread knowledge with your network.</li>
            <li><span class="font-bold">Exclusive Courses:</span> Enroll in expert-led courses on sustainable farming and modern techniques.</li>
            <li><span class="font-bold">Stay Updated:</span> Get personalized tips and industry trends, and more.</li>
        </ul>

        <div class="image-small">
            <img src="https://img.icons8.com/?size=100&id=JHPnLnKgEV8m&format=png&color=000000" alt="Icons representing features">
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2025 agriculture.com. All Rights Reserved.</p>
        <p class="small">agriculturecontact@agriculture.com | +212 661450238</p>
    </div>
</div>
</body>
</html>

{{-- template email after register --}}

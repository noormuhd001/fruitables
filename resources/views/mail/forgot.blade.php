<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        p {
            margin-bottom: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .footer {
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Hello, {{ $user->name }}!</h1>
        <p>Welcome to our platform. To Create a New Password, please verify your email address.</p>
        <p>
            Please click the following link to Confirm New password:
            <br>
            <a href="{{ route('email.verify', ['email' => $user->email]) }}">Create New Password</a>
        </p>
        <p>If you did not create an account, no further action is required.</p>
        <div class="footer">
            <p>Thank you,</p>
            <p>Fruitables</p>
        </div>
    </div>
</body>

</html>

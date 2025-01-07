<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        form {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        form h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        form input {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            transition: border-color 0.3s ease;
        }

        form input:focus {
            border-color: #6a11cb;
            outline: none;
        }

        form button {
            width: 100%;
            padding: 12px;
            background: #6a11cb;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        form button:hover {
            background: #2575fc;
        }

        form p {
            font-size: 14px;
            color: #555;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form method="POST" action="/agentie/users/forgot_password">
        <h1>Forgot Password</h1>
        <input type="email" name="email" placeholder="Enter your email" required>
        <button type="submit">Send Reset Code</button>
        <p>We’ll send you a reset code to your email.</p>
    </form>
</body>
</html>

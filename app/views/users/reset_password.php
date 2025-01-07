<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #4facfe, #00f2fe);
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        .form-container h1 {
            font-size: 22px;
            margin-bottom: 15px;
            color: #333;
        }

        .form-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .form-container input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }

        .form-container input:focus {
            border-color: #4facfe;
            outline: none;
        }

        .form-container button {
            padding: 10px;
            background: #4facfe;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .form-container button:hover {
            background: #008cdd;
        }
    </style>
</head>
<body>
     <?php
        // Check if email was sent via POST
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    ?>
    <div class="form-container">
        <h1>Reset Password</h1>
        <form method="POST" action="/agentie/users/reset">
            <input type="email" name="email" placeholder="Enter your email" value="<?php echo $email; ?>" required>
            <input type="text" name="reset_code" placeholder="Enter reset code" required>
            <input type="password" name="password" placeholder="Enter new password" required>
            <button type="submit">Reset Password</button>
        </form>
    </div>
</body>
</html>

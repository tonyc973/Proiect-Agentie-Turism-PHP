<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Registration</title>
<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background: linear-gradient(to right, #4e54c8, #8f94fb);
        color: #333;
    }

    .container {
        width: 100%;
        max-width: 400px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
        color: #4e54c8;
    }

    form {
        display: flex;
        flex-direction: column;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    input:focus {
        outline: none;
        border-color: #4e54c8;
    }

    .error-message {
        color: red;
        text-align: center;
        margin-bottom: 15px;
        font-weight: bold;
    }

    input[type="submit"] {
        padding: 10px;
        background-color: #4e54c8;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #3b3fbb;
    }

    p {
        text-align: center;
        margin-top: 10px;
    }

    a {
        color: #4e54c8;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>

<div class="container">
    <h2>Register</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p class="error-message"><?= $_SESSION['error'] ?></p>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <form action="/agentie/users/register" method="POST">
        <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
        <input type="submit" value="Register">
    </form>
    <p>Already have an account? <a href="/agentie/users/login">Login here</a></p>
</div>

</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Homepage</title>
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
        max-width: 500px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        text-align: center;
    }

    h1 {
        color: #4e54c8;
        margin-bottom: 20px;
    }

    p {
        font-size: 16px;
        margin-bottom: 20px;
        color: #555;
    }

    .button-container {
        display: flex;
        justify-content: space-around;
    }

    .btn {
        padding: 10px 20px;
        background-color: #4e54c8;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .btn:hover {
        background-color: #3b3fbb;
    }

    .btn-secondary {
        background-color: #007BFF;
    }

    .btn-secondary:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>

<div class="container">
    <h1>Welcome to Our Services</h1>
    <p>To access our services, you need to have an account. Please login or register to continue.</p>
    <div class="button-container">
        <a href="/caietul_mereu/users/login" class="btn">Login</a>
        <a href="/caietul_mereu/users/register" class="btn btn-secondary">Register</a>
    </div>
</div>

</body>
</html>

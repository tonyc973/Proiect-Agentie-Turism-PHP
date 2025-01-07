<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adaugă Rezervare</title>
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

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #4e54c8;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: #4e54c8;
        }

        button {
            padding: 10px;
            background-color: #4e54c8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #3b3fbb;
        }

        a {
            display: block;
            text-align: center;
            color: #4e54c8;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Book a Tour</h1>
    <form method="POST" action="">
        <!--
        <label for="user_email">Email utilizator:</label>
        <input type="text" name="user_email" id="user_email" required> 
    -->
        
        <label for="tour_id">ID Tour:</label>
        <input type="number" name="tour_id" id="tour_id" required>
        
        <label for="participants">Number of participants:</label>
        <input type="number" name="participants" id="participants" required>
        
        <label for="status">Status:</label>
        <select name="status" id="status" required>
            <option value="confirmed">Confirmed</option>
            <option value="pending">Pending</option>
            <option value="cancelled">Cancelled</option>
        </select>
        <input type="hidden" name="csrf_token" value="<?php echo Booking::generateCSRFToken(); ?>">
        <button type="submit">Save</button>
    </form>

    <a href="/agentie/tours/index">Back to the tours list</a>
</div>

</body>
</html>

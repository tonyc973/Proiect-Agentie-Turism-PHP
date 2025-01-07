<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Booking</title>
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
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        input:focus, select:focus {
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
        <h1>Edit Booking</h1>
        <?php if (isset($booking)): ?>
            <form method="POST" action="">
                <!-- User Email -->
                <label for="user_email">User Email:</label>
                <input type="text" id="user_email" name="user_email" value="<?= htmlspecialchars($booking['user_email']) ?>" required>
                <br><br>

                <!-- Tour ID -->
                <label for="tour_id">Tour ID:</label>
                <input type="text" id="tour_id" name="tour_id" value="<?= htmlspecialchars($booking['tour_id']) ?>" required>
                <br><br>

                <!-- Participants -->
                <label for="participants">Participants:</label>
                <input type="number" id="participants" name="participants" value="<?= htmlspecialchars($booking['participants']) ?>" required>
                <br><br>

                <!-- Status -->
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Pending" <?= $booking['status'] === 'Pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="Confirmed" <?= $booking['status'] === 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                    <option value="Cancelled" <?= $booking['status'] === 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
                <br><br>

                <!-- Submit Button -->
                <input type="hidden" name="csrf_token" value="<?php echo Booking::generateCSRFToken(); ?>">
                <a href="agentie/tours/index">
                <button type="submit">Save Changes</button>
                </a>
            </form>
        <?php else: ?>
            <p>Booking not found or invalid ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>

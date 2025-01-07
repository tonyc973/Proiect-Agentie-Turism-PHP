<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Bookings List</title>
    <style>
        /* General Reset and Styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        /* Header Styling */
        h1 {
            color: #4e54c8;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            max-width: 1100px;
            margin-top: 20px;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 1rem;
        }

        th {
            background-color: #4e54c8;
            color: #fff;
            font-weight: bold;
        }

        td {
            background-color: #fff;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #e6e6e6;
        }

        /* Status Badge Styling */
        .status {
            display: inline-block;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 5px;
        }

        .status.active {
            background-color: #4caf50;
            color: #fff;
        }

        .status.pending {
            background-color: #ffa500;
            color: #fff;
        }

        .status.cancelled {
            background-color: #f44336;
            color: #fff;
        }

        /* Back Button Styling */
        .back-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4e54c8;
            color: #fff;
            text-decoration: none;
            text-align: center;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .back-btn:hover {
            background-color: #3b3fbb;
        }

        /* Responsive Design for Smaller Screens */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            table {
                width: 100%;
                margin-top: 10px;
                font-size: 0.9rem;
            }

            th, td {
                padding: 8px;
            }
        }
        .edit-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #ffa500;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

.edit-btn:hover {
    background-color: #e59400;
}

.delete-btn {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f44336; /* Red for delete */
    color: #fff;
    text-decoration: none;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.delete-btn:hover {
    background-color: #d32f2f; /* Darker red on hover */
}

    </style>
</head>
<body>

    <div>
        <h1> <?= htmlspecialchars($_SESSION['first_name']); ?> Bookings List</h1>
        <h3>  If you want to delete a booking, please cancel it first </h3>
        <table>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Email</th>
            <th>Tour ID</th>
            <th>Participants</th>
            <th>Booking Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php if (is_array($bookings)): ?>
        <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?= htmlspecialchars($booking['booking_id']) ?></td>
                <td><?= htmlspecialchars($booking['user_email']) ?></td>
                <td><?= htmlspecialchars($booking['tour_id']) ?></td>
                <td><?= htmlspecialchars($booking['participants']) ?></td>
                <td><?= htmlspecialchars($booking['booking_date']) ?></td>
                <td>
                    <span class="status <?= strtolower(htmlspecialchars($booking['status'])) ?>">
                        <?= htmlspecialchars($booking['status']) ?>
                    </span>
                </td>
            <td>
                    <div class="action-buttons">
                        <!-- Edit Button Form -->
                        <form method="POST" action="/agentie/bookings/edit">
                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']) ?>">
                            <button type="submit" class="edit-btn">Edit Booking</button>
                        </form>
                        <!-- Delete Button Form -->
                        <form action="/agentie/bookings/delete" method="POST">
                            <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']) ?>">
                            <button type="submit" class="delete-btn">Delete</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php else: ?>
    <tr><td colspan="7">No bookings found.</td></tr>
    <?php endif; ?>
    </tbody>
</table>


        <!-- Back Button (styled as a button) -->
        <a href="/agentie/tours/index" class="back-btn">Back to the tours list</a>
    </div>

</body>
</html>

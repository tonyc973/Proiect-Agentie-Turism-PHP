<?php
// Ensure the user is logged in before displaying the page content
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /agentie/users/login");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours List</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #f4f9ff, #eef7fc);
            color: #333;
            padding: 0 20px 40px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #0056B3;
            font-size: 2.8rem;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: #0056B3;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 5px;
            transition: background 0.3s ease;
        }

        .navbar a:hover {
            background-color: #004085;
        }

        .navbar .welcome-message {
            color: #fff;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .navbar .admin-buttons {
            display: flex;
            gap: 10px;
        }

        /* Welcome Section */
        .welcome-container {
            text-align: center;
            background: #fff;
            padding: 30px 20px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .welcome-container h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #0056B3;
        }

        .welcome-container .big-button {
            display: inline-block;
            padding: 12px 25px;
            font-size: 16px;
            margin: 10px;
            color: #fff;
            background: linear-gradient(to right, #0056B3, #007BFF);
            text-decoration: none;
            border-radius: 8px;
            transition: transform 0.2s, background 0.3s ease;
        }

        .welcome-container .big-button:hover {
            transform: translateY(-2px);
            background: linear-gradient(to right, #004085, #0056B3);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            border-radius: 12px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
        }

        th {
            background: linear-gradient(to right, #0056B3, #007BFF);
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            text-transform: uppercase;
        }

        td {
            font-size: 0.9rem;
            border-bottom: 1px solid #eee;
        }

        tr:hover td {
            background-color: #f9fbff;
        }

        tr:last-child td {
            border-bottom: none;
        }

        td[data-label]::before {
            content: attr(data-label);
            font-weight: bold;
            margin-right: 10px;
            color: #0056B3;
            display: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }

            th {
                display: none;
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            td[data-label]::before {
                display: inline-block;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <span class="welcome-message">Welcome, <?= htmlspecialchars($_SESSION['first_name']); ?>!</span>
        <div>
            <?php if ($_SESSION['role'] === 'admin'): ?>
                <div class="admin-buttons">
                    <a href="/agentie/users/index">User List</a>
                    <a href="/agentie/analytics/session_details">Website Analytics</a>
                    <a href="/agentie/tours/create">Create tour</a>
                </div>
            <?php endif; ?>
            <a href="/agentie/users/logout">Logout</a>
        </div>
    </div>

    <!-- Welcome Section -->
    <div class="welcome-container">
        <h2>Your Adventure Awaits!</h2>
        <a href="/agentie/bookings/createbook" class="big-button">Create New Booking</a>
        <a href="/agentie/bookings/mybookings" class="big-button">View My Bookings</a>
        <a href="/agentie/contact/contact" class="big-button">Contact us</a>
    </div>

    <!-- Tours Table -->
    <h1>Tours List</h1>
    <p>Welcome to our curated list of exclusive tours, tailored to give you unforgettable experiences. Whether you're seeking breathtaking landscapes, cultural immersion, or thrilling adventures, we have something for everyone. Browse through the tours below to find the perfect destination that matches your interests. Each tour is carefully designed with your comfort and excitement in mind, complete with detailed descriptions, pricing, and dates. Get ready to create lasting memories—your journey starts here!</p>
    <table>
        <thead>
            <tr>
                <th>Tour ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Price</th>
                <th>Destination</th>
                <th>Tour Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tours as $tour): ?>
                <tr>
                    <td data-label="Tour ID"><?= htmlspecialchars($tour['tour_id']) ?></td>
                    <td data-label="Title"><?= htmlspecialchars($tour['title']) ?></td>
                    <td data-label="Description"><?= htmlspecialchars($tour['description']) ?></td>
                    <td data-label="Price">$<?= htmlspecialchars(number_format($tour['price'], 2)) ?></td>
                    <td data-label="Destination"><?= htmlspecialchars($tour['destination']) ?></td>
                    <td data-label="Tour Date"><?= htmlspecialchars($tour['tour_date']) ?></td>
                    <td data-label="Created At"><?= htmlspecialchars($tour['created_at']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>
</html>

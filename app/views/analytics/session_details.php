<?php 
    session_start();
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header('Location: /agentie/users/login');
        exit();
    }

    // Add export functionality
    if (isset($_POST['export_csv'])) {
        exportToCSV($sessions);
    }

    if (isset($_POST['export_json'])) {
        exportToJSON($sessions);
    }

    function exportToCSV($sessions) {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="session_data.csv"');
        $output = fopen('php://output', 'w');
        fputcsv($output, ['Session ID', 'User ID', 'Session Start', 'Session End', 'Duration (seconds)', 'Created At']);
        
        foreach ($sessions as $session) {
            fputcsv($output, $session);
        }
        
        fclose($output);
        exit();
    }

    function exportToJSON($sessions) {
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="session_data.json"');
        echo json_encode($sessions);
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Session Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
    <style>
        /* General Page Styling */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
        }

        h1, h2 {
            text-align: center;
            color: #444;
        }

        h1 {
            margin: 20px 0;
            font-size: 2.5em;
        }

        h2 {
            margin: 30px 0 10px;
            font-size: 1.8em;
        }

        /* Table Styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        table th, table td {
            padding: 10px 15px;
            text-align: center;
        }

        table th {
            background-color: #4CAF50;
            color: #fff;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #e9f7df;
        }

        /* Chart Styling */
        .chart-container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        canvas {
            max-width: 100%;
        }

        /* Footer Styling */
        footer {
            text-align: center;
            padding: 20px;
            margin-top: 20px;
            background-color: #4CAF50;
            color: white;
        }

        /* Export Buttons */
        .export-buttons {
            text-align: center;
            margin: 20px;
        }

        .export-buttons button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 1.1em;
        }

        .export-buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <h1>User Session Analytics</h1>

    <div class="export-buttons">
        <form method="POST" style="display:inline;">
            <button type="submit" name="export_csv">Export to CSV</button>
        </form>
        <form method="POST" style="display:inline;">
            <button type="submit" name="export_json">Export to JSON</button>
        </form>
    </div>

    <h2>Session Details</h2>
    <table border="1">
        <tr>
            <th>Session ID</th>
            <th>User ID</th>
            <th>Session Start</th>
            <th>Session End</th>
            <th>Duration (seconds)</th>
            <th>Created At</th>
        </tr>
        <?php foreach ($sessions as $session): ?>
            <tr>
                <td><?php echo htmlspecialchars($session['id']); ?></td>
                <td><?php echo htmlspecialchars($session['user_id']); ?></td>
                <td><?php echo htmlspecialchars($session['session_start']); ?></td>
                <td><?php echo htmlspecialchars($session['session_end']); ?></td>
                <td><?php echo htmlspecialchars($session['duration']); ?></td>
                <td><?php echo htmlspecialchars($session['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <!-- Total Duration Pie Chart -->
    <h2>Total Duration by User</h2>
    <div class="chart-container">
        <canvas id="durationChart"></canvas>
    </div>

    <!-- Total Sessions Line Chart -->
    <h2>Sessions Over Time</h2>
    <div class="chart-container">
        <canvas id="sessionsChart"></canvas>
    </div>

    <footer>
        &copy; <?php echo date("Y"); ?> User Session Analytics. All Rights Reserved.
    </footer>

    <script>
        // Prepare data for the total duration chart
        const userDurations = <?php echo json_encode($userDurations); ?>;
        const userLabels = Object.keys(userDurations);
        const durationData = Object.values(userDurations);

        // Total Duration Pie Chart
        const durationCtx = document.getElementById('durationChart').getContext('2d');
        new Chart(durationCtx, {
            type: 'pie',
            data: {
                labels: userLabels,
                datasets: [{
                    label: 'Total Duration (seconds)',
                    data: durationData,
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
            }
        });

        // Prepare data for the sessions over time chart
        const sessionCounts = <?php echo json_encode($sessionCounts); ?>; 
        const sessionLabels = Object.keys(sessionCounts);
        const sessionData = Object.values(sessionCounts);

        // Sessions Over Time Line Chart
        const sessionsCtx = document.getElementById('sessionsChart').getContext('2d');
        new Chart(sessionsCtx, {
            type: 'line',
            data: {
                labels: sessionLabels,
                datasets: [{
                    label: 'Number of Sessions',
                    data: sessionData,
                    borderColor: '#36A2EB',
                    borderWidth: 2,
                    fill: false,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                },
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Time',
                            color: '#333',
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sessions',
                            color: '#333',
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>

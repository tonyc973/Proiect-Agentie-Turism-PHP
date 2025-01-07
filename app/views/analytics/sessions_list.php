<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Session Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1, h2 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            text-align: center;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        .chart-container {
            width: 90%;
            max-width: 600px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .fallback-message {
            text-align: center;
            color: #888;
            font-size: 18px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>User Session Analytics</h1>

    <!-- Table for detailed session data -->
    <h2>Session Details</h2>
    <table>
        <tr>
            <th>Session ID</th>
            <th>User ID</th>
            <th>Session Start</th>
            <th>Session End</th>
            <th>Duration (seconds)</th>
            <th>Created At</th>
        </tr>
        <?php if (!empty($sessions)): ?>
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
        <?php else: ?>
            <tr>
                <td colspan="6">No session data available</td>
            </tr>
        <?php endif; ?>
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

    <!-- JavaScript for charts -->
    <script>
        // Data for Total Duration by User Chart
        const userDurations = <?php echo json_encode($userDurations); ?>;
        const userLabels = Object.keys(userDurations);
        const durationData = Object.values(userDurations);

        if (userLabels.length && durationData.length) {
            const durationCtx = document.getElementById('durationChart').getContext('2d');
            new Chart(durationCtx, {
                type: 'pie',
                data: {
                    labels: userLabels,
                    datasets: [{
                        label: 'Total Duration (seconds)',
                        data: durationData,
                        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
                        hoverOffset: 10,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => `${context.label}: ${context.raw} seconds`,
                            }
                        }
                    },
                }
            });
        } else {
            document.getElementById('durationChart').outerHTML = `<div class="fallback-message">No data available for Total Duration by User.</div>`;
        }

        // Data for Sessions Over Time Chart
        const sessionCounts = <?php echo json_encode($sessionCounts); ?>;
        const sessionLabels = Object.keys(sessionCounts);
        const sessionData = Object.values(sessionCounts);

        if (sessionLabels.length && sessionData.length) {
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
                        pointBackgroundColor: '#36A2EB',
                        fill: false,
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: (context) => `Sessions: ${context.raw}`,
                            }
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Date',
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: 'Number of Sessions',
                            }
                        }
                    }
                }
            });
        } else {
            document.getElementById('sessionsChart').outerHTML = `<div class="fallback-message">No data available for Sessions Over Time.</div>`;
        }
    </script>
</body>
</html>

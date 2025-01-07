<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users List</title>
    <style>
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


        h1 {
            color: #4e54c8;
            font-size: 2.5rem;
            margin-bottom: 20px;
            text-align: center;
        }


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

        .role {
            display: inline-block;
            padding: 5px 10px;
            font-weight: bold;
            border-radius: 5px;
        }

        .role.admin {
            background-color: #4caf50;
            color: #fff;
        }

        .role.user {
            background-color: #ffa500;
            color: #fff;
        }

        .role.guest {
            background-color: #f44336;
            color: #fff;
        }

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
    </style>
</head>
<body>

    <div>
        <h1>Users List</h1>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Role</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $user['user_id'] ?></td>
                        <td><?= htmlspecialchars($user['first_name']) ?></td>
                        <td><?= htmlspecialchars($user['last_name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['password']) ?></td>
                        <td>
                            <span class="role <?= strtolower($user['role']) ?>">
                                <?= htmlspecialchars($user['role']) ?>
                            </span>
                        </td>
                        <td><?= $user['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>
</html>

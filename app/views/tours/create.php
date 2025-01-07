<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Tour</title>
    <style>
        /* General body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the form */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            box-sizing: border-box;
        }

        /* Title Styling */
        h1 {
            text-align: center;
            color: #333;
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Error message styling */
        .error {
            color: #e74c3c;
            background-color: #f8d7da;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        /* Form element styling */
        input, textarea, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1rem;
        }

        input:focus, textarea:focus {
            border-color: #007bff;
            outline: none;
        }

        button {
            background-color: #007bff;
            color: #fff;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Placeholder text styling */
        ::placeholder {
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h1>Create New Tour</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="/agentie/tours/store">
            <input type="text" name="title" placeholder="Tour Title" required>
            <textarea name="description" placeholder="Tour Description" required></textarea>
            <input type="number" step="0.01" name="price" placeholder="Tour Price" required>
            <input type="date" name="tour_date" placeholder="Tour Date" required>
            <input type="text" name="destination" placeholder="Tour Destination" required>
            <button type="submit">Create Tour</button>
        </form>
    </div>

</body>

</html>

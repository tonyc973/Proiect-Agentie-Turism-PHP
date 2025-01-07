<!-- contact_form.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .contact-form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="email"], textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0 16px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            height: 150px;
            resize: vertical;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .captcha-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        #captcha-image {
            border-radius: 4px;
        }

        #refresh-captcha {
            background-color: #e0e0e0;
            border: none;
            padding: 6px 12px;
            font-size: 14px;
            cursor: pointer;
            border-radius: 4px;
        }

        #refresh-captcha:hover {
            background-color: #bdbdbd;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        /* Responsive design */
        @media (max-width: 600px) {
            .contact-form-container {
                padding: 20px;
            }

            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="contact-form-container">
        <h1>Contact us</h1>
        <form action="/agentie/contact/send" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message:</label>
            <textarea id="message" name="message" required></textarea>

            <!-- CAPTCHA -->
            <label for="captcha">Introduce the code:</label>
            <div class="captcha-container">
                <img id="captcha-image" src="/agentie/captcha.php" alt="CAPTCHA Image">
                <button type="button" id="refresh-captcha">🔄 Refresh</button>
            </div>
            <input type="text" id="captcha" name="captcha" required>
            
            <button type="submit">Trimite</button>
        </form>
        <div class="form-footer">
            <p>Please complete all fields.</p>
        </div>
    </div>

    <script>
        document.getElementById('refresh-captcha').addEventListener('click', function () {
            const captchaImage = document.getElementById('captcha-image');
            captchaImage.src = '/agentie/captcha.php?rand=' + Math.random();
        });
    </script>
</body>
</html>

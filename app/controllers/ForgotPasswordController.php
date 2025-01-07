<?php
require_once 'app/models/User.php';

require_once __DIR__ . '/../../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../../PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



class ForgotPasswordController {
    
    public static function show1() {
        require_once 'app/views/users/forgot_password.php';
    }
    
    public static function show2()
    {
        require_once 'app/views/users/reset_password.php';
    }

    // Handle reset request (form submission for email)
    public static function handleResetRequest() {
        
        // Check if the form has been submitted (i.e., email provided)
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];

            // Validate email
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $user = User::getUserByEmail($email);

                if ($user) {
                    // Generate reset code
                    $resetCode = random_int(100000, 999999); // 6-digit code
                    $expiration = date('Y-m-d H:i:s', strtotime('+15 minutes'));

                    // Save reset code and expiration
                    User::update([
                    'reset_code' => $resetCode,
                    'reset_code_expiration' => $expiration,
                    'email' => $email // Include the email parameter here
                    ]);

                    // Send reset code via email using PHPMailer
                    $mail = new PHPMailer(true);
                    try {
                        // Server settings
                        $mail->isSMTP();
                        $mail->Host = 'mail.roglia.ro'; // Adresa serverului SMTP
                        $mail->SMTPAuth = true;
                        $mail->Username = 'tony@roglia.ro'; // Adresa de email de la care trimite
                        $mail->Password = 'Ton1que5(2025)'; // Parola emailului
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        // Recipients
                        $mail->setFrom('tony@roglia.ro', 'Tony Roglia'); //
                        $mail->addReplyTo($email, 'Tony Roglia'); // User's email
                        $mail->addAddress('tony@roglia.ro', 'Tony Roglia'); 

                        // Content
                        $mail->isHTML(true);
                        $mail->Subject = 'Password Reset Code';
                        $mail->Body    = "Your reset code is: $resetCode";

                        $mail->send();
                       // echo "Reset code sent to your email.";
                        header('Location: /agentie/users/reset_password');
                    } catch (Exception $e) {
                        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "Email not found.";
                }
            } else {
                echo "Invalid email.";
            }
        }
    }

   public static function handlePasswordUpdate() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'], $_POST['reset_code'], $_POST['password'])) {
        $email = $_POST['email'];
        $resetCode = $_POST['reset_code'];
        $newPassword = $_POST['password'];

        $user = User::getUserByEmail($email);
        if ($user) {
            // Verify reset code and expiration
            if ($user['reset_code'] === $resetCode && strtotime($user['reset_code_expiration']) > time()) {
                // Update password
                $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
                User::update_([
                    'password' => $hashedPassword,
                    'reset_code' => null, // Clear reset code
                    'reset_code_expiration' => null,
                    'email' => $email // Use correct variable
                ]);

                // Redirect to login page
                header('Location: /agentie/users/login');
                exit();  

            } else {
                echo "Invalid or expired reset code.";
            }
        } else {
            echo "Invalid email.";
        }
    }
}

}
?>

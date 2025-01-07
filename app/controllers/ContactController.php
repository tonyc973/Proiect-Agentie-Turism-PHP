<?php
require_once __DIR__ . '/../../PHPMailer-master/src/PHPMailer.php';
require_once __DIR__ . '/../../PHPMailer-master/src/SMTP.php';
require_once __DIR__ . '/../../PHPMailer-master/src/Exception.php';
require_once __DIR__ . '/../../config/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContactController {

    // Afișează formularul de contact
    public static function show() {
        require_once 'app/views/contact/contact.php';
    }

    // Procesează formularul și trimite emailul
    public static function send_email() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Preia datele din formular
            $name = $_POST['name'];
            $email = $_POST['email'];
            $message = $_POST['message'];
            
             $captcha = $_POST['captcha'];

        // Validate CAPTCHA
        if (empty($captcha) || $captcha !== $_SESSION['captcha']) {
            die("Codul CAPTCHA introdus este incorect. Vă rugăm să încercați din nou.");
        }

        // Clear CAPTCHA after validation
        unset($_SESSION['captcha']);

            // Configurează PHPMailer
            $mail = new PHPMailer(true);

            try {
                // Setează opțiunile de trimitere
                $mail->isSMTP();
                $mail->Host = 'mail.roglia.ro'; // Adresa serverului SMTP
                $mail->SMTPAuth = true;
                $mail->Username = 'tony@roglia.ro'; // Adresa de email de la care trimite
                $mail->Password = 'Ton1que5(2025)'; // Parola emailului
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Setează expeditorul și destinatarul
                $mail->setFrom('tony@roglia.ro', 'Tony Roglia'); // Expeditor
                $mail->addReplyTo($email, $name); // User's email
                $mail->addAddress('tony@roglia.ro', 'Tony Roglia'); // Destinatar
                
                // Setează subiectul și corpul emailului
                $mail->Subject = 'Mesaj din formularul de contact';
                $mail->Body    = "Nume: $name\nEmail: $email\nMesaj: $message";

                // Trimite emailul
                $mail->send();

                // Redirect la o pagină de succes
                header('Location: /agentie/tours/index');
                exit;
            } catch (Exception $e) {
                // În caz de eroare, arată mesajul de eroare
                echo "Nu s-a putut trimite emailul. Erroare: {$mail->ErrorInfo}";
            }
        }
    }

    // Pagina de succes după trimiterea emailului
    public static function success() {
    require_once 'app/views/contact/success.php';
    }
}
?>

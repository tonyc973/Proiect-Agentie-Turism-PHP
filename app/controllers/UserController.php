<?php
require_once "app/models/User.php";
require_once "app/models/UserSessionModel.php";


class BaseController {
    public function __construct() {
        session_start();
        ini_set('session.cookie_secure', 1);
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_samesite', 'Strict');
        session_regenerate_id(true);

        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > 900) {
            session_unset();
            session_destroy();
            header("Location: /agentie/users/login");
            exit();
        }
        $_SESSION['last_activity'] = time(); // Update last activity timestamp
    }
}


class UserController extends BaseController{

    public static function index() {
    session_start();  // Start the session if not already started
    
    // Check if the session is set and the role is 'admin'
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $users = User::getAllUsers();
        require_once "app/views/users/index.php";
    } else {
        // Redirect to the login page if not an admin
        header("Location: /agentie/users/login");
        exit();  // Make sure to call exit() after the redirect
    }
    }

    public static function show() {
        $user_id = $_GET['id'];
        $user = User::getUser($user_id);

        if ($user) {
            require_once "app/views/users/show.php";
        } else {
            $_SESSION['error'] = "User not found";
            require_once "app/views/404.php";
        }

    }

    public static function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];


            if ($password !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match.";
                header("Location: /agentie/users/register");
                exit;
            }
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $userCreated = User::createUser($firstName, $lastName, $email, $hashedPassword);
            require_once "app/views/users/register.php";
            if ($userCreated) {
                $_SESSION['success'] = "Registration successful! Please login.";
                header("Location: /agentie/users/login");
            } else {
                $_SESSION['error'] = "Registration failed. Email might already be in use.";
                header("Location: /agentie/register");
            }
        } else {
            require_once "app/views/users/register.php";
        }
    }

    public static function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['email'];
            $password = $_POST['password'];
            $user = User::authenticate($username, $password);
            if($user)
            {
                // Record session start in the database
            $session_start = date('Y-m-d H:i:s'); // Get current timestamp
            UserSessionModel::addSession($user['user_id'], $session_start, null, 0);
            if ($user) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['first_name'] = $user['first_name'];
                header("Location: /agentie/tours/index");
            } else {
                echo "Invalid credentials!";
            }
        }
            }
            
        require "app/views/users/login.php";
    }

    public static function logout() {
        session_start();
        
         $user_id = $_SESSION['user_id'];
        
         $session_end = date('Y-m-d H:i:s');
    
    // Find the last session the user started and update it with the session end time and duration
    $last_session = UserSessionModel::getLastSession($user_id); // Fetch the last session

    if ($last_session) {
        // Calculate session duration in seconds
        $session_start = strtotime($last_session['session_start']);
        $session_end_timestamp = strtotime($session_end);
        $duration = $session_end_timestamp - $session_start; // Duration in seconds

        // Update session with end time and duration
        UserSessionModel::endSession($last_session['id'], $session_end, $duration);
        }
        
        
        session_unset();
        session_destroy();
        header("Location: /agentie/users/login");
        exit();
    }

    public static function forgotPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'];
            $user = User::getUserByEmail($email);
    
            if ($user) {
                $token = bin2hex(random_bytes(32)); // Generate a secure token
                $expiry = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour
                User::savePasswordResetToken($user['user_id'], $token, $expiry);
    
                $resetLink = "http://yourwebsite.com/agentie/users/reset_password?token=$token";
                $subject = "Password Reset Request";
                $message = "Hello, click the link below to reset your password:\n\n$resetLink\n\nThis link will expire in 1 hour.";
                $headers = "From: no-reply@yourwebsite.com";
    
                mail($email, $subject, $message, $headers); // Send the reset email
                $_SESSION['success'] = "Password reset link sent to your email.";
            } else {
                $_SESSION['error'] = "Email not found.";
            }
    
            header("Location: /agentie/users/forgot_password");
        } else {
            require "app/views/users/forgot_password.php";
        }
    }
    public static function resetPassword() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $token = $_POST['token'];
            $newPassword = $_POST['password'];
            $confirmPassword = $_POST['confirm_password'];
    
            if ($newPassword !== $confirmPassword) {
                $_SESSION['error'] = "Passwords do not match.";
                header("Location: /agentie/users/reset_password?token=$token");
                exit;
            }
    
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $resetStatus = User::resetPassword($token, $hashedPassword);
    
            if ($resetStatus) {
                $_SESSION['success'] = "Password reset successful. Please login.";
                header("Location: /agentie/users/login");
            } else {
                $_SESSION['error'] = "Invalid or expired token.";
                header("Location: /agentie/users/forgot_password");
            }
        } else {
            $token = $_GET['token'];
            require "app/views/users/reset_password.php";
        }
    }
    
    

}
?>
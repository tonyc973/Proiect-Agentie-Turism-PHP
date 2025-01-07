<?php
$routes = [
    "agentie/debts/index" => ["DebtController", "index"],
    "agentie/users/index" => ["UserController", "index"],
    "agentie/users/register" => ["UserController", "register"],
    "agentie/users/login" => ["UserController", "login"],
    "agentie/users/logout" => ["UserController", "logout"],
    "agentie/users/forgot" => ["ForgotPasswordController", "show1"],
    "agentie/users/forgot_password" => ["ForgotPasswordController", "handleResetRequest"],
    "agentie/users/reset_password" => ["ForgotPasswordController", "show2"],
    "agentie/users/reset" => ["ForgotPasswordController", "handlePasswordUpdate"],
    "agentie/tours/index" => ["TourController", "index"],
    "agentie/tours/create" => ["TourController", "create"],
    "agentie/tours/store" => ["TourController", "store"],
    "agentie/tours/delete" => ["TourController", "delete"],
    "agentie/bookings/index" => ["BookingController", "index"],
    "agentie/bookings/book" => ["BookingController", "book"],
    "agentie/bookings/createbook" => ["BookingController", "create"],
    "agentie/bookings/editbook" => ["BookingController", "edit"],
    "agentie/bookings/mybookings" => ["BookingController", "index_email"],
    "agentie/bookings/delete" => ["BookingController", "delete"],
    "agentie/bookings/edit" => ["BookingController", "edit"],
    "agentie/contact/contact" => ["ContactController", "show"],
    "agentie/contact/send"  => ["ContactController", "send_email"],
    "agentie/contact/success" => ["ContactController", "success"],
    "agentie/analytics/sessions_list" => ["UserSessionController", "showAllSessions"],
    "agentie/analytics/session_details" => ["UserSessionController",
    "listSessions"],
    "" => ["HomePageController", "index"]
]; 


class Router { 
    private $uri;

    public function __construct() {
        // Get the current URI
        $this->uri = trim($_SERVER["REQUEST_URI"], "/");
    }

    public function direct() {
        global $routes;
   
        if (array_key_exists($this->uri, $routes)) {

            // Get the controller and method
            [$controller, $method] = $routes[$this->uri];

            // Load the controller file if it hasn't been autoloaded
            require_once "app/controllers/{$controller}.php";

            // Call the method
            return $controller::$method();
        }
        
        require_once "app/views/404.php";
    }
}

?>
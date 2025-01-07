<?php
require_once "app/models/Booking.php";


class bookingController {


    public static function index() {
        $bookings = Booking::getAllbookings();
        require_once "app/views/bookings/index.php";
    }

    public static function index_email()
    {
       
        // Check if user_email exists in the session
        if (!isset($_SESSION['email'])) {
            die("Error: User email not found in the session. Please log in.");
        }

        $user_email = $_SESSION['email'];

        // Fetch bookings by email
        $bookings = Booking::getBookingbyEmail($user_email);

        // Render the view
        require_once "app/views/bookings/index.php";
    }

    public static function show() {
        $booking_id = $_GET['id'];
        $booking = Booking::getBooking($booking_id);

        if ($booking) {
            require_once "app/views/bookings/show.php";
        } else {
            $_SESSION['error'] = "booking not found";
            require_once "app/views/404.php";
        }
    }

    public static function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            /* $user_email = $_POST['user_email']; */
            $user_email = $_SESSION['email'];
            $tour_id = $_POST['tour_id'];
            $participants = $_POST['participants'];
            $status = $_POST['status'];
            $token = $_POST['csrf_token'];
            if (Booking::createBooking($user_email, $tour_id, $participants, $status,$token))
            {
                header("Location: /agentie/tours/index");
                exit;
            }
            else
            {
                echo "Failed to add booking";
            }
            /* Booking::createBooking($user_id, $tour_id, $participants, $status);
            header("Location: /agentie/bookings/index"); */ 
        }
        require_once "app/views/bookings/create.php";
    }


   
    public static function edit()
        {
            // Check if the form was submitted (POST request)
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Store the booking_id from the POST data in the session
                if (isset($_POST['booking_id'])) {
                    $_SESSION['booking_id'] = $_POST['booking_id'];

                    // Retrieve the booking details using the booking_id from the session
                    $booking_id = $_SESSION['booking_id'];
                    $booking = Booking::getBooking($booking_id);
                }
            } else {
                // If not a POST request, check if session already has booking_id
                if (isset($_SESSION['booking_id'])) {
                    $booking_id = $_SESSION['booking_id'];
                    $booking = Booking::getBooking($booking_id);
                } else {
                    echo "Booking ID not found in session.";
                    return;
                }
            }

            // Handle the form submission (POST request)
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_email'])) {
                // Retrieve and process form data here
                $booking_id = $_SESSION['booking_id'];  
                $user_email = $_POST['user_email'];
                $tour_id = $_POST['tour_id'];
                $participants = $_POST['participants'];
                $status = $_POST['status'];
                $token = $_POST['csrf_token'];

                // Update the booking in the database
                if (Booking::updateBooking($booking_id, $user_email, $tour_id, $participants, $status, $token)) {
                    // Redirect to the main bookings page after success
                    header("Location: /agentie/bookings/mybookings");
                    exit();
                } else {
                    echo "Error updating booking.";
                }
            }

            // Load the view
            require_once "app/views/bookings/edit.php";
        }

    public static function delete() {
        if($_SERVER["REQUEST_METHOD"] === 'POST')
        {
            $booking_id=$_SESSION["booking_id"];
            Booking::deleteBooking($booking_id);
            header("Location: /agentie/bookings/mybookings"); 
        }
    }

}
?>
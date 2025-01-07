<?php
require_once "app/models/Tour.php";
require_once "app/models/User.php";



class TourController{

   
    public static function index() {
        $tours = Tour::getAllTours();
        require_once "app/views/tours/index.php";
    }
    public static function show() {
        $tour_id = $_GET['id'];
        $tour = Tour::gettour($tour_id);

        if ($tour) {
            require_once "app/views/tours/show.php";
        } else {
            $_SESSION['error'] = "tour not found";
            require_once "app/views/404.php";
        }
    }
    
    public static function create() {
        // Show the form for creating a new tour
        require_once "app/views/tours/create.php";
    }

    public static function store() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['title'], $_POST['description'], $_POST['price'], $_POST['tour_date'], $_POST['destination'])) {
        
        $title = htmlspecialchars(trim($_POST['title']));
        $description = htmlspecialchars(trim($_POST['description']));
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $tour_date = $_POST['tour_date'];  
        $destination = htmlspecialchars(trim($_POST['destination']));

        if (empty($title) || empty($description) || empty($price) || empty($tour_date) || empty($destination)) {
            $_SESSION['error'] = "All fields are required.";
            require_once "app/views/tours/create.php";
            return;
        }

        if ($price === false || $price <= 0) {
            $_SESSION['error'] = "Invalid price value.";
            require_once "app/views/tours/create.php";
            return;
        }


        Tour::createTour($title, $description, $price, $tour_date, $destination);
        
        $_SESSION['success'] = "Tour created successfully!";
        
        header("Location: /agentie/tours/index");
        exit;
    } else {
        $_SESSION['error'] = "Invalid form submission.";
        require_once "app/views/tours/create.php";
    }
    }

    public static function delete() {
        if (isset($_GET['id'])) {
            $tour_id = $_GET['id'];
            Tour::deleteTour($tour_id);
            $_SESSION['success'] = "Tour deleted successfully!";
            header("Location: /agentie/tours");
            exit;
        } else {
            $_SESSION['error'] = "Tour ID is missing.";
            require_once "app/views/404.php";
        }
    }
}
?>
<?php

class Booking {
    public static function getAllbookings() {
        global $pdo;
        $sql = "SELECT * FROM Bookings";
        $stmt = $pdo->prepare($sql); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getBooking($booking_id) {
        global $pdo;
        $sql = "SELECT * FROM bookings WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':booking_id' => intval($booking_id)]); 
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function getBookingbyEmail($user_email) {
        global $pdo;
        $sql = "SELECT * FROM bookings WHERE user_email = :user_email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_email' => filter_var($user_email, FILTER_SANITIZE_EMAIL)]); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function createBooking($user_email, $tour_id, $participants, $status, $csrf_token) {
        global $pdo;

        if (!self::validateCSRFToken($csrf_token)) {
            throw new Exception("Invalid CSRF token");
        }

        $sql = "INSERT INTO bookings (user_email, tour_id, participants, booking_date, status) 
                VALUES (:user_email, :tour_id, :participants, NOW(), :status)";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':user_email' => filter_var($user_email, FILTER_SANITIZE_EMAIL),
            ':tour_id' => intval($tour_id),
            ':participants' => intval($participants),
            ':status' => htmlspecialchars($status) 
        ]);
    }

    public static function updateBooking($booking_id, $user_email, $tour_id, $participants, $status, $csrf_token) {
        global $pdo;


        if (!self::validateCSRFToken($csrf_token)) {
            throw new Exception("Invalid CSRF token");
        }

        $sql = "UPDATE bookings 
                SET user_email = :user_email, tour_id = :tour_id, participants = :participants, status = :status
                WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':user_email' => filter_var($user_email, FILTER_SANITIZE_EMAIL),
            ':tour_id' => intval($tour_id),
            ':participants' => intval($participants),
            ':status' => htmlspecialchars($status),
            ':booking_id' => intval($booking_id)
        ]);
    }

    public static function deleteBooking($booking_id) {
        global $pdo;


        $sql = "DELETE FROM bookings WHERE booking_id = :booking_id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':booking_id' => intval($booking_id)]);
    }

    public static function generateCSRFToken() {
        if (!isset($_SESSION)) {
            session_start();
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public static function validateCSRFToken($token) {
        if (!isset($_SESSION)) {
            session_start();
        }
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }

}

?>
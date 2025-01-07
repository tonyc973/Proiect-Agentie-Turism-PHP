<?php
// app/controllers/UserSessionController.php
require_once "app/models/UserSessionModel.php";

class UserSessionController {
    // Show all user sessions
    public static function showAllSessions() {
        $sessions = UserSessionModel::getAllSessions(); // Get all sessions
        require_once 'app/views/analytics/sessions_list.php'; // Include the view to display sessions
    }

    // Show a specific session
    public static function showSession($session_id) {
        $session = UserSessionModel::getSession($session_id); // Get session by ID
        include 'app/views/session_details.php'; // Include the view to display session details
    }

    // Add a new session
    public static function addSession($user_id, $session_start, $session_end, $duration) {
        $session_id = UserSessionModel::addSession($user_id, $session_start, $session_end, $duration); // Add session
        echo "Session added with ID: " . $session_id;
    }

    // End an existing session
    public static function endSession($session_id, $session_end, $duration) {
        $result = UserSessionModel::endSession($session_id, $session_end, $duration); // End session
        if ($result) {
            echo "Session ended successfully.";
        } else {
            echo "Failed to end session.";
        }
    }

    // Get the total session duration for a user
    public static function showTotalDuration($user_id) {
        $total_duration = UserSessionModel::getTotalSessionDuration($user_id); // Get total session duration
        echo "Total session duration for user {$user_id}: {$total_duration} seconds.";
    }
    
    public static function listSessions() {
    // Fetch all sessions
    $sessions = UserSessionModel::getAllSessions();

    // Calculate total duration per user
    $userDurations = [];
    foreach ($sessions as $session) {
        $userId = $session['user_id'];
        $duration = $session['duration'];
        if ($duration) {
            $userDurations[$userId] = ($userDurations[$userId] ?? 0) + $duration;
        }
    }

    // Calculate session counts over time
    $sessionCounts = [];
    foreach ($sessions as $session) {
        $date = date('Y-m-d', strtotime($session['session_start']));
        $sessionCounts[$date] = ($sessionCounts[$date] ?? 0) + 1;
    }

    // Pass data to the view
    require "app/views/analytics/session_details.php";
}
}
?>

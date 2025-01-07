<?php
// app/models/UserSessionModel.php

class UserSessionModel {
    // Get all user sessions
    public static function getAllSessions() {
        global $pdo;
        
        $sql = "SELECT * FROM user_sessions ORDER BY session_start DESC";
        $stmt = $pdo->query($sql);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
     public static function getLastSession($user_id) {
        global $pdo;

        // SQL query to fetch the last session for the given user_id
        $sql = "SELECT * FROM user_sessions 
                WHERE user_id = :user_id 
                ORDER BY session_start DESC 
                LIMIT 1"; // Only get the most recent session

        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);

        // Fetch and return the result
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get a specific session by session ID
    public static function getSession($session_id) {
        global $pdo;
        
        $sql = "SELECT * FROM user_sessions WHERE id = :session_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':session_id' => $session_id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Get the total duration of sessions for a user
    public static function getTotalSessionDuration($user_id) {
        global $pdo;
        
        $sql = "SELECT SUM(duration) AS total_duration FROM user_sessions WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':user_id' => $user_id]);
        
        return $stmt->fetch(PDO::FETCH_ASSOC)['total_duration'];
    }

    // Add a new user session
    public static function addSession($user_id, $session_start, $session_end, $duration) {
        global $pdo;

        $sql = "INSERT INTO user_sessions (user_id, session_start, session_end, duration) 
                VALUES (:user_id, :session_start, :session_end, :duration)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':user_id' => $user_id,
            ':session_start' => $session_start,
            ':session_end' => $session_end,
            ':duration' => $duration
        ]);
        
        return $pdo->lastInsertId();
    }

    // Update the session end time and duration for a session
    public static function endSession($session_id, $session_end, $duration) {
        global $pdo;

        $sql = "UPDATE user_sessions 
                SET session_end = :session_end, duration = :duration 
                WHERE id = :session_id";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':session_id' => $session_id,
            ':session_end' => $session_end,
            ':duration' => $duration
        ]);
        
        return $stmt->rowCount();
    }
    
    
    
}
?>

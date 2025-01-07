<?php

class User {
    public static function getAllUsers() {
        global $pdo;
        $sql = "SELECT * 
                FROM users";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getUser($user_id) {
        global $pdo;

        $sql = "SELECT * s
                FROM users 
                WHERE user_id = :user_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":user_id" => $user_id));
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function createUser($firstName, $lastName, $email, $password) {
        global $pdo;

        // Check if the email already exists
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            // Email already exists
            return false;
        }

        // Insert the new user
        $sql = "INSERT INTO users (first_name, last_name, email, password, role) 
                VALUES (:first_name, :last_name, :email, :password, 'user')";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':password' => $password
        ]);
    }

    public static function authenticate($email, $password) {
        global $pdo;
        $sql = "SELECT * FROM users WHERE email= :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
    public static function getUserByEmail($email) {
        global $pdo;
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
        /*
        if ($userData) {
        return new User($userData);  // Return a User object with the fetched data
    }
    return null;  // Return null if no user is found
 */    }
    public static function storePasswordResetToken($email, $token, $expiresAt) {
        global $pdo;
        $sql = "UPDATE users 
                SET reset_token = :token, reset_token_expires = :expires_at 
                WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':token' => $token,
            ':expires_at' => $expiresAt,
            ':email' => $email
        ]);
    }
    public static function resetPassword($token, $newPassword) {
        global $pdo;
    
        // Check if the token is valid and not expired
        $sql = "SELECT * 
                FROM users 
                WHERE reset_token = :token AND reset_token_expires > NOW()";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':token' => $token]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            // Token is valid; update the password
            $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);
            $sql = "UPDATE users 
                    SET password = :password, reset_token = NULL, reset_token_expires = NULL 
                    WHERE reset_token = :token";
            $stmt = $pdo->prepare($sql);
            return $stmt->execute([
                ':password' => $hashedPassword,
                ':token' => $token
            ]);
        }
    
        return false; 
    }
    
    public static function update($data) {
        global $pdo;
        $sql = "UPDATE users SET reset_code = :reset_code, reset_code_expiration = :reset_code_expiration WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':reset_code' => $data['reset_code'],
            ':reset_code_expiration' => $data['reset_code_expiration'],
            ':email' => $data['email']
        ]);
    }
  
    public static function update_($data)
    {
    global $pdo;
    $sql = "UPDATE users SET password = :password, reset_code = :reset_code, reset_code_expiration = :reset_code_expiration WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    
    // Check if the query was executed successfully
    $result = $stmt->execute([
        ':password' => $data['password'],
        ':reset_code' => $data['reset_code'],
        ':reset_code_expiration' => $data['reset_code_expiration'],
        ':email' => $data['email']
    ]);
    }
    
    


}
?>
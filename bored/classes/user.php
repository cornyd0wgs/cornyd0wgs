<?php

require_once 'db.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        session_start();
    }

    public function register($name, $email, $password) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed);

        if ($stmt->execute()) {
            return "registered";
        } else {
            error_log("MySQL Error: " . $stmt->error);  // Log it
            return "error";
        }

    }

    public function login($email, $password) {
        // Prepare the SQL statement to prevent SQL injection
       $stmt = $this->db->prepare("SELECT id, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed);
            $stmt->fetch();
            
            if (password_verify($password, $hashed)) {
                $_SESSION['user_id'] = $id;
                return "loggedin";
            } else {
                return "wrongpass"; // Invalid password
            }
        }
        return "notfound";
    }


    public function logout(){
        session_destroy();
        return "logout";
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function getUserInfo($id){
        $stmt = $this->db->prepare("SELECT name, email FROM users WHERE id = ? ");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        return $result->fetch_assoc();
    }
}





?>
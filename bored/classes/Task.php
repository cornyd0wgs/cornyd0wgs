<?php

require_once 'db.php';

class task{
    private $db;

    public function __construct() {
        $this->db =(new Database())->getConnection();
        session_start();
    }

    public function getAllTasks($user_id){
        $stmt = $this->db->prepare("SELECT * FROM tasks WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
       $tasks = [];
        while($row = $result->fetch_assoc()){
            $tasks[] = $row;
        }
        return json_encode($tasks);
    }

    public function addTask($user_id, $title, $description){
        $stmt = $this->db->prepare("INSERT INTO tasks (user_id, title, description) VALUES (?, ?, ?)");
        $stmt->bind_param("iss", $user_id, $title, $description);
        return $stmt->execute() ? "added" : "Error: " . $stmt->error; 
    }

    public function deleteTask($task_id, $user_id){
        $stmt = $this->db->prepare("DELETE FROM tasks WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        return $stmt->execute() ? "deleted" : "Error: " . $stmt->error;
    }

    public function completeTask($task_id, $user_id){
        $stmt = $this->db->prepare("UPDATE tasks SET status = completed WHERE id = ? AND user_id = ?");
        $stmt->bind_param("ii", $task_id, $user_id);
        return $stmt->execute() ? "completed" : "Error: " . $stmt->error;
    }

    public function getWeeklyStats($user_id){
        $stmt = $this->db->prepare("SELECT DATE(created_at) as day, COUNT(*) as total, 
        SUM(completed = 1) as completed
        FROM tasks 
        WHERE user_id = ? AND created_at >= DATE_SUB(CURDATE(), INTERVAL 6 DAY)
        GROUP BY day
        ORDER BY day ASC
        ");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        $stats = [];
        while ($row = $result->fetch_assoc()){
            $stats[] = $row;
        }

        return json_encode($stats);
    }
}
?>
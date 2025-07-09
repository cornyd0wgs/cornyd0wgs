<?php
session_start();
require_once '../classes/Task.php';

$task = new task();
$user_id = $_SESSION['user_id'] ?? null;

if (!$user_id) {
    echo "unauthorized";
    exit();
}

$action = $_POST['action'] ?? '';

switch ($action) {
    case 'get':
        echo $task->getAllTasks($user_id);
        break;
    case 'add':
        echo $task->addTask($user_id, $_POST['title'], $_POST['description']);
        break;
    case 'delete':
        echo $task->deleteTask($_POST['task_id'], $user_id);
        break;
    case 'complete':
        echo $task->completeTask($_POST['task_id'], $user_id);
        break;
    case 'get_stats':
        echo $task->getWeeklyStats($user_id);
        break;
    default:
        echo "Invalid action";
        break;
}
?>
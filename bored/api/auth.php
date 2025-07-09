<?php
require_once '../classes/user.php';

$user = new User();

$action = $_POST['action'] ?? '';

switch ($action){
    case 'register':
        echo $user->register($_POST['name'], $_POST['email'], $_POST['password']);
        break;
    case 'login':
        echo $user->login($_POST['email'], $_POST['password']);
        break;
    case 'logout':
        echo $user->logout();
        break;
    case 'get_user':
    echo json_encode($user->getUserInfo($_SESSION['user_id']));
        break;
    default:
        echo "Invalid action";
        break;
    }
?>
<?php
require_once "../classes/user.php";
$user = new User();

if(!$user->isloggedIn()){
    header("location: ../public/login.html");
    exit();
}

?>
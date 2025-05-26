<?php
require '../DB/db.php';
require '../classes/Pet.php';

$pet = new Pet($pdo);

if (isset($_GET['id'])) {
    $pet->deletePet($_GET['id']);
}

header("Location: index.php");
exit;

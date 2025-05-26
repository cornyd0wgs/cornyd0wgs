<?php
require '../DB/db.php';
require '../classes/Pet.php';

$pet = new Pet($pdo);

if (!isset($_GET['id'])) {
    die("Pet ID is required.");
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet->updatePet(
        $id,
        $_POST['name'],
        $_POST['species'],
        $_POST['breed'],
        $_POST['age'],
        $_POST['gender'],
        $_POST['color'],
        $_POST['weight'],
        $_POST['owner_name']
    );
    header("Location: index.php");
}

$petData = $pet->getPetById($id);
if (!$petData) {
    die("Pet not found.");
}
?>

<header>
    <title>Pet Registry</title>
    <link rel="stylesheet" href="../css/style.css">
</header>

<div class="container">
<h2>Edit Pet: <?= htmlspecialchars($petData['name']) ?></h2>
<form method="POST">
    <span>Pet Name</span><br>
    <input name="name" placeholder="Pet Name" 
         value="<?= $petData['name'] ?>" required><br>
    <span>Species</span><br>
    <input name="species"  placeholder="Species (Dog, Cat...)"
         value="<?= $petData['species'] ?>"><br>
    <span>Breed</span><br>
    <input name="breed" placeholder="Breed"
         value="<?= $petData['breed'] ?>"><br>
    <span>Age (years)</span><br>
    <input name="age" placeholder="Age" type="number" 
         value="<?= $petData['age'] ?>"><br>
    <span>Gender</span><>
    <select name="gender">
         <option value="Male" <?= $petData['gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
         <option value="Female" <?= $petData['gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
    </select><br>
    <span>Color</span><br>
    <input name="color"  placeholder="Color" 
         value="<?= $petData['color'] ?>"><br>
    <span>Weight (kg)</span><br>
    <div class="input-with-suffix">
     <input 
        name="weight" placeholder="Weight" type="number" step="0.1" 
        value="<?= htmlspecialchars($petData['weight']) ?>">
        <span class="suffix">kg</span>
    </div><br>
    <span>Owner's Name</span><br>
    <input name="owner_name" placeholder="Owner's Name" 
         value="<?= $petData['owner_name'] ?>"><br>
    <button type="submit">Save Changes</button>
</form>
</div>
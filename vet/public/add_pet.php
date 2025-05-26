<?php
require '../DB/db.php';
require '../classes/Pet.php';

$pet = new Pet($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pet->addPet(
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
?>


<header>
    <title>Pet Registry</title>
    <link rel="stylesheet" href="../css/style.css">
</header>

<div class ="container">
<h2>🐶 Register a New Pet</h2>
    <form method="POST">
        <span>Pet Name</span><br>
      <input name="name" placeholder="Pet Name" required><br>
        <span>Species</span><br>
      <input name="species" placeholder="Species (Dog, Cat...)"><br>
        <span>Breed</span><br>
      <input name="breed" placeholder="Breed"><br>
        <span>Age (years)</span><br>
      <input name="age" type="number" placeholder="Age"><br>
        <span>Gender</span><br>
         <select name="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
         </select><br>
        <span>Color</span><br>
      <input name="color" placeholder="Color"><br>
      <span>Weight (kg)</span><br>
    <div class="input-with-suffix">
     <input 
        name="weight" placeholder="Weight" type="number" step="0.1" 
        value="<?= htmlspecialchars($petData['weight']) ?>">
        <span class="suffix">kg</span>
    </div><br>
        <span>Owner's Name</span><br>
      <input name="owner_name" placeholder="Owner's Name"><br>
      <button type="submit">Register</button>
    </form>
</div>
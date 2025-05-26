<?php
require '../DB/db.php';
require '../classes/Pet.php';

$pet = new Pet($pdo);

if (isset($_GET['search']) && trim($_GET['search']) !== '') {
    $pets = $pet->searchPets($_GET['search']);
} else {
    $pets = $pet->getAllPets();
}

?>

<header>
    <title>Pet Registry</title>
    <link rel="stylesheet" href="../css/style.css">
</header>

<div class="search-wrapper">
    <form method="GET" class="search-bar">
        <input type="text" name="search" placeholder="Search pets..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
        <button type="submit">🔍 Search</button>
    </form>
</div>

<div class="container">
<h2>🐾 Pet Registration </h2>
<i class="fa-solid fa-dog"></i> Register a Pet
<a href="add_pet.php">+ Add Pet</a>
<ul>
    <?php if(count($pets) > 0):?>
    <?php foreach ($pets as $p): ?>
        <li>
            <?= htmlspecialchars($p['name']) ?> - <?= htmlspecialchars($p['species']) ?> 
            (<?= htmlspecialchars($p['gender']) ?>, <?= $p['age'] ?> yrs)
            <br>
            <?= date("F j, Y, g:i a", strtotime($p['created_at'])) ?>
            <br>
            <a href="edit.php?id=<?= $p['id'] ?>">Edit</a> | 
            <a href="delete.php?id=<?= $p['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
        </li>
    <?php endforeach; ?>
    <?php else: ?>
        <li>No pets found.</li>
    <?php endif; ?>
</ul>
</div>
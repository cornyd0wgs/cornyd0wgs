<?php
class Pet {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addPet($name, $species, $breed, $age, $gender, $color, $weight, $owner) {
        $sql = "INSERT INTO pet (name, species, breed, age, gender, color, weight, owner_name) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $species, $breed, $age, $gender, $color, $weight, $owner]);
    }

    public function getAllPets() {
        $stmt = $this->conn->query("SELECT * FROM pet ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPetById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM pet WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updatePet($id, $name, $species, $breed, $age, $gender, $color, $weight, $owner) {
        $sql = "UPDATE pet SET name=?, species=?, breed=?, age=?, gender=?, color=?, weight=?, owner_name=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$name, $species, $breed, $age, $gender, $color, $weight, $owner, $id]);
    }
    
    public function deletePet($id) {
        $stmt = $this->conn->prepare("DELETE FROM pet WHERE id = ?");
        return $stmt->execute([$id]);
    }
  
    public function searchPets($term) {
    $term = "%$term%";
    $sql = "SELECT * FROM pet
            WHERE name LIKE ? OR species LIKE ? OR owner_name LIKE ?
            ORDER BY created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$term, $term, $term]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>

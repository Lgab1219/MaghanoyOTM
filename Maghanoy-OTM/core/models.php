<?php 

require_once 'dbConfig.php';

// Adds a business owner into the database
function addOwner($pdo, $fname, $lname){

    $query = "INSERT INTO businessOwner (fname, lname) VALUES (?, ?)";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([
        $fname,
        $lname,
    ]);

    if($executeQuery){
        return true;
    }

}

// Get all owners from the database
function getAllOwners($pdo){

    $query = "SELECT * FROM businessOwner";
    
    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute();

    if($executeQuery){
        return $statement -> fetchAll();
    }

}

// Get owner by ID from the database
function getOwnerByID($pdo, $ownerID){

    $query = "SELECT * FROM businessOwner WHERE ownerID = ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute();

    if($executeQuery){
        return $statement -> fetch();
    }

}

// Update business owner information
function updateBusinessOwner($pdo, $fname, $lname, $ownerID){

    $query = "UPDATE businessOwner 
    SET 
    fname = ?,
    lname = ?
    WHERE ownerID = ?";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([
        $fname, $lname, $ownerID
    ]);

    if($executeQuery){
        return true;
    }

}

?>
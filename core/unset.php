<?php

include_once 'dbConfig.php';

session_start(); // Establish connection to the current session

$deleteOwnersQuery  = "DELETE FROM businessOwner";
$resetIncrementQuery = "ALTER TABLE businessowner AUTO_INCREMENT = 1";
$deleteWebsitesQuery = "DELETE FROM ecommercewebsites";

// Preparing queries
$deleteStatement = $pdo -> prepare($deleteOwnersQuery);
$resetIncrementStatement = $pdo -> prepare($resetIncrementQuery);
$deleteWebsiteStatement = $pdo -> prepare($deleteWebsitesQuery);

// Executing queries
$executeQuery = $deleteStatement -> execute();
$executeQuery = $resetIncrementStatement -> execute();
$executeQuery = $deleteWebsiteStatement -> execute();

if($executeQuery){
    header('Location: ../index.php'); // Go back to homepage
    return true;
}

session_unset(); // Delete all session variables

?>
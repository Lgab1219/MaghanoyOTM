<?php 

session_start();

require_once 'dbConfig.php';
require_once 'models.php';

// If submit button is clicked, add new business owner to the database
if(isset($_POST['submitOwnerBtn'])){

    $query = addOwner($pdo, $_POST['fname'], $_POST['lname']);

    if($query){
        header("Location: ../index.php");
    } else {
        echo "Insertion failed!";
    }

    exit();

}



?>
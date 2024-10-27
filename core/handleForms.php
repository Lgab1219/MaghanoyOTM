<?php

session_start();

require_once 'dbConfig.php';
require_once 'models.php';

// If submit button is clicked, add new business owner to the database
if (isset($_POST['submitOwnerBtn'])) {
   $query = addOwner($pdo, $_POST['fname'], $_POST['lname']);

   if ($query) {
       header("Location: ../index.php");
       exit();
   } else {
       echo "Insertion failed!";
   }
}

// If delete button is clicked, delete the business owner
if (isset($_POST['deleteBtn'])) {
   $ownerID = $_POST['ownerID'];

   $query = deleteOwner($pdo, $ownerID);

   if ($query) {
       header("Location: ../index.php");
       exit();
   } else {
       echo "Deletion failed!";
   }
}

// If update button is clicked, update data in business owner table
if(isset($_POST['updateOwnerBtn'])){
   $query = updateOwner($pdo, $_POST['fname'], $_POST['lname'], $_POST['ownerID']);

   if($query){
       header("Location: ../index.php");
   } else {
       echo "Update failed!";
   }

   exit();
}

// Adds a new website
if (isset($_POST['addWebsiteBtn'])) {
   $ownerID = $_POST['ownerID'];
   $websiteStatus = $_POST['websiteStatus'];
   $username = $_SESSION['username'];

   $query = addWebsite($pdo, $_POST['businessName'], $_POST['domain'], $websiteStatus, $username, $ownerID);

   if ($query) {
       header("Location: ../viewWebsites.php?ownerID=".$ownerID);
       exit();
   } else {
       echo "Website insertion failed!";
   }
}

// Edits website by ID
if (isset($_POST['editWebsiteBtn'])) {
   if (isset($_POST['websiteID'], $_POST['ownerID'], $_POST['businessName'], $_POST['domain'], $_POST['websiteStatus'])) {
       $websiteID = $_POST['websiteID'];
       $ownerID = $_POST['ownerID'];
       $websiteStatus = $_POST['websiteStatus'];
       $username = $_SESSION['username'];

       $query = updateWebsite($pdo, $_POST['businessName'], $_POST['domain'], $websiteStatus, $username, $websiteID);

       if ($query) {
           header("Location: ../viewWebsites.php?ownerID=".$ownerID);
           exit();
       } else {
           echo "Website update failed!";
       }
   } else {
       echo "Required fields are missing!";
   }
}

// Deletes website by ID
if (isset($_POST['deleteWebsiteBtn'])) {
   $query = deleteWebsite($pdo, $_POST['websiteID']);

   if ($query) {
       header("Location: ../index.php");
       exit();
   } else {
       echo "Website deletion failed!";
   }
}

// Registers an account to the database
if(isset($_POST['createUserBtn'])){
   $username = $_POST['username'];
   $password = sha1($_POST['password']);

   if(!empty($username) && !empty($password)){

       $insertQuery = createAccount($pdo, $username, $password);

       if($insertQuery){
           header("Location: ../index.php");
       } else {
           header("Location: ../index.php");
       }
   } else {
       $_SESSION['message'] = "Please make sure there are no empty fields!";
       header("Location: ../login.php");
   }
}

// Logins account
if(isset($_POST['loginUserBtn'])){
   $username = $_POST['username'];
   $password = sha1($_POST['password']);

   if(!empty($username) && !empty($password)){
       $loginQuery = loginAccount($pdo, $username, $password);

       if($loginQuery){
           header("Location: ../index.php");
           exit();
       } else {
           header("Location: ../login.php");
       }
   } else {
       $_SESSION['message'] = "Please make sure there are no empty fields!";
       header("Location: ../login.php");
   }
}

// Logout account
if(isset($_GET['logout'])){
unset($_SESSION['username']);
$_SESSION['message'] = "";
header('Location: ../login.php');
}
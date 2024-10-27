<?php

require_once 'dbConfig.php';

// Deletes website
function deleteWebsite($pdo, $websiteID) {
   $query = "DELETE FROM ecommercewebsites WHERE websiteID = ?";

   $statement = $pdo -> prepare($query);
   $executeQuery = $statement -> execute([$websiteID]);

   if ($executeQuery) {
       return true;
   }
}

function getWebsiteByID($pdo, $websiteID){
   $query = "SELECT
       ecommercewebsites.websiteID AS websiteID,
       ecommercewebsites.businessName AS businessName,
       ecommercewebsites.domain AS domain,
       ecommercewebsites.websiteStatus AS websiteStatus,
       CONCAT(businessowner.fname, ' ', businessowner.lname) AS businessOwner
       FROM ecommercewebsites
       JOIN businessowner ON ecommercewebsites.ownerID = businessowner.ownerID
       WHERE ecommercewebsites.websiteID = ?
       GROUP BY ecommercewebsites.businessName;";

   $statement = $pdo->prepare($query);
   $executeQuery = $statement->execute([$websiteID]);

   if ($executeQuery) {
       return $statement->fetch();  // Ensure you're returning the data as an associative array
   }
   return null; 
}

// Update website information
function updateWebsite($pdo, $businessName, $domain, $websiteStatus, $username, $websiteID) {

   $query = "UPDATE ecommercewebsites
             SET
             businessName = ?,
             domain = ?,
             websiteStatus = ?,
             username = ?
             WHERE websiteID = ?";

   $statement = $pdo->prepare($query);
   $executeQuery = $statement->execute([
       $businessName,
       $domain,
       $websiteStatus,
       $username,
       $websiteID
   ]);

   if ($executeQuery) {
       return true;
   }
   return false; // In case of a failure
}

// Fetches all projects by business owner
function getAllWebsites($pdo, $ownerID){

   $query = "SELECT
   ecommercewebsites.websiteID AS websiteID,
   ecommercewebsites.businessName AS businessName,
   ecommercewebsites.domain AS domain,
   ecommercewebsites.websiteStatus AS websiteStatus,
   ecommercewebsites.date_added AS date_added,
   ecommercewebsites.username AS username,
   ecommercewebsites.last_updated AS last_updated,
   CONCAT(businessowner.fname, ' ', businessowner.lname) AS businessOwner
   FROM ecommercewebsites
   JOIN businessowner ON ecommercewebsites.ownerID = businessowner.ownerID
   WHERE ecommercewebsites.ownerID = ?
   GROUP BY ecommercewebsites.businessName;";

   $statement = $pdo -> prepare($query);
   $executeQuery = $statement -> execute([$ownerID]);

   if($executeQuery){
       return $statement -> fetchAll();
   }

}

// Adds a new website under a business owner
function addWebsite($pdo, $businessName, $domain, $websiteStatus, $username, $ownerID){

   $query = "INSERT INTO ecommercewebsites (businessName, domain, websiteStatus, username, ownerID) VALUES (?, ?, ?, ?, ?)";

   $statement = $pdo -> prepare($query);
   $executeQuery = $statement -> execute([
       $businessName,
       $domain,
       $websiteStatus,
       $username,
       $ownerID
   ]);

   if($executeQuery){
       return true;
   }

}

// Deletes a business owner into the database
function deleteOwner($pdo, $ownerID){
   $query = "DELETE FROM businessOwner WHERE ownerId = ?";

   $statement = $pdo -> prepare($query);
   $executeQuery = $statement -> execute([$ownerID]);

   if($executeQuery){
       return true;
   }
}

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
   $executeQuery = $statement -> execute([$ownerID]);

   if($executeQuery){
       return $statement -> fetch();
   }

}

// Update business owner information
function updateOwner($pdo, $fname, $lname, $ownerID){
   $query = "UPDATE businessowner
   SET fname = ?,
   lname = ?
   WHERE ownerID = ?";

   $statement = $pdo -> prepare($query);
   $executeQuery = $statement -> execute([
       $fname,
       $lname,
       $ownerID
   ]);

   if ($executeQuery) {
       return true;
   }
}

// Registers account to database
function createAccount($pdo, $username, $password){
   $checkQuery = "SELECT * FROM accounts WHERE username = ?";
   $statement = $pdo -> prepare($checkQuery);
   $statement -> execute([$username]);

   if($statement -> rowCount() == 0){

       $insertQuery = "INSERT INTO accounts (username, password) VALUES
       (?, ?)";
       $statement = $pdo -> prepare($insertQuery);
       $executeQuery = $statement -> execute([$username, $password]);

       if($executeQuery){
           $_SESSION['message'] = "User successfully inserted!";
           return true;
       } else {
           $_SESSION['message'] = "An error occurred!";
       }
   } else {
       $_SESSION['message'] = "User already exists!";
   }
}

// Logins account
function loginAccount($pdo, $username, $password){
   $checkQuery = "SELECT * FROM accounts WHERE username = ?";
   $statement = $pdo -> prepare($checkQuery);

   if($statement -> execute([$username])){
       $accountInfo = $statement -> fetch();
       $usernameDB = $accountInfo['username'];
       $passwordDB = $accountInfo['password'];

       if($password == $passwordDB){
           $_SESSION['username'] = $usernameDB;
           $_SESSION['message'] = "Login successful!";
           return true;
       } else {
           $_SESSION['message'] = "Username/Password Invalid!";
       }

       if($statement -> rowCount() == 0){
           $_SESSION['message'] = "Username/Password Invalid!";
       }
   }
}




?>
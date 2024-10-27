<?php

require_once 'core/dbConfig.php';
require_once 'core/models.php';
require_once 'core/handleForms.php';

if(!isset($_SESSION['username'])){
   header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="css/styles.css">
   <title>Home</title>
</head>
<body>
   <h1>E-Commerce Business Owner Management System</h1>
   <br><br>
   <?php if(isset($_SESSION['username'])) { ?>
       <h1>Hello, <?php echo $_SESSION['username']; ?>!</h1>
       <button><a href="core/handleForms.php?logout=1" style="text-decoration: none; color: black;">Logout</a></button>
   <?php } else { echo "<h1>No user logged in!</h1>"; } ?>
   <br><br>
   <div class="addOwnerContainer">
       <h2>Add A Business Owner:</h2>
       <form action="core/handleForms.php" method="POST">
           <label for="fname">First Name</label><br>
           <input type="text" name="fname">
           <br><br>
           <label for="lname">Last Name</label><br>
           <input type="text" name="lname">
           <br><br>
           <input type="submit" value="Submit" name="submitOwnerBtn">
       </form>
   </div>
   <br><br>
   <h2>Business Owner List</h2>
   <div class="ownersContainer">
       <table class="ownersTable">
           <tr class="ownersTable">
               <td style="border: 2px solid black; padding: 5px;">Owner ID</td>
               <td style="border: 2px solid black; padding: 5px;">First Name</td>
               <td style="border: 2px solid black; padding: 5px;">Last Name</td>
               <td style="border: 2px solid black; padding: 5px;">Date Registered</td>
               <td style="border: 2px solid black; padding: 5px;">Actions</td>
           </tr>
           <?php
               $seeAllOwners = getAllOwners($pdo);
               foreach($seeAllOwners as $rows){ ?>
           <tr class="ownersTable">
               <td style="border: 2px solid black; padding: 5px;"><?php echo $rows['ownerID']; ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo $rows['fname']; ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo $rows['lname']; ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo $rows['date_registered']; ?></td>
               <td style="border: 2px solid black; padding: 5px;">
                   <button><a href="editOwner.php?ownerID=<?php echo $rows['ownerID']; ?>" style="text-decoration: none; color: black;">Update</a></button>
                   <button><a href="deleteBusinessOwner.php?ownerID=<?php echo $rows['ownerID']; ?>" style="text-decoration: none; color: black;">Delete</a></button>
                   <button><a href="viewWebsites.php?ownerID=<?php echo $rows['ownerID']; ?>" style="text-decoration: none; color: black;">View Websites</a></button>
               </td>
           </tr>
           <?php } ?>
       </table>
   </div>
   <br><br>
   <button><a href="core/unset.php" style="text-decoration: none; color: black;">Reset</a></button>
</body>
</html>
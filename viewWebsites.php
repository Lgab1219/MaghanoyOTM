<?php
require_once 'core/dbConfig.php';
require_once 'core/models.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Add a New Website</title>
</head>
<body>
   <h1>E-Commerce Business Owner Management System</h1>
   <br><br>
   <h2>Add a new website</h2>
   <form action="core/handleForms.php" method="POST"> <!-- Cannot use GET method on a POST method -->
       <label for="businessName">Business Name</label>
       <input type="text" name="businessName" required>
       <br><br>
       <label for="domain">Domain Name</label>
       <input type="text" name="domain" required>
       <br><br>
       <label for="websiteStatus">Website Status</label>
       <select name="websiteStatus" required>
           <option value="active">Active</option>
           <option value="inactive">Inactive</option>
       </select>
       <br><br>
       <input type="hidden" name="ownerID" value="<?php echo htmlspecialchars($_GET['ownerID']); ?>"> <!-- Used Hidden Input to add to URL -->
       <input type="submit" value="Add Website" name="addWebsiteBtn">
   </form>
   <br><br>
   <h2>Website List</h2>
   <table class="websiteTable">
           <tr class="websiteTable">
               <td style="border: 2px solid black; padding: 5px;">Business Owner</td>
               <td style="border: 2px solid black; padding: 5px;">Website ID</td>
               <td style="border: 2px solid black; padding: 5px;">Business Name</td>
               <td style="border: 2px solid black; padding: 5px;">Domain Name</td>
               <td style="border: 2px solid black; padding: 5px;">Website Status</td>
               <td style="border: 2px solid black; padding: 5px;">Date Added</td>
               <td style="border: 2px solid black; padding: 5px;">Created/Updated By</td>
               <td style="border: 2px solid black; padding: 5px;">Last Updated</td>
               <td style="border: 2px solid black; padding: 5px;">Actions</td>
           </tr>
           <?php
               $getAllWebsites = getAllWebsites($pdo, $_GET['ownerID']);
               foreach($getAllWebsites as $rows){ ?>
           <tr class="websiteTable">
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['businessOwner']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['websiteID']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['businessName']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['domain']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['websiteStatus']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['date_added']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['username']); ?></td>
               <td style="border: 2px solid black; padding: 5px;"><?php echo htmlspecialchars($rows['last_updated']); ?></td>
               <td style="border: 2px solid black; padding: 5px;">
                   <button>
                       <a href="editWebsite.php?websiteID=<?php echo htmlspecialchars($rows['websiteID']); ?>&ownerID=<?php echo htmlspecialchars($_GET['ownerID']); ?>"
                       style="text-decoration: none; color: black;">Edit</a>
                   </button>
                   <button>
                       <a href="deleteWebsite.php?websiteID=<?php echo htmlspecialchars($rows['websiteID']); ?>&ownerID=<?php echo htmlspecialchars($_GET['ownerID']); ?>"
                       style="text-decoration: none; color: black;">Delete</a>
                   </button>
               </td>
           </tr>
           <?php } ?>
       </table>
       <br><br>
       <button><a href="index.php" style="text-decoration: none; color: black;">Back</a></button>
</body>
</html>
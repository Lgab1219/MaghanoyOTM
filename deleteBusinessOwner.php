<?php 

    require_once 'core/dbConfig.php';
    require_once 'core/models.php';

    // Check if 'ownerID' exists in the URL
    if (isset($_GET['ownerID'])) {
        $ownerID = $_GET['ownerID'];
        $getOwnerByID = getOwnerByID($pdo, $ownerID);  // Fetch owner details by ID
    } else {
        // Handle the case where ownerID is not present in the URL
        echo "No owner specified for deletion.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
    <br><br>
    <h2>Are you sure you want to delete this user?</h2>
    <br>
    <p>First Name: <?php echo htmlspecialchars($getOwnerByID['fname']); ?></p>
    <p>Last Name: <?php echo htmlspecialchars($getOwnerByID['lname']); ?></p>

    <!-- Ensure the form uses POST and sends the ownerID as a hidden input -->
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="ownerID" value="<?php echo htmlspecialchars($ownerID); ?>">
        <input type="submit" value="Delete" name="deleteBtn">
    </form>
</body>
</html>

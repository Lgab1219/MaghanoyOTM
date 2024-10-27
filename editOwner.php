<?php

require_once 'core/handleForms.php';
require_once 'core/models.php';

// Retrieve the owner ID from the URL
$ownerID = $_GET['ownerID'];

// Fetch the owner data using the ID
$getOwnerByID = getOwnerByID($pdo, $ownerID);

// Check if owner data was found
if (!$getOwnerByID) {
    echo "Owner not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Business Owner</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
    <br><br>
    <h2>Update Your Information:</h2>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="ownerID" value="<?php echo htmlspecialchars($ownerID); ?>">
        <label for="fname">First Name</label>
        <input type="text" name="fname" value="<?php echo htmlspecialchars($getOwnerByID['fname']); ?>" required>
        <br><br>

        <label for="lname">Last Name</label>
        <input type="text" name="lname" value="<?php echo htmlspecialchars($getOwnerByID['lname']); ?>" required>
        <br><br>

        <input type="submit" value="Update" name="updateOwnerBtn">
    </form>
</body>
</html>
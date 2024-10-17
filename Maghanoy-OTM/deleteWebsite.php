<?php 

    require_once 'core/dbConfig.php';
    require_once 'core/models.php';

    // Check if 'websiteID' exists in the URL
    if (isset($_GET['websiteID'])) {
        $websiteID = $_GET['websiteID'];
        $getWebsiteByID = getWebsiteByID($pdo, $websiteID);  // Fetch owner details by ID
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
    <title>Delete Website</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
    <br><br>
    <h2>Are you sure you want to delete this website?</h2>
    <br>
    <p>Business Name: <?php echo $getWebsiteByID['businessName']; ?></p>
    <p>Domain Name: <?php echo $getWebsiteByID['domain']; ?></p>
    <p>Website Status: <?php echo $getWebsiteByID['websiteStatus']; ?></p>
    <p>Business Owner: <?php echo $getWebsiteByID['businessOwner']; ?></p>

    <!-- Ensure the form uses POST and sends the ownerID as a hidden input -->
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="websiteID" value="<?php echo htmlspecialchars($websiteID); ?>">
        <input type="hidden" name="ownerID" value="<?php echo htmlspecialchars($ownerID); ?>">
        <input type="submit" value="Delete" name="deleteWebsiteBtn">
    </form>
</body>
</html>

<?php 

require_once 'core/dbConfig.php';
require_once 'core/models.php';

$websiteID = $_GET['websiteID'];

// Check if ownerID is set in the URL
if (!isset($_GET['ownerID'])) {
    die('Error: ownerID is missing.');
}

$ownerID = $_GET['ownerID']; // Now it's safe to access ownerID
$getWebsiteByID = getWebsiteByID($pdo, $websiteID);

// Check if data was returned
if (!$getWebsiteByID) {
    die('Error: Website not found.');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Website</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
    <br><br>
    <h2>Update Your Website Information:</h2>
    <form action="core/handleForms.php" method="POST">
        <input type="hidden" name="websiteID" value="<?php echo htmlspecialchars($websiteID); ?>">
        <input type="hidden" name="ownerID" value="<?php echo htmlspecialchars($ownerID); ?>">

        <label for="businessName">Business Name</label>
        <input type="text" name="businessName" value="<?php echo htmlspecialchars($getWebsiteByID['businessName']); ?>" required>
        <br><br>
        
        <label for="domain">Domain Name</label>
        <input type="text" name="domain" value="<?php echo htmlspecialchars($getWebsiteByID['domain']); ?>" required>
        <br><br>
        
        <label for="websiteStatus">Website Status</label>
        <select name="websiteStatus" required>
            <option value="" disabled>---</option>
            <option value="active" <?php echo ($getWebsiteByID['websiteStatus'] === 'active') ? 'selected' : ''; ?>>Active</option>
            <option value="inactive" <?php echo ($getWebsiteByID['websiteStatus'] === 'inactive') ? 'selected' : ''; ?>>Inactive</option>
        </select>
        <br><br>
        
        <input type="submit" value="Update" name="editWebsiteBtn">
    </form>
</body>
</html>

<?php 

    require_once 'core/dbConfig.php';
    require_once 'core/models.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
        <br><br>
        <h2>Update Your Information:</h2>
        <form action="">
            <label for="fname">First Name</label><br>
            <input type="text" name="fname">
            <br><br>
            <label for="lname">Last Name</label><br>
            <input type="text" name="lname">
            <br><br>
            <input type="submit" value="Submit" name="updateBtn">
        </form>
</body>
</html>
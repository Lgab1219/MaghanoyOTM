<?php require_once 'core/dbConfig.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>E-Commerce Business Owner Management System</h1>
    <br><br>
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
    <br><br>
    
</body>
</html>
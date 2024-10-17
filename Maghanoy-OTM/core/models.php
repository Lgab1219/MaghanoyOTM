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
        return $statement->fetch(PDO::FETCH_ASSOC);  // Ensure you're returning the data as an associative array
    }
    return null;  // Return null if there's no result
}



// Update website information
function updateWebsite($pdo, $businessName, $domain, $websiteStatus, $websiteID) {
    $query = "UPDATE ecommercewebsites 
              SET 
              businessName = ?, 
              domain = ?, 
              websiteStatus = ? 
              WHERE websiteID = ?";

    $statement = $pdo->prepare($query);
    $executeQuery = $statement->execute([
        $businessName, 
        $domain, 
        $websiteStatus, 
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
function addWebsite($pdo, $businessName, $domain, $websiteStatus, $ownerID){

    $query = "INSERT INTO ecommercewebsites (businessName, domain, websiteStatus, ownerID) VALUES (?, ?, ?, ?)";

    $statement = $pdo -> prepare($query);
    $executeQuery = $statement -> execute([
        $businessName,
        $domain,
        $websiteStatus,
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

?>
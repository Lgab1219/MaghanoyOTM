<?php 

session_start();

require_once 'dbConfig.php';
require_once 'models.php';

// Enable error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// If submit button is clicked, add new business owner to the database
if (isset($_POST['submitOwnerBtn'])) {
    $query = addOwner($pdo, $_POST['fname'], $_POST['lname']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Insertion failed!";
    }
}

// If delete button is clicked, delete the business owner
if (isset($_POST['deleteBtn'])) {
    $ownerID = $_POST['ownerID'];

    $query = deleteOwner($pdo, $ownerID);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Deletion failed!";
    }
}

// If update button is clicked, update data in business owner table
if(isset($_POST['updateOwnerBtn'])){
    $query = updateOwner($pdo, $_POST['fname'], $_POST['lname'], $_POST['ownerID']);

    if($query){
        header("Location: ../index.php");
    } else {
        echo "Update failed!";
    }

    exit();
}

// Adds a new website
if (isset($_POST['addWebsiteBtn'])) {
    $ownerID = $_POST['ownerID'];
    $websiteStatus = $_POST['websiteStatus'];

    $query = addWebsite($pdo, $_POST['businessName'], $_POST['domain'], $websiteStatus, $ownerID);

    if ($query) {
        header("Location: ../viewWebsites.php?ownerID=".$ownerID);
        exit();
    } else {
        echo "Website insertion failed!";
    }
}

// Edits website by ID
if (isset($_POST['editWebsiteBtn'])) {
    if (isset($_POST['websiteID'], $_POST['ownerID'], $_POST['businessName'], $_POST['domain'], $_POST['websiteStatus'])) {
        $websiteID = $_POST['websiteID'];
        $ownerID = $_POST['ownerID'];
        $websiteStatus = $_POST['websiteStatus'];

        $query = updateWebsite($pdo, $_POST['businessName'], $_POST['domain'], $websiteStatus, $websiteID);

        if ($query) {
            header("Location: ../viewWebsites.php?ownerID=".$ownerID);
            exit();
        } else {
            echo "Website update failed!";
        }
    } else {
        echo "Required fields are missing!";
    }
}

// Deletes website by ID
if (isset($_POST['deleteWebsiteBtn'])) {
    $query = deleteWebsite($pdo, $_POST['websiteID']);

    if ($query) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Website deletion failed!";
    }
}
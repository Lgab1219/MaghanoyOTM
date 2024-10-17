CREATE TABLE businessowner (
    ownerID INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(255),
    lname VARCHAR(255),
    date_registered DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE ecommercewebsites (
    websiteID INT AUTO_INCREMENT PRIMARY KEY,
    ownerID INT,
    businessName VARCHAR(255),
    domain VARCHAR(255),
    websiteStatus VARCHAR(255),
    date_added DATETIME DEFAULT CURRENT_TIMESTAMP
);

<?php
// Replace these variables with your MySQL server credentials
$hostname = 'localhost';
$username = 'root';
$password = '';

// Connect to MySQL server
$connection = new mysqli($hostname, $username, $password);

// Check for connection errors
if ($connection->connect_error) {
    die('Connection failed: ' . $connection->connect_error);
}

// Create the database
$databaseName = 'form';
$createDatabaseQuery = "CREATE DATABASE IF NOT EXISTS $databaseName";

if ($connection->query($createDatabaseQuery) === TRUE) {
    echo "Database created successfully.\n";
} else {
    echo "Error creating database: " . $connection->error . "\n";
}

// Select the database
$connection->select_db($databaseName);

// Create the table
$createTableQuery = "
CREATE TABLE IF NOT EXISTS `stu` (
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    `First Name` VARCHAR(100),
    `Last Name` VARCHAR(100),
    `email` VARCHAR(50),
    `password` VARCHAR(255),
    `image` VARCHAR(255),
    `Gender` VARCHAR(10),
    `DOB` DATE
    
)";

if ($connection->query($createTableQuery) === TRUE) {
    echo "Table created successfully.\n";
} else {
    echo "Error creating table: " . $connection->error . "\n";
}

// Close the connection
$connection->close();
?>

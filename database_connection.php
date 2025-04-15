<?php
// Database configuration
$host = 'localhost';      // Server name or IP address where MySQL is running
$dbname = 'test';         // The database name we created
$username = 'root';       // Default XAMPP MySQL username
$password = '';           // Default XAMPP MySQL password is empty

try {
    // Create a new PDO (PHP Data Objects) instance
    // This establishes the database connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    
    // Set PDO to throw exceptions on error
    // This helps us catch and handle errors properly
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Optional: Set character set to UTF-8
    $pdo->exec("SET NAMES 'utf8'");
    
    // If we reach this point, connection is successful
    // echo "Connected successfully"; // Uncomment for testing
    
} catch(PDOException $e) {
    // If connection fails, stop the script and show the error
    die("Connection failed: " . $e->getMessage());
}

// Now the $pdo variable can be used in other files to interact with the database
?>
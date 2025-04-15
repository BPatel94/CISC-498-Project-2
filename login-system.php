<?php
// database_connection.php
$host = 'localhost';
$dbname = 'test';
$username = 'root';  // Replace with your MySQL username
$password = '';      // Replace with your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// First, let's modify the database to store hashed passwords
$alterTable = "ALTER TABLE student MODIFY COLUMN Password VARCHAR(255)";
try {
    $pdo->exec($alterTable);
} catch(PDOException $e) {
    // Table might already be modified, continue
}

// Update existing passwords to be hashed
$updateStmt = $pdo->query("SELECT Username, Password FROM student");
$rows = $updateStmt->fetchAll(PDO::FETCH_ASSOC);

foreach($rows as $row) {
    $hashedPassword = password_hash($row['Password'], PASSWORD_DEFAULT);
    $updatePassword = $pdo->prepare("UPDATE student SET Password = ? WHERE Username = ?");
    $updatePassword->execute([$hashedPassword, $row['Username']]);
}
?>

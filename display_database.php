
<?php
// Check if we have database configuration
if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
if (!defined('DB_USER')) define('DB_USER', 'root');  // Default username, change as needed
if (!defined('DB_PASS')) define('DB_PASS', '');      // Default password, change as needed
if (!defined('DB_NAME')) define('DB_NAME', 'test');

try {
    // Create connection using PDO
    $conn = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS
    );
    
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Prepare SQL statement
    $stmt = $conn->prepare("SELECT * FROM student");
    
    // Execute the statement
    $stmt->execute();
    
    // Check if we have results
    if ($stmt->rowCount() > 0) {
        // Fetch all records
        $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Display the results
        foreach($students as $student) {
            // Get column names dynamically
            foreach($student as $column => $value) {
                echo ucfirst($column) . ": " . htmlspecialchars($value) . "<br>";
            }
            echo "------------------------<br>";
        }
    } else {
        echo "No records found in the student table.";
    }
    
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Close connection
$conn = null;



//header("Location: attack1.php"); // Redirect to attack1.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Database - Bookwarms</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f5f5dc;
            font-family: Arial, sans-serif;
        }

        .register-container {
            width: 300px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        .register-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .register-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .register-container button {
            width: 100%;
            padding: 10px;
            background-color: #0e1a0f;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }

        .register-container button:hover {
            background-color: #45a049;
        }

        .message {
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .login-link {
            display: block;
            margin-top: 15px;
            color: #007BFF;
            text-decoration: none;
        }

        .login-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body><p>
<a href = "dashboard.php">Return to Dashboard</a></p>
<p>
</BODY>
</HTML>
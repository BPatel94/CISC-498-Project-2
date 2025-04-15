<?php
// Start session
session_start();

// Include database connection
require_once 'database_connection.php';

// Initialize error variable
$error = '';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from form
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        // Query to check username and password
        $stmt = $pdo->prepare("SELECT * FROM student WHERE Username = ? AND Password = ?");
        $stmt->execute([$username, $password]);
        
        // Check if user exists
        if ($stmt->rowCount() > 0) {
            // Login successful
            $_SESSION['username'] = $username;
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            $error = "Invalid username or password";
        }
    } catch(PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f5f5dc;
        }
        .message-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .back-link {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <div class="message-container">
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
            <a href="index.html" class="back-link">Back to Login</a>
        <?php endif; ?>
    </div>
</body>
</html>
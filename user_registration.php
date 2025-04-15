<?php
// Include database connection
require_once 'database_connection.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    try {
        // Check if username already exists
        $checkStmt = $pdo->prepare("SELECT * FROM student WHERE Username = ?");
        $checkStmt->execute([$username]);
        
        if ($checkStmt->rowCount() > 0) {
            $message = "Username already exists. Please choose another.";
        } else {
            // Insert new user
            $stmt = $pdo->prepare("INSERT INTO student (Username, Password) VALUES (?, ?)");
            $stmt->execute([$username, $password]);
            
            $message = "Registration successful! You can now login.";
        }
    } catch(PDOException $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Bookwarms</title>
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
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'successful') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Register</button>
        </form>
        <a href="index.html" class="login-link">Already have an account? Login</a>
    </div>
</body>
</html>

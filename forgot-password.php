<?php
// Include database connection
require_once 'database_connection.php';

$message = '';
$showForm = true;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $username = $_POST['username'];
    $newPassword = $_POST['new_password'];
    
    try {
        // Check if username exists
        $checkStmt = $pdo->prepare("SELECT * FROM student WHERE Username = ?");
        $checkStmt->execute([$username]);
        
        if ($checkStmt->rowCount() > 0) {
            // Update password
            $updateStmt = $pdo->prepare("UPDATE student SET Password = ? WHERE Username = ?");
            $updateStmt->execute([$newPassword, $username]);
            
            $message = "Password successfully updated! You can now login with your new password.";
            $showForm = false;
        } else {
            $message = "Username not found. Please try again.";
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
    <title>Forgot Password - Bookwarms</title>
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

        .reset-container {
            width: 300px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        .reset-container h2 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .reset-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .reset-container button {
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

        .reset-container button:hover {
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
    <div class="reset-container">
        <h2>Reset Password</h2>
        <?php if ($message): ?>
            <div class="message <?php echo strpos($message, 'successfully') !== false ? 'success' : 'error'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($showForm): ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="text" name="username" placeholder="Enter your username" required>
                <input type="password" name="new_password" placeholder="Enter new password" required>
                <button type="submit">Reset Password</button>
            </form>
        <?php endif; ?>
        
        <a href="index.html" class="login-link">Back to Login</a>
    </div>
</body>
</html>

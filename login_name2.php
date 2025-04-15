<?php
session_start();
require_once 'database_connection.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $stmt = $pdo->prepare("SELECT * FROM student WHERE Username = ? AND Password = ?");
        $stmt->execute([$username, $password]);
        
        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch();
            $_SESSION['username'] = $username;
            
            // Show welcome message
            echo '<!DOCTYPE html>
                <html lang="en">
                <head>
                    <meta charset="UTF-8">
                    <title>Welcome</title>
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
                        .welcome-container {
                            background-color: white;
                            padding: 20px;
                            border-radius: 5px;
                            box-shadow: 0 0 10px rgba(0,0,0,0.1);
                            text-align: center;
                        }
                        .welcome-message {
                            font-size: 24px;
                            color: #333;
                            margin-bottom: 20px;
                        }
                    </style>
                </head>
                <body>
                    <div class="welcome-container">
                        <div class="welcome-message">Hello ' . htmlspecialchars($username) . '!</div>
                        <p>Welcome to Bookwarms!</p>
                    </div>
                </body>
                </html>';
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
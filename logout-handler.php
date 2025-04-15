<?php
// Start the session
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session cookie
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-3600, '/');
}

// Destroy the session
session_destroy();

// Redirect to login page with a logged out message
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logged Out - Bookwarms</title>
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

        .logout-container {
            width: 300px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
        }

        .message {
            margin: 20px 0;
            color: #155724;
        }

        .login-link {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #0e1a0f;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .login-link:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="logout-container">
        <div class="message">
            <h2>Successfully Logged Out</h2>
            <p>Thank you for using Bookwarms!</p>
        </div>
        <a href="index.html" class="login-link">Return to Login</a>
    </div>
</body>
</html>

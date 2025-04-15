<HTML>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DashBoard Page</title>
    <link rel="stylesheet" href="style.css">
</head>

<BODY>
<?php
session_start();
/*echo  "Hello, " . $_SESSION['username'];*/
$username =  $_SESSION['username']; // move session var to var for output
?>
<break>
"Here we will show a few cases where your database may be vunerable to SQL attacks";
<p>Let's examine some SQL Injections.
</break>
<?php // Show welcome message
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
	?>	


	<a href = "display_database.php">Display Database All</a><br>
	<a href = "attack1.php">Select Attack 1</a>
</BODY>
</HTML>

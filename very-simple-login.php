<?php
session_start();
include 'database_connection.php';

if(isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $query = "SELECT * FROM student WHERE Username='$username' AND Password='$password'";
    $result = $pdo->query($query);
    
    if($result->rowCount() > 0) {
        $_SESSION['username'] = $username;
        header("Location: dashboard.php");
    } else {
        echo "<p style='color:red'>Invalid username or password</p>";
        echo "<a href='index.html'>Back to Login</a>";
    }
}
?>

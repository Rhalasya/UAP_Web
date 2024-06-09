<?php
    include "rental/database.php";
    session_start();

    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM akunstaff WHERE username='$username' AND password='$password'";

        $result = $db->query($sql);

        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            $_SESSION["username"] = $data["username"];
            $_SESSION["user_id"] = $data["id"]; // Pastikan ada kolom id di database
            $_SESSION["is_login"] = true;
            
            header("location: dashboardStaf.php");
        }else{
            echo "";
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff</title>
    <link rel="stylesheet" type="text/css" href="stylelog.css">
</head>
<body>
<div class="login-container">
    <h2>Login RentaLIN</h2>
    <hr>
    <form action="login.php" method="POST">
        <input type="text" placeholder="Username" name="username" required>
        <input type="password" placeholder="Password" name="password" required>
        <button type="submit" name="login">LOGIN</button>
    </form>
</div>
</body>
</html>
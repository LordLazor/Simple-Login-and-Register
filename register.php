<?php
    if(isset($_POST["submit"])){
        require("mysql.php");
        $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
        $stmt->bindParam(":user", $_POST["username"]);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count == 0){
            //Username ist frei
            if($_POST["pw"] == $_POST["pw2"]){
                //User anlegen
                $stmt = $mysql->prepare("INSERT INTO accounts (USERNAME, PASSWORD) VALUES (:user, :pw)");
                $stmt->bindParam(":user", $_POST["username"]);
                $hash = password_hash($_POST["pw"], PASSWORD_BCRYPT);
                $stmt->bindParam(":pw", $hash);
                $stmt->execute();
                echo "Account created";
            } else {
                echo "Check the password";
            }
        } else {
            echo "Username already exist";
        }
    }
    if(isset($_POST["login"])){
        header("Location: index.php");
    }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/admin_registration.css">
    <title>Simple - Register</title>
</head>
<body>

    
    
    <hr>
    <div class="login">
        <div class="login-triangle"></div>
        
        <h2 class="login-header">Simple - Register</h2>
      
        <form class="login-container" action="admin_registration.php" method="post">
          <p><input type="text" name="username" placeholder="Username"></p>
          <p><input type="password" name="pw" placeholder="Password"></p>
          <p><input type="password" name="pw2" placeholder="Repeat password"></p>
          <p><input type="submit" name="submit" value="Submit"></p>
          <p><input type="submit" name="login" value="Login instead"></p>
        </form>
      </div>
</html>
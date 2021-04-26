<?php
    if(isset($_POST["submit"])){
      require("mysql.php");
      $stmt = $mysql->prepare("SELECT * FROM accounts WHERE USERNAME = :user");
      $stmt->bindParam(":user", $_POST["username"]);
      $stmt->execute();
      $count = $stmt->rowCount();
      if($count == 1){
          //Username ist frei
        $row = $stmt->fetch();
        if(password_verify($_POST["pw"], $row["PASSWORD"])){
          session_start();
          $_SESSION["username"] = $row["USERNAME"];
          //$stmt = $mysql->prepare("UPDATE accounts SET LASTLOGIN = NOW() WHERE USERNAME=".$_SESSION["username"]);
          //$stmt->execute();
          header("Location: loggedin.html");
        } else {
          echo "Login failed.";
        }
      } else {
          echo "Check the username and password";
      }
    }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/index.css">
    <title>Simple Login Page</title>
</head>
<body>
    <div class="login">
        <div class="login-triangle"></div>
        
        <h2 class="login-header">Simple - Login</h2>
      
        <form class="login-container" action="index.php" method="post">
          <p><input type="text" name="username" placeholder="Username"></p>
          <p><input type="password" name="pw" placeholder="Password"></p>
          <p><input type="submit" name="submit" value="Login"></p>
        </form>
      </div>
</body>
</html>
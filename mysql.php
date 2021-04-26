<?php
$host = "db_host";
$name = "db_name";
$user = "db_user";
$password = "db_pw";
try{
    $mysql = new PDO("mysql:host=$host;dbname=$name", $user, $password);
} catch (PDOException $e){
    echo "SQL Error: ".$e->getMessage();
}
?>
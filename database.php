<?php
$hostName="localhost";
$dbUser="root";
$dbPassword="R394464604h";
$dbName="login-register";
$conn= mysqli_connect($hostName, $dbUser, $dbPassword, $dbName);
if(!$conn){
    die("Something went wrong!");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"
</head>
<body>
<div class="container">
<?php
        if(isset($_POST["login"])){
            $email=$_POST["email"];
            $password=$_POST["password"];
             require_once "database.php"; 
             $sql="SELECT * FROM users WHERE email='$email'";
             $result=mysqli_query($conn, $sql);
            $user=mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($user){}
            else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
            
        }
            ?>
            
<form action="registration.php" method="post"> 
<div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="E-mail:">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password:">
    </div>
    <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Login" name="submit">
    </div>
</form>
</div>
</body>
</html>
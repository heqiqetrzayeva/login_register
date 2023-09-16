<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css"
</head>
<body>
    <div class="container">
        <?php
        if(isset($_POST["submit"])){
            $name=$_POST["name"];
            $surname=$_POST["surname"];
            $email=$_POST["email"];
            $birthday=$_POST["birthday"];
            $password=$_POST["password"];
            $passwordRepeat=$_POST["repeat_password"];

            $passwordHash=password_hash($password, PASSWORD_DEFAULT);

            $errors=array();

            if(empty($name) OR empty($surname) OR empty($email) OR empty($password) OR empty($passwordRepeat)){
             array_push($errors, "All fields are required");
            }
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                array_push($errors, "Email is not valid");
            }
            if(strlen($password)<8){
                array_push($errors,"Password must be at least 8 characters long");
            }
            if($password!==$passwordRepeat){
                array_push($errors,"Password does not match");
            }
            require_once "database.php";
            $sql="SELECT * FROM users WHERE email='$email'";
            $result=mysqli_query($conn, $sql);
            $rowcount=mysqli_num_rows($result);
            if($rowcount>0){
                array_push($errors, "Email already exists!");
            }
            if(count($errors)>0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
            else{
                $sql="INSERT INTO users(name,surname,email,birthday,password) VALUES(?,?,?,?,?)";
                $stmt= mysqli_stmt_init($conn);
                $prepare_stmt= mysqli_stmt_prepare($stmt,$sql);       
                if($prepare_stmt){
                    mysqli_stmt_bind_param($stmt,"sss",$name,$surname,$email,$passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>You are registered succesfully</div>";
                }else{
                    die("Something went wrong");
                }
            }
        }
        ?>
<form action="registration.php" method="post"> 
    <div class="form-group">
        <input type="text" class="form-control" name="name" placeholder="Name:">
    </div>
    <div class="form-group">
        <input type="text"class="form-control" name="surname" placeholder="Surname:">
    </div>
    <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="E-mail:">
    </div>
    <div class="form-group">
        <input type="date" class="form-control" name="birthday" placeholder="Birthday:">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="password" placeholder="Password:">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="repeat_password" placeholder="Repeat Password:">
    </div>
    <div class="form-btn">
        <input type="submit" class="btn btn-primary" value="Register" name="submit">
    </div>
</form>
    </div>
</body>
</html>



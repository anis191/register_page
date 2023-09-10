<?php

@include 'config.php';

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password='$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){
        $error[]= 'user alrady exist!';
    }else{
        if($pass != $cpass){
            $error[]='Password not matched!';
        }else{
            $insert = "INSERT INTO user_form(name, email, password, user_type) VALUES('$name','$email','$pass','$user_type')";
            mysqli_query($conn,$insert);
            header('location:login_form.php');
        }
    }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="form_container">
        <form action="#" method="post">
            <h3>Register Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="text" name="name" required placeholder="enter your name please">
            <input type="email" name="email" required placeholder="enter your email please">
            <input type="password" name="password" required placeholder="enter a password">
            <input type="password" name="confirm_password" required placeholder="confirm password">
            <select name="user_type">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <input type="submit" name="submit" value="Register Now" class="form_btn">
            <!-- <button type="submit" name="submit" value="register now" class="form_btn">
                Register Now
            </button> -->
            <p>already have an account?<a href="login_form.php">Login Now</a> </p>
        </form>
    </div>
</body>
</html>
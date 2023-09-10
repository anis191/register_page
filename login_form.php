<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = md5($_POST['password']);
    $cpass = md5($_POST['confirm_password']);
    $user_type = $_POST['user_type'];

    $select = "SELECT * FROM user_form WHERE email = '$email' && password='$pass' ";

    $result = mysqli_query($conn, $select);

    if(mysqli_num_rows($result)>0){

        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin_page.php');
        }elseif($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:user_page.php');
        }
    }else{
        $error[] = 'incorrect email or password!';
    }
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <p>BD TRANSPORT</p>
        <p>Step into a world of convenience and comport. Welcome to BD TRANSPORT!</p>
    </section>
    <div class="form_container ex1">
        <form action="#" method="post">
            <h3>Login Now</h3>
            <?php
            if(isset($error)){
                foreach($error as $error){
                    echo '<span class="error-msg">'.$error.'</span>';
                };
            };
            ?>
            <input type="email" name="email" required placeholder="enter your email please">
            <input type="password" name="password" required placeholder="enter a password">
            <input type="submit" name="submit" value="Login Now" class="form_btn">
            <!-- <button type="submit" name="submit" value="register now" class="form_btn">
                Register Now
            </button> -->
            <p>don't have an account?<a href="register_form.php">Register Now</a> </p>
        </form>
        <div class="menu">
            <div class="HOME"><span>HOME</span></div>
            <div class="WHY_BD_TRANSPORT"><span>WHY BD TRANSPORT</span></div>
            <div class="OUR_FEATURED"><span>OUR FEATURED</span></div>
            <div class="OUR_SERVICE"><span>OUR SERVICE</span></div>
            <div class="ABOUT_US"><span>ABOUT US</span></div>
            <div class="CONTACT_US"><span>CONTACT US</span></div>
        </div>
    </div>
</body>
</html>
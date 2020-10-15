<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
            body{
               background-color: #7579e7;
               font-family: arial;
            }
            .wrapper{
                margin: auto;
                width: 60%;
                display: flex;
                column-gap: 20px;
            }
            .registration{
                background-color: #9ab3f5;
                width: 400px;
                padding-left: 40px;
                padding-bottom: 30px;
            }
            .login{
                background-color: #9ab3f5;
                margin-top:30%;
                width: 300px;
                height: 400px;
                padding-top: 50px;
                padding-left: 30px;
            }
            h1{
                color: #00587a;
            }
            label{
                color: #150485;
            }
            .error {
                color: #FF0000;
            }
            .info{
                color:purple;
                font-style:italic;
            }
            .information{
                background-color:#a3d8f4;
                margin: auto;
                width:50%;
                margin-top: 50px;
                padding-left: 30px;
                padding-top: 30px;
                padding-bottom: 30px;
                font-size: 20px;
            }
            .input{
                font-size: 20px;
                width: 80%;
                padding: 12px 20px;
                margin: 8px 0;
                display: inline-block;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
            }
            .button{
                background-color: #a3d8f4;
                border: none;
                border-radius: 4px;
                color: #00587a;
                padding: 16px 32px;
                text-decoration: none;
                margin: 4px 2px;
                cursor: pointer;
                font-size: 17px;
            }
        </style>
        <title>Registration | Login</title>
    </head>
    <body>
        <?php
            $fullnameErr = $usernameErr = $passwordErr = $confirmErr = $emailErr = $phoneErr = $birthErr = $securityErr= "";
            $fullname = $username = $password = $confirm = $email = $phone = $birth = $security= "";
            if($_SERVER["REQUEST_METHOD"]=="POST"){
                if(empty($_POST["fullname"])){
                    $fullnameErr = "Full Name is required";
                }
                else{
                    $fullname = test_input($_POST["fullname"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$fullname)) {
                        $fullnameErr = "Only letters and white space allowed";
                    }
                }
                if(empty($_POST["username"])){
                    $usernameErr = "Username is required";
                }
                else{
                    $username = test_input($_POST["username"]);
                    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
                        $usernameErr = "Only letters and white space allowed";
                    }
                }
                if(empty($_POST["password"])){
                    $passwordErr = "Password is required";
                }
                else{
                    $password = test_input($_POST["password"]);
                    if (strlen($password) < 8) {
                        $passwordErr = "Your Password Must Contain At Least 8 Characters!";
                    }
                    elseif(!preg_match("#[0-9]+#",$password)) {
                        $passwordErr = "Your password must contain at least 1 number";
                    }
                    elseif(!preg_match("#[A-Z]+#",$password)) {
                        $passwordErr = "Your password must contain at least 1 capital letter";
                    }
                    elseif(!preg_match("#[a-z]+#",$password)) {
                        $passwordErr = "Your password must contain at least 1 lowercase letter";
                    }
                }
                if(empty($_POST["confirm"])){
                    $confirmErr = "Confirmation is required";
                }
                else{
                    $confirm = test_input($_POST["confirm"]);
                    if ($confirm != $password){
                        $confirmErr = "Please make sure your passwords match";
                    }
                }
                if(empty($_POST["email"])){
                    $emailErr = "Email is required";
                }
                else{
                    $email = test_input($_POST["email"]);
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $emailErr = "Invalid email format";
                    }
                }
                if(empty($_POST["phone"])){
                    $phoneErr = "Phone Number is required";
                }
                else{
                    $phone = test_input($_POST["phone"]);
                    if (!preg_match("/\(\d{3}\)\d{2}-\d{3}-\d{3}/", $phone)) {
                        $phoneErr = "Phone number is not in the format (###)##-###-###";
                    }
                }
                if(empty($_POST["birth"])){
                    $birthErr = "Date of Birth is required";
                }
                else{
                    $birth = test_input($_POST["birth"]);
                    if (!preg_match("/^(0[1-9]|[1-2][0-9]|3[0-1])-(0[1-9]|1[0-2])-[0-9]{4}$/", $birth)) {
                        $birthErr = "The date of birth is not a valid date in the format DD-MM-YYYY";
                    }
                }
                if(empty($_POST["security"])){
                    $securityErr = "Social Security Number is required";
                }
                else{
                    $security = test_input($_POST["security"]);
                    if (!preg_match("/^([0-9]{9}|[0-9]{3}-[0-9]{2}-[0-9]{4})$/", $security)) {
                        $securityErr = "Social Security Number is not in the format ###-##-#### or #########";
                    }
                }
            
           
        }

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        ?>
        <div class="wrapper">
        <div class="registration">
        <h1>Registration</h1>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Full Name: <br>
                <input class="input" type="text" name="fullname" value="<?php echo $fullname?>">
                <span class="error">* <?php echo $fullnameErr; ?>
            </label>
            <br><br>
            <label>Username: <br>
                <input class="input" type="text" name="username" value="<?php echo $username?>">
                <span class="error">* <?php echo $usernameErr; ?>
            </label>
            <br><br>
            <label>Password: <br>
                <input class="input" type="password" name="password" id="password" value="<?php echo $password?>">
                <span class="error">* <?php echo $passwordErr; ?>
            </label>
            <br><br>
            <input type="checkbox" onclick="myFunction()">Show Password
            <br><br>
            <label>Confirm Password: <br>
                <input class="input" type="password" name="confirm" value="<?php echo $confirm?>">
                <span class="error">* <?php echo $confirmErr; ?>
            </label>
            <br><br>
            <label>Email: <br>
                <input class="input" type="email" name="email" value="<?php echo $email?>">
                <span class="error">* <?php echo $emailErr; ?>
            </label>
            <br><br>
            <label>Phone Number: <br>
                <input class="input" type="text" name="phone" value="<?php echo $phone?>">
                <span class="error">* <?php echo $phoneErr; ?>
            </label>
            <br><br>
            <label>Date of Birth: <br>
                <input class="input" type="text" name="birth" value="<?php echo $birth?>">
                <span class="error">* <?php echo $birthErr; ?>
            </label>
            <br><br>
            <label>Social Security Number: <br>
                <input class="input" type="text" name="security" value="<?php echo $security?>">
                <span class="error">* <?php echo $securityErr; ?>
            </label>
            <br><br>
            <input class="button" type="submit" name="submit" value="Register">
        </form>
        </div>
        <div class="login">
        <h1>Login</h1>
        <form method="post" action="safe.php">
            <label>Username: <br>
                <input class="input" type="text" name="user">
            </label>
            <br><br>
            <label>Password: <br>
                <input class="input" type="password" name="pass">
            </label>
            <br><br>
            <input class ="button" type="submit" name="submit" value="Login">
        </form>
        </div>
        </div>
        <?php
        $emailtest="1@gmail.com";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            if($email == $emailtest){
                echo "<div class='information'> You're already registered; change email! </div>";
            }
        elseif($fullnameErr=="" && $usernameErr=="" && $passwordErr=="" && $emailErr=="" && $phoneErr=="" && $birthErr=="" && $securityErr==""){
                echo"<div class='information'>";
                echo "Hello, <span class='info'>$fullname</span>!";
                echo "<br><br>"; 
                echo "You choose <span class='info'>$username</span> as your username."; 
                echo "<br><br>";
                echo "You choose <span class='info'>$password</span> as your password.";
                echo "<br><br>";
                echo "Your email is: <span class='info'>$email</span>";
                echo "<br><br>";
                echo "Your phone number is: <span class='info'>$phone</span>";
                echo "<br><br>";
                echo "Your birthday is on <span class='info'>$birth</span>.";
                echo "<br><br>";
                echo "Your social security number is: <span class='info'>$security</span>";
                echo "</div>";
            }
        }
        ?>
        <script>
            function myFunction() {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
            }
        </script>
    </body>
</html>
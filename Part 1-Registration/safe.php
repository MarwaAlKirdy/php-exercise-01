<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    body{
        background-color: #7579e7;
        font-family: arial;
    }
    h2{
        font-size:100px;
        margin-left: 23%;
        animation-name: result;
        animation-duration:5s;
        animation-iteration-count: infinite;
    }
    @keyframes result{
        25%{
            color:#9ab3f5;
        }
        50%{
            color: red;
        }
        100%{
            color: purple;
        }
    }   
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LogIn</title>
</head>
<body>
<?php
$username = "Marwa";
$password = "goaway";

if(($_POST["user"] != $username) || ($_POST["pass"] != $password)){
    echo "<h2> Wrong username <br> or password </h2>";
}
else{
    echo "<h2>Successful</h2>";
}
?>
</body>
</html>

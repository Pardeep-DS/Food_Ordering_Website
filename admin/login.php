<?php
session_start();
include '../includes/db.php';

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result)==1){

$_SESSION['admin']=$username;

/* Redirect directly to Orders Page */

header("Location: orders.php");
exit();

}else{

$error="Invalid Username or Password";

}

}
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Login</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Segoe UI;
}

body{

height:100vh;

display:flex;

justify-content:center;

align-items:center;

background-image:url('https://images.pexels.com/photos/70497/pexels-photo-70497.jpeg');

background-size:cover;

background-position:center;

}

/* LOGIN BOX */

.login-box{

background:rgba(255,255,255,0.2);

padding:40px;

width:350px;

border-radius:12px;

backdrop-filter:blur(10px);

box-shadow:0 8px 25px rgba(0,0,0,0.3);

text-align:center;

color:white;

}

.login-box h2{

margin-bottom:20px;

}

/* INPUT FIELDS */

.login-box input{

width:100%;

padding:10px;

margin:10px 0;

border:none;

border-radius:6px;

}

/* LOGIN BUTTON */

.login-box button{

width:100%;

padding:10px;

background:#ff5722;

color:white;

border:none;

border-radius:6px;

font-size:16px;

cursor:pointer;

margin-top:10px;

}

.login-box button:hover{

background:#e64a19;

}

/* ERROR MESSAGE */

.error{

color:#ffdddd;

margin-top:10px;

}

</style>

</head>

<body>

<div class="login-box">

<h2>Admin Login</h2>

<form method="POST">

<input type="text" name="username" placeholder="Enter Username" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>

<?php

if(isset($error)){
echo "<p class='error'>$error</p>";
}

?>

</div>

</body>
</html>


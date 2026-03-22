<?php
session_start();
include 'includes/db.php';

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

/* Check if email already exists */

$check = "SELECT * FROM users WHERE email='$email'";
$check_result = $conn->query($check);

if($check_result->num_rows > 0){

$error = "This email is already registered.";

}else{

$sql = "INSERT INTO users(name,email,password)
VALUES('$name','$email','$password')";

if($conn->query($sql)){

/* Get newly created user */

$user_id = $conn->insert_id;

/* Create session */

$_SESSION['user_id'] = $user_id;
$_SESSION['name'] = $name;

/* Redirect to homepage */

header("Location: index.php");
exit();

}else{

$error = "Registration failed. Please try again.";

}

}

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Customer Sign Up</title>

<link rel="stylesheet" href="css/style.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
min-height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f2f2f2;
}

.register-wrapper{
width:100%;
max-width:430px;
padding:20px;
}

.register-box{
background:#ffffff;
border-radius:12px;
padding:35px 28px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
text-align:center;
}

.register-title{
font-size:28px;
font-weight:bold;
color:#333;
margin-bottom:25px;
}

.input-group{
position:relative;
margin-bottom:18px;
}

.input-group input{
width:100%;
height:55px;
border:1px solid #d9d9d9;
border-radius:6px;
padding:0 16px 0 50px;
font-size:16px;
outline:none;
background:#fafafa;
}

.input-group input:focus{
border-color:#de7652;
background:#fff;
}

.icon{
position:absolute;
left:16px;
top:50%;
transform:translateY(-50%);
font-size:18px;
color:#aaa;
}

.register-btn{
width:100%;
height:55px;
border:none;
border-radius:6px;
background:#de7652;
color:#fff;
font-size:18px;
font-weight:bold;
cursor:pointer;
margin-top:5px;
}

.register-btn:hover{
background:#c96443;
}

.error{
margin-top:14px;
color:red;
font-size:14px;
}

.login-text{
margin-top:20px;
font-size:14px;
color:#666;
}

.login-text a{
color:#de7652;
text-decoration:none;
font-weight:bold;
}

</style>
</head>

<body>

<div class="register-wrapper">

<div class="register-box">

<h2 class="register-title">Sign Up</h2>

<form method="POST">

<div class="input-group">
<span class="icon">👤</span>
<input type="text" name="name" placeholder="Enter Name" required>
</div>

<div class="input-group">
<span class="icon">✉</span>
<input type="email" name="email" placeholder="Enter Email" required>
</div>

<div class="input-group">
<span class="icon">🔒</span>
<input type="password" name="password" placeholder="Enter Password" required>
</div>

<button type="submit" name="register" class="register-btn">Register</button>

</form>

<?php
if(isset($error)){
echo "<p class='error'>$error</p>";
}
?>

<div class="login-text">
Already have an account? <a href="login.php">Log In</a>
</div>

</div>

</div>

</body>
</html>


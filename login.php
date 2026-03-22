<?php
session_start();
include 'includes/db.php';

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['name'] = $row['name'];

        header("Location: index.php");
        exit();
    }else{
        $error = "Invalid Login Details";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Customer Login</title>

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

.login-wrapper{
width:100%;
max-width:420px;
padding:20px;
}

.login-box{
background:#ffffff;
border-radius:12px;
padding:35px 28px;
box-shadow:0 8px 25px rgba(0,0,0,0.08);
text-align:center;
}

.login-title{
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

.login-btn{
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
transition:0.3s;
}

.login-btn:hover{
background:#c96443;
}

.error{
margin-top:14px;
color:red;
font-size:14px;
}

.signup-text{
margin-top:20px;
font-size:14px;
color:#666;
}

.signup-text a{
color:#de7652;
text-decoration:none;
font-weight:bold;
}

</style>
</head>

<body>

<div class="login-wrapper">

<div class="login-box">

<h2 class="login-title">Sign In</h2>

<form method="POST">

<div class="input-group">
<span class="icon">✉</span>
<input type="email" name="email" placeholder="Email" required>
</div>

<div class="input-group">
<span class="icon">🔒</span>
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit" name="login" class="login-btn">Log In</button>

</form>

<?php
if(isset($error)){
echo "<p class='error'>$error</p>";
}
?>

<div class="signup-text">
New customer? <a href="register.php">Sign Up</a>
</div>

</div>

</div>

</body>
</html>

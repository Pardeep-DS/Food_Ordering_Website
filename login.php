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

header("Location: menu.php");
}else{
echo "Invalid Login Details";
}

}
?>

<h2>Login</h2>

<form method="POST">

<input type="email" name="email" placeholder="Enter Email" required>

<input type="password" name="password" placeholder="Enter Password" required>

<button type="submit" name="login">Login</button>

</form>
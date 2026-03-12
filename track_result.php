<?php
include 'includes/db.php';

$order_id = $_GET['order_id'];

$query = "SELECT * FROM orders WHERE id='$order_id'";
$result = $conn->query($query);

?>

<!DOCTYPE html>
<html>
<head>

<title>Order Status</title>

<link rel="stylesheet" href="css/style.css">

<style>

.status-box{
width:50%;
margin:auto;
margin-top:60px;
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
text-align:center;
}

.status-box h2{
color:#28a745;
margin-bottom:20px;
}

</style>

</head>

<body>

<div class="navbar">

<div class="logo">FoodOrder</div>

<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="cart.php">Cart</a></li>
<li><a href="track_order.php">Track Order</a></li>
</ul>

</div>

<div class="status-box">

<?php

if($result->num_rows > 0){

$row = $result->fetch_assoc();

echo "<h2>Order Status</h2>";

echo "<p><strong>Customer:</strong> ".$row['customer_name']."</p>";

echo "<p><strong>Address:</strong> ".$row['address']."</p>";

echo "<p><strong>Status:</strong> ".$row['status']."</p>";

echo "<p><strong>Delivery Time:</strong> ".$row['delivery_time']."</p>";

echo "<p><strong>Message from Restaurant:</strong> ".$row['admin_message']."</p>";

}

else{

echo "<h2>Order Not Found</h2>";

}

?>

</div>

</body>
</html>


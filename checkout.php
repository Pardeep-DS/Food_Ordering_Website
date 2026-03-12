<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

<title>Checkout</title>
<link rel="stylesheet" href="css/style.css">

<style>

.checkout-container{
width:60%;
margin:auto;
margin-top:40px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.order-summary{
margin-top:20px;
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
</ul>
</div>


<div class="checkout-container">

<h2>Order Summary</h2>

<div class="order-summary">

<?php

$total = 0;

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
echo "<p>Your cart is empty.</p>";
}

else{

foreach($_SESSION['cart'] as $item){

if(!is_array($item)){
continue;
}

$name = $item['name'];
$price = $item['price'];
$qty = $item['qty'];

$subtotal = $price * $qty;
$total += $subtotal;

echo "<p>$name x $qty = ₹$subtotal</p>";

}

echo "<h3>Total Amount: ₹$total</h3>";

}

?>

</div>

<br>

<form action="order_success.php" method="post">

<input type="text" name="customer_name" placeholder="Your Name" required><br><br>

<input type="text" name="address" placeholder="Delivery Address" required><br><br>

<button type="submit" class="btn">Confirm Order</button>

</form>

</div>

<footer>
<p>© 2025 Online Food Ordering System | BCA Project</p>
</footer>

</body>
</html>

<?php
session_start();
include 'includes/db.php';

/* ADD ITEM TO CART */
if(isset($_POST['food_id'])){

    $food_id = $_POST['food_id'];
    $qty = $_POST['qty'];

    $result = $conn->query("SELECT * FROM food_items WHERE id=$food_id");
    $row = $result->fetch_assoc();

    $item = [
        "name"=>$row['name'],
        "price"=>$row['price'],
        "qty"=>$qty
    ];

    $_SESSION['cart'][] = $item;
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Your Cart</title>
<link rel="stylesheet" href="css/style.css">

<style>

.cart-container{
width:70%;
margin:auto;
margin-top:40px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.cart-table{
width:100%;
border-collapse:collapse;
margin-top:20px;
}

.cart-table th,
.cart-table td{
padding:12px;
text-align:center;
border-bottom:1px solid #ddd;
}

/* Updated color here */
.cart-table th{
background:#e63946;
color:white;
font-weight:600;
}

.total{
text-align:right;
font-size:20px;
margin-top:20px;
}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">FoodOrder</div>

<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="cart.php">Cart</a></li>
</ul>

</div>


<div class="cart-container">

<h2>Your Cart</h2>

<?php

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
echo "<p>Your cart is empty.</p>";
}

else{

$total = 0;

echo "<table class='cart-table'>";
echo "<tr>
<th>Food Item</th>
<th>Price</th>
<th>Quantity</th>
<th>Subtotal</th>
</tr>";

foreach($_SESSION['cart'] as $item){

$subtotal = $item['price'] * $item['qty'];
$total += $subtotal;

echo "<tr>
<td>".$item['name']."</td>
<td>₹".$item['price']."</td>
<td>".$item['qty']."</td>
<td>₹".$subtotal."</td>
</tr>";

}

echo "</table>";

echo "<div class='total'><strong>Total: ₹".$total."</strong></div>";

}

?>

<br>

<center>
<a href="checkout.php" class="btn">Place Order</a>
</center>

</div>

<footer>
<p>© 2025 Online Food Ordering System | BCA Project</p>
</footer>

</body>
</html>

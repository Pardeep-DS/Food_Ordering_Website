<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
echo "Cart is empty.";
exit();
}

$customer_name = $_POST['customer_name'];
$address = $_POST['address'];

$total = 0;

/* Calculate total */

foreach($_SESSION['cart'] as $item){

if(!is_array($item)){
continue;
}

$name = $item['name'];
$price = $item['price'];
$qty = $item['qty'];

$total += ($price * $qty);

}

/* Insert order */

$sql = "INSERT INTO orders (customer_name, address, total_price, status)
VALUES ('$customer_name','$address','$total','Pending')";

$conn->query($sql);

/* Get Order ID */

$order_id = $conn->insert_id;

/* Insert ordered food items */

foreach($_SESSION['cart'] as $item){

if(!is_array($item)){
continue;
}

$name = $item['name'];
$qty = $item['qty'];

$result = $conn->query("SELECT id FROM food_items WHERE name='$name' LIMIT 1");
$row = $result->fetch_assoc();

$food_id = $row['id'];

$conn->query("INSERT INTO order_items (order_id, food_id, quantity)
VALUES ('$order_id','$food_id','$qty')");

}

/* Clear cart */

unset($_SESSION['cart']);

?>

<!DOCTYPE html>
<html>
<head>

<title>Order Success</title>

<link rel="stylesheet" href="css/style.css">

<style>

.success-box{
width:60%;
margin:auto;
margin-top:60px;
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
text-align:center;
}

.success-box h2{
color:#28a745;
margin-bottom:20px;
}

.order-id{
font-size:22px;
color:#ff5722;
margin:20px 0;
font-weight:bold;
}

.order-btn{
display:inline-block;
margin-top:20px;
padding:12px 25px;
background:#ff5722;
color:white;
text-decoration:none;
border-radius:6px;
}

.order-btn:hover{
background:#e64a19;
}

</style>

</head>

<body>

<div class="navbar">

<div class="logo">FoodExpress</div>

<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="cart.php">Cart</a></li>
<li><a href="track_order.php">Track Order</a></li>
</ul>

</div>

<div class="success-box">

<h2>🎉 Order Placed Successfully!</h2>

<div class="order-id">
Your Order ID: <?php echo $order_id; ?>
</div>

<p><strong>Customer:</strong> <?php echo $customer_name; ?></p>

<p><strong>Delivery Address:</strong> <?php echo $address; ?></p>

<p><strong>Total Paid:</strong> ₹<?php echo $total; ?></p>

<p><strong>Estimated Delivery Time:</strong> 20-30 minutes</p>

<p><strong>Message:</strong> Your order is being prepared.</p>

<a href="menu.php" class="order-btn">Order More Food</a>

</div>

</body>
</html>


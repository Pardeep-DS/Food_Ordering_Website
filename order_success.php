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

/* Logout popup */
.logout-item{
    position: relative;
    list-style:none;
}

.logout-popup{
    display: none;
    position: absolute;
    top: 38px;
    right: 0;
    width: 240px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.18);
    padding: 16px;
    z-index: 999;
    text-align: center;
}

.logout-popup p{
    margin: 0 0 14px 0;
    color: #333;
    font-size: 14px;
    font-weight: 600;
}

.popup-buttons{
    display:flex;
    justify-content:center;
    gap:10px;
}

.logout-btn{
    background:#e63946;
    color:white;
    border:none;
    padding:8px 16px;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

.logout-btn:hover{
    background:#c92f3a;
}

.cancel-btn{
    background:#e9ecef;
    color:#333;
    border:none;
    padding:8px 16px;
    border-radius:6px;
    cursor:pointer;
    font-weight:bold;
}

.cancel-btn:hover{
    background:#dfe3e6;
}

.logout-link{
    cursor:pointer;
}

</style>

<script>
function toggleLogoutPopup(event){
    event.preventDefault();
    event.stopPropagation();

    let popup = document.getElementById("logoutPopup");

    if(popup.style.display === "block"){
        popup.style.display = "none";
    }else{
        popup.style.display = "block";
    }
}

function closeLogoutPopup(){
    document.getElementById("logoutPopup").style.display = "none";
}

document.addEventListener("click", function(event){
    let popup = document.getElementById("logoutPopup");
    let logoutItem = document.querySelector(".logout-item");

    if(logoutItem && !logoutItem.contains(event.target)){
        popup.style.display = "none";
    }
});
</script>

</head>

<body>

<div class="navbar">

<div class="logo">FoodExpress</div>

<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="menu.php">Menu</a></li>
<li><a href="cart.php">Cart</a></li>
<li><a href="track_order.php">Track Order</a></li>

<li class="logout-item">
    <a href="#" class="logout-link" onclick="toggleLogoutPopup(event)">Logout</a>

    <div class="logout-popup" id="logoutPopup">
        <p>Are you sure you want to logout?</p>
        <div class="popup-buttons">
            <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
            <button class="cancel-btn" onclick="closeLogoutPopup()">Cancel</button>
        </div>
    </div>
</li>
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

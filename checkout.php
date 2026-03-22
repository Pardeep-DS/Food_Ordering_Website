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
<div class="logo">FoodOrder</div>

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

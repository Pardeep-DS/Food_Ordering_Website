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

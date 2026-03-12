<!DOCTYPE html>
<html>
<head>

<title>Track Order</title>

<link rel="stylesheet" href="css/style.css">

<style>

.track-box{
width:40%;
margin:auto;
margin-top:80px;
background:white;
padding:40px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
text-align:center;
}

.track-box input{
width:80%;
padding:10px;
margin-top:20px;
border:1px solid #ccc;
border-radius:5px;
}

.track-box button{
margin-top:20px;
padding:10px 20px;
background:#ff5722;
color:white;
border:none;
border-radius:5px;
cursor:pointer;
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

<div class="track-box">

<h2>Track Your Order</h2>

<form action="track_result.php" method="GET">

<input type="number" name="order_id" placeholder="Enter Order ID" required>

<br>

<button type="submit">Track Order</button>

</form>

</div>

</body>
</html>


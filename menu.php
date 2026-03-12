<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html>
<head>

<title>Food Menu</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Segoe UI, sans-serif;
}

body{
background:#f4f6f9;
}

/* NAVBAR */

.navbar{
display:flex;
justify-content:space-between;
align-items:center;
background:#ff5722;
padding:15px 8%;
color:white;
}

.navbar a{
color:white;
text-decoration:none;
margin-left:20px;
font-weight:bold;
}

.navbar a:hover{
text-decoration:underline;
}

/* MENU SECTION */

.menu{
padding:60px 8%;
text-align:center;
}

.menu-title{
font-size:36px;
margin-bottom:40px;
color:#333;
}

/* GRID */

.menu-container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
gap:30px;
}

/* FOOD CARD */

.food-card{
background:white;
border-radius:15px;
overflow:hidden;
box-shadow:0 8px 20px rgba(0,0,0,0.1);
transition:0.3s;
padding-bottom:20px;
}

.food-card:hover{
transform:translateY(-8px);
box-shadow:0 12px 30px rgba(0,0,0,0.2);
}

.food-card img{
width:100%;
height:180px;
object-fit:cover;
}

/* TEXT */

.food-card h3{
margin-top:15px;
font-size:22px;
}

.food-card p{
color:#777;
margin:5px 15px 10px;
}

/* PRICE */

.price{
font-size:20px;
font-weight:bold;
color:#e63946;
margin-bottom:15px;
}

/* CART AREA */

.cart-area{
display:flex;
justify-content:center;
gap:10px;
}

.cart-area input{
width:60px;
padding:6px;
border-radius:6px;
border:1px solid #ccc;
text-align:center;
}

/* BUTTON */

.cart-area button{
background:#ff5722;
color:white;
border:none;
padding:8px 15px;
border-radius:6px;
cursor:pointer;
font-weight:bold;
transition:0.3s;
}

.cart-area button:hover{
background:#e64a19;
transform:scale(1.05);
}

</style>

</head>

<body>

<div class="navbar">

<h2>FoodOrder</h2>

<div>
<a href="index.php">Home</a>
<a href="menu.php">Menu</a>
<a href="cart.php">Cart</a>
</div>

</div>


<section class="menu">

<h2 class="menu-title">Our Delicious Menu</h2>

<div class="menu-container">

<?php

$result = $conn->query("SELECT * FROM food_items");

while($row = $result->fetch_assoc()){

?>

<div class="food-card">

<img src="images/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<div class="price">₹<?php echo $row['price']; ?></div>

<form action="cart.php" method="POST">

<input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">

<div class="cart-area">

<input type="number" name="qty" value="1" min="1">

<button type="submit">Add to Cart</button>

</div>

</form>

</div>

<?php } ?>

</div>

</section>

</body>
</html>


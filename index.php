<?php
include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Online Food Ordering System</title>

<link rel="stylesheet" href="css/style.css">

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
    <div class="logo">
        🍔 FoodExpress
    </div>

    <ul class="nav-links">
        <li><a href="index.php">Home</a></li>
        <li><a href="menu.php">Menu</a></li>
        <li><a href="cart.php">Cart</a></li>
        <li><a href="track_order.php">Track Order</a></li>
    </ul>
</nav>

<!-- HERO SECTION -->

<section class="hero">

    <div class="hero-text">
        <h1>Delicious Food Delivered To Your Door</h1>
        <p>Online Food Ordering System | BCA Project</p>

        <a href="menu.php" class="btn">Order Now</a>
    </div>

</section>


<!-- FEATURED FOODS -->

<section class="foods">

<h2>Popular Dishes</h2>

<div class="food-container">

<?php
$result = $conn->query("SELECT * FROM food_items LIMIT 6");

while($row = $result->fetch_assoc()){
?>

<div class="food-card">

<img src="images/<?php echo $row['image']; ?>" alt="food">

<h3><?php echo $row['name']; ?></h3>

<p><?php echo $row['description']; ?></p>

<div class="price">₹<?php echo $row['price']; ?></div>

<form action="cart.php" method="POST">

<input type="hidden" name="food_id" value="<?php echo $row['id']; ?>">

<input type="number" name="qty" value="1" min="1">

<button type="submit">Add to Cart</button>

</form>

</div>

<?php } ?>

</div>

</section>


<!-- FOOTER -->

<footer>

<p>© <?php echo date("Y"); ?> Online Food Ordering System | BCA Project</p>

</footer>

</body>
</html>


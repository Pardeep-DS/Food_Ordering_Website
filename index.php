<?php
include 'includes/db.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Online Food Ordering System</title>

<link rel="stylesheet" href="css/style.css">

<style>

/* Logout popup */
.logout-item{
    position: relative;
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

.logout-popup .popup-buttons{
    display: flex;
    justify-content: center;
    gap: 10px;
}

.logout-popup .logout-btn{
    background: #e63946;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.logout-popup .logout-btn:hover{
    background: #c92f3a;
}

.logout-popup .cancel-btn{
    background: #e9ecef;
    color: #333;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.logout-popup .cancel-btn:hover{
    background: #dfe3e6;
}

.logout-link{
    cursor: pointer;
}

</style>

<script>
function toggleLogoutPopup(event){
    event.preventDefault();
    event.stopPropagation();

    let popup = document.getElementById("logoutPopup");

    if(popup.style.display === "block"){
        popup.style.display = "none";
    } else {
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

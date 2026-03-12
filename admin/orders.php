<?php
session_start();
include '../includes/db.php';

if(!isset($_SESSION['admin'])){
header("Location: login.php");
exit();
}

$query = "
SELECT 
orders.id,
orders.customer_name,
orders.address,
orders.total_price,
orders.status,
orders.delivery_time,
orders.admin_message,
food_items.name AS food_name,
order_items.quantity
FROM orders
JOIN order_items ON orders.id = order_items.order_id
JOIN food_items ON order_items.food_id = food_items.id
ORDER BY orders.id DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html>
<head>

<title>Admin Orders</title>

<style>

body{
font-family:Arial;
background:#f4f6f9;
padding:40px;
}

.container{
background:white;
padding:30px;
border-radius:10px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

table{
width:100%;
border-collapse:collapse;
}

th,td{
padding:12px;
border-bottom:1px solid #ddd;
text-align:center;
}

th{
background:#ff5722;
color:white;
}

input{
padding:6px;
width:120px;
}

textarea{
width:150px;
height:40px;
}

button{
background:#28a745;
color:white;
border:none;
padding:6px 10px;
cursor:pointer;
}

</style>

</head>

<body>

<div class="container">

<h2>Customer Orders</h2>

<table>

<tr>
<th>Order ID</th>
<th>Customer</th>
<th>Address</th>
<th>Food</th>
<th>Qty</th>
<th>Total</th>
<th>Delivery Time</th>
<th>Message</th>
<th>Action</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>";

echo "<td>".$row['id']."</td>";
echo "<td>".$row['customer_name']."</td>";
echo "<td>".$row['address']."</td>";
echo "<td>".$row['food_name']."</td>";
echo "<td>".$row['quantity']."</td>";
echo "<td>₹".$row['total_price']."</td>";

?>

<form action="update_order.php" method="POST">

<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

<td>
<input type="text" name="delivery_time" placeholder="20 min">
</td>

<td>
<textarea name="admin_message" placeholder="Message"></textarea>
</td>

<td>
<button type="submit">Send</button>
</td>

</form>

<?php

echo "</tr>";

}

?>

</table>

</div>

</body>
</html>


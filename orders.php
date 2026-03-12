<?php
session_start();
include 'includes/db.php';

if(!isset($_SESSION['user_id'])){
    echo "Please login first";
    exit();
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM orders WHERE user_id='$user_id'";
$result = $conn->query($sql);
?>

<h2>Your Orders</h2>

<table border="1" cellpadding="10">

<tr>
<th>Order ID</th>
<th>Total Price</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php

while($row = $result->fetch_assoc()){

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>₹".$row['total_price']."</td>";
echo "<td>".$row['status']."</td>";
echo "<td>".$row['created_at']."</td>";
echo "</tr>";

}

?>

</table>
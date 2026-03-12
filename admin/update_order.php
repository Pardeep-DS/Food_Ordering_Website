<?php

include '../includes/db.php';

$order_id = $_POST['order_id'];
$delivery_time = $_POST['delivery_time'];
$admin_message = $_POST['admin_message'];

$conn->query("UPDATE orders 
SET delivery_time='$delivery_time',
admin_message='$admin_message',
status='Accepted'
WHERE id='$order_id'");

header("Location: orders.php");

?>


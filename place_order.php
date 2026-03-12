<?php
session_start();
include 'includes/db.php';

$user_id = 1; // example user

$total = 0;

foreach($_SESSION['cart'] as $id => $qty){
$res = $conn->query("SELECT price FROM food_items WHERE id=$id");
$row = $res->fetch_assoc();
$total += $row['price'] * $qty;
}

$conn->query("INSERT INTO orders(user_id,total_price) VALUES('$user_id','$total')");
$order_id = $conn->insert_id;

foreach($_SESSION['cart'] as $id => $qty){

$res = $conn->query("SELECT price FROM food_items WHERE id=$id");
$row = $res->fetch_assoc();

$conn->query("INSERT INTO order_items(order_id,food_id,quantity,price)
VALUES('$order_id','$id','$qty','".$row['price']."')");
}

unset($_SESSION['cart']);

echo "Order placed successfully!";
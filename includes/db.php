<?php

$conn = new mysqli("localhost","root","","food_order_db");

if($conn->connect_error){
die("Connection Failed: ".$conn->connect_error);
}

?>
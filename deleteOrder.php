<?php 
    include('connect.php');
    $id = $_GET['id'];
    $food = "SELECT * FROM orders WHERE id = '$id'";
    $food_found = $connect->query($food);
    if ($food_found->num_rows > 0) {
        while ($food = $food_found->fetch_assoc()) {
            $food_name = $food['food_name'];
            $username = $food['username'];
            $image = $food['food_image'];
        }
    }
    $message = "The Food You Ordered Is Already Delivered";
    $delete = "DELETE FROM orders WHERE id = '$id'";
    $send_message = "INSERT INTO messages (username, message, food_image, food_name) VALUES ('$username', '$message', '$image', '$food_name')";
    if ($connect->query($delete) and $connect->query($send_message)) {
        header('location: orderRecieved.php');
    }
?>
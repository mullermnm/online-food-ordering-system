<?php 
    include('connect.php');
    $food_id = $_GET['food_id'];
    $food = "SELECT * FROM orders WHERE id = '$food_id'";
    $food_found = $connect->query($food);
    if ($food_found->num_rows > 0) {
        while ($the_food = $food_found->fetch_assoc()) {
            $username = $the_food['username'];
            $food_name = $the_food['food_name'];
            $save = "INSERT INTO review_ask (username, food_id, food_name) VALUES ('$username', '$food_id', '$food_name')";
            if ($connect->query($save)) {
                header('location: orderRecieved.php');
            }
        }
    }
?>
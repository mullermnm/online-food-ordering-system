<?php 
    include('connect.php');


    //uploading food
    if (isset($_POST['post_food'])) {
        $food_name = $connect->real_escape_string($_POST['food_name']);
        $food_price = $connect->real_escape_string($_POST['price']);
        $food_catagory = $connect->real_escape_string($_POST['food_catagory']);
        $food_detail = $connect->real_escape_string($_POST['food_detail']);
        $food_image = $_FILES['food_image']['name'];
        //$img_ext = strtolower(pathinfo($food_image, PATHINFO_EXTENSION));
        $save_food = "INSERT INTO foods (food_name, food_price, food_catagory, food_image, food_detail) VALUES ('$food_name', '$food_price', '$food_catagory', '$food_image', '$food_detail')";
        if (move_uploaded_file($_FILES['food_image']['tmp_name'], "food_images_posted/".$food_image)) {
            if ($connect->query($save_food)) {
                header('location: newFood.php');
            }            
        }
        
    
    }
?>
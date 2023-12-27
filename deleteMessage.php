<?php 
    include('connect.php');
    $id = $_GET['id'];
    $delete = "DELETE FROM messages WHERE id = '$id'";
    if ($connect->query($delete)) {
        header('location: myOrders.php');
    }
?>
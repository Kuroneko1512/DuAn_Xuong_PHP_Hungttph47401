<?php 
    session_start();

    if(!isset($_SESSION['login']) && $_SESSION['login'] != 'admin'){
        header('location: login.php');
        exit();
    }
    
    require 'connection.php';

    if(isset($_GET['id_delete'])){
        $id_delete = $_GET['id_delete'];

        // Xoá ảnh nếu xoá người dùng

        $sql_image = "SELECT product_img FROM `products` WHERE product_id = $id_delete";

        $stmt_image = $conn->prepare($sql_image);

        $stmt_image->execute();

        $image_path = $stmt_image->fetchColumn();

        // Sau đó xoá người dùng
        
        $sql_delete = "DELETE FROM `products` WHERE product_id = $id_delete";

        $stmt_delete = $conn->prepare($sql_delete);

        $stmt_delete->execute();
        
        if($image_path && file_exists("../img/" . $image_path)){
            unlink("../img/" . $image_path);
        }

        header('location: ../index.php?page=list');
    }
?>
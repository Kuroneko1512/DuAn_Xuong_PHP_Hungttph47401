<?php
    session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['UserId'])){
        header('location: login.php');
        exit();
    }

    require 'connection.php';
    
    
        $cart_id = $_GET['id'];
        $userId = $_SESSION['UserId'];
    
        $sql_delete = "DELETE FROM cart WHERE cart_id = $cart_id AND customer_id = $userId";
    
        $stmt_delete = $conn->prepare($sql_delete);
    
        $stmt_delete->execute();
    
        // header('location: index.php?page=cart');
        if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
            // Chuyển hướng người dùng quay lại trang trước đó
            header('Location: ' . $_SERVER['HTTP_REFERER']);
        } else {
            // Nếu không có trang trước đó, chuyển hướng về trang chính
            header('Location: index.php'); // Điều hướng về trang chính hoặc trang mặc định khác
        }
        exit();
    
?>
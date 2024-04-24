<?php 
    session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['UserId'])){
        header('location: login.php');
        exit();
    }

    require 'connection.php';
    $product_id = $_GET['id'];
    $pro_quantity = $_POST['soluong'];

    $sql_pro = "SELECT products.*, categories.categories_name 
                        FROM products 
                        INNER JOIN categories ON products.categories_id = categories.categories_id 
                        WHERE product_id = :product_id";

    $stmt_pro = $conn->prepare($sql_pro);

    $stmt_pro->bindParam(':product_id', $product_id, PDO::PARAM_INT);

    $stmt_pro->execute();

    $data_pro = $stmt_pro->fetch(PDO::FETCH_ASSOC);


        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $sql_check = "SELECT * FROM `cart` WHERE product_id = :product_id AND customer_id = :customer_id";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt_check->bindParam(':customer_id', $_SESSION['UserId'], PDO::PARAM_INT);
        $stmt_check->execute();
        $data_check = $stmt_check->fetch(PDO::FETCH_ASSOC);
    
        if($data_check){
            // Nếu sản phẩm đã tồn tại, cập nhật số lượng
            $new_quantity = $data_check['quantity_pro'] + $pro_quantity;
            $sql_update = "UPDATE `cart` SET `quantity_pro` = :new_quantity WHERE product_id = :product_id AND customer_id = :customer_id";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bindParam(':new_quantity', $new_quantity, PDO::PARAM_INT);
            $stmt_update->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt_update->bindParam(':customer_id', $_SESSION['UserId'], PDO::PARAM_INT);
            $stmt_update->execute();

            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                // Chuyển hướng người dùng quay lại trang trước đó
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                // Nếu không có trang trước đó, chuyển hướng về trang chính
                header('Location: index.php'); // Điều hướng về trang chính hoặc trang mặc định khác
            }
        } else {
            $pro_name = $data_pro['product_name'];
            $pro_price = $data_pro['product_price'];
            $pro_img = $data_pro['product_img'];
            
            // Nếu sản phẩm chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
            $sql_insert = "INSERT INTO `cart`(`customer_id`, `product_id`, `name_pro`, `quantity_pro`, `price_pro`, `img_pro`) 
                                VALUES (:customer_id, :product_id, :pro_name, :quantity_pro, :pro_price, :pro_img)";
            $stmt_insert = $conn->prepare($sql_insert);
            $stmt_insert->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $stmt_insert->bindParam(':customer_id', $_SESSION['UserId'], PDO::PARAM_INT);
            $stmt_insert->bindParam(':quantity_pro', $pro_quantity, PDO::PARAM_INT);
            $stmt_insert->bindParam(':pro_name', $pro_name, PDO::PARAM_STR);
            $stmt_insert->bindParam(':pro_price', $pro_price, PDO::PARAM_INT);
            $stmt_insert->bindParam(':pro_img', $pro_img, PDO::PARAM_STR);
            $stmt_insert->execute();

            if(isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])){
                // Chuyển hướng người dùng quay lại trang trước đó
                header('Location: ' . $_SERVER['HTTP_REFERER']);
            } else {
                // Nếu không có trang trước đó, chuyển hướng về trang chính
                header('Location: index.php'); // Điều hướng về trang chính hoặc trang mặc định khác
            }
        }
?>
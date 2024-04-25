<?php
    session_start();
    if(!isset($_SESSION['login'])&&$_SESSION['login'] != 'admin'){
        header('location: login.php');
        exit();
    }

    require 'connection.php';
    
    $sql_categories = "SELECT * FROM `categories`";

    $stmt_cate_id = $conn->prepare($sql_categories);

    $stmt_cate_id->execute();  

    $danhMuc = $stmt_cate_id->fetchAll(PDO::FETCH_ASSOC);

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $ten_sanPham = $_POST['product_name'];
        $gia_sanPham = $_POST['product_price'];
        $soLuong = $_POST['product_quantity'];
        $danhMuc = $_POST['product_category'];
        $moTa = $_POST['product_description'];

        $file = $_FILES["product_image"];

        if(!empty($file)){
            $image = time() ."_". $file["name"];

            $target_file = "../img/" . $image;

            move_uploaded_file($file["tmp_name"],$target_file);
        }
                
        $sql_add = "INSERT INTO products (product_name, product_price, product_quantity, product_img, product_description, categories_id) 
        VALUES ('$ten_sanPham', $gia_sanPham, $soLuong, '$image','$moTa', $danhMuc)";

        $stmt_add = $conn->prepare($sql_add);

        $stmt_add->execute();
            
        header("location: ../index.php?page=list");
        // } else {
        //     echo "Không thêm được";
        // }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
</head>

<body>
    <h2>Thêm Sản Phẩm</h2>    
    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <label for="product_name">Tên Sản Phẩm</label>
                </td>
                <td>
                    <input type="text" name="product_name" id="" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_price">Giá Sản Phẩm</label>
                </td>
                <td>
                    <input type="text" name="product_price" id="" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_quantity">Số Lượng</label>
                </td>
                <td>
                    <input type="text" name="product_quantity" id="" value="">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_category">Danh Mục</label>
                </td>
                <td>    
                    <select name="product_category" id="">
                        <?php foreach ($danhMuc as $row) { ?>
                            <option value="<?php echo $row['categories_id'] ?> ">
                                <?php echo $row['categories_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_description">Mô Tả</label>
                </td>
                <td>
                    <textarea name="product_description" id="" cols="30" rows="10"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_image">Hình Ảnh</label>
                </td>
                <td>
                    <input type="file" name="product_image" id="">
                </td>
            </tr>
        </table>
        
        <button type="submit" name="add_product">Thêm mới</button>   

    </form>
</body>

</html>
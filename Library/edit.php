<?php
    session_start();

    if(!isset($_SESSION['login']) && $_SESSION['login'] != 'admin'){
        header('location: login.php');
        exit();
    }

    require 'connection.php';
    
    $sql_categories = "SELECT * FROM `categories`";

    $stmt_cate_id = $conn->prepare($sql_categories);

    $stmt_cate_id->execute();

    $danhMuc = $stmt_cate_id->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['id_edit'])){
        $id_edit = $_GET['id_edit'];
        
        // $sql_edit = "SELECT * FROM `products`inner join categories on products.categories_id = categories.categories_id WHERE product_id = $id_edit";
        $sql_pro = "SELECT * FROM `products` WHERE product_id = $id_edit";

        $stmt_edit = $conn->prepare($sql_pro);

        $stmt_edit->execute();

        $detail_sanPham = $stmt_edit->fetch(PDO::FETCH_ASSOC);
        
        if(!$detail_sanPham){
            echo "Sản phẩm không tồn tại";
            exit();   
        }
        // show_array($resuilt_edit);  
        print_r($detail_sanPham);

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //Lấy dữ liệu
            $ten_sanPham = $_POST['product_name'];
            $gia_sanPham = $_POST['product_price'];
            $soLuong = $_POST['product_quantity'];
            $danhMuc = $_POST['product_category'];
            $moTa = $_POST['product_description'];

            $file = $_FILES["product_image"];

            if(!empty($file["name"])){
                $image = time() ."_". $file["name"];

                $target_file = "../img/" . $image;

                move_uploaded_file($file["tmp_name"],$target_file);
                
                if ($detail_sanPham["product_img"] && file_exists("../img/" . $detail_sanPham["product_img"])) {
                    // Nếu update ảnh thì phải xóa ảnh cũ đi
                    unlink("../img/" . $detail_sanPham["product_img"]);
                }
            } else {
                // Nếu người dùng ko thực hiện sửa ảnh thì phải lấy lại ảnh cũ
                $image = $detail_sanPham["product_img"];
            }

            $sql_edit = "UPDATE products SET    product_name = '$ten_sanPham',
                                                product_price = $gia_sanPham,
                                                product_quantity = $soLuong,
                                                product_img = '$image',
                                                product_description = '$moTa',
                                                categories_id = $danhMuc
                                            WHERE product_id = $id_edit";

            $stmt_edit = $conn->prepare($sql_edit);

            $stmt_edit->execute();

            header("location: ../index.php?page=list");

            
        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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
                    <input type="text" name="product_name" id="" value="<?= $detail_sanPham['product_name'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_price">Giá Sản Phẩm</label>
                </td>
                <td>
                    <input type="text" name="product_price" id="" value="<?= $detail_sanPham['product_price'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_quantity">Số Lượng</label>
                </td>
                <td>
                    <input type="text" name="product_quantity" id="" value=" <?= $detail_sanPham['product_quantity'] ?>">
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_category">Danh Mục</label>
                </td>
                <td>    
                    <select name="product_category" id="">
                        <?php foreach ($danhMuc as $row) { ?>
                            <option value="<?php echo $row['categories_id'] ?> " <?= ($detail_sanPham['categories_id'] == $row['categories_id']) ? "selected" : "" ?> >
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
                    <textarea name="product_description" id="" cols="30" rows="10">
                        <?= isset($detail_sanPham['product_description']) ? $detail_sanPham['product_description'] : "" ?>
                    </textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="product_image">Hình Ảnh</label>
                </td>
                <td>
                    <input type="file" name="product_image" id="">
                    <br>
                    <img width="100px" src="../img/<?=( empty( $detail_sanPham['product_img']) || !isset( $detail_sanPham['product_img'])) ? 'default.jpg' : $detail_sanPham['product_img'] ?>" alt="">
                </td>
            </tr>
        </table>
        
        <button type="submit" name="edit_produc">Chỉnh Sửa</button>   

    </form>
</body>

</html>
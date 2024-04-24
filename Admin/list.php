<?php 
    if(!isset($_SESSION['login'])&&$_SESSION['login'] != 'admin'){
        header('location: login.php');
        exit();
    }
    require 'Library/connection.php';
    $sql_select = " SELECT * FROM `products` 
                    INNER JOIN `categories` 
                    ON products.categories_id = categories.categories_id
                    ORDER BY product_id DESC";
    $result_select = $conn->prepare($sql_select);

    $result_select->execute();

    $data_select = $result_select->fetchAll();
    
?>

<section class="list-product">
                <h1>Danh sách Sản Phẩm</h1>
                <table class="admin-list">
                    <tr>
                        <th>STT</th>
                        <th>Id</th>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Miêu tả</th>
                        <th>Danh Mục</th>
                        <th>Thao tác</th>
                    </tr>
                    <tr>
                        <td colspan="9">
                            <a href="./Library/add.php">Add</a>
                        </td>
                    </tr>
            <?php foreach($data_select as $key => $value){  ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $value['product_id'] ?></td>
                        <td>
                            <img width="100px" src="./img/<?=( empty( $value['product_img']) || !isset( $value['product_img'])) ? 'default.jpg' : $value['product_img'] ?>" alt="">
                        </td>
                        <td><?= $value['product_name'] ?></td>
                        <td><?= $value['product_price'] ?></td>
                        <td><?= $value['product_quantity'] ?></td>
                        <td><?= $value['product_description'] ?></td>
                        <td><?= $value['categories_name'] ?></td>
                        <td class="admin-tools">                        
                            <button><a href="./Library/edit.php?id_edit=<?= $value['product_id'] ?>">Edit</a> </button>
                            <button><a href="./Library/delete.php?id_delete=<?= $value['product_id'] ?>" onclick="return confirm('Bạn có muốn xoá không?')">Delete</a></button>
                        </td>
                    </tr>
            <?php  }  ?>
                    
                </table>
            </section>
            <!-- end product -->
        </div>
        <!-- end content -->

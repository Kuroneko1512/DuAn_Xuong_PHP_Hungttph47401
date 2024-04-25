<?php 
    require 'Library/connection.php';

    $sql_cate = "SELECT * FROM categories";

    $stmt_cate = $conn->prepare($sql_cate);

    $stmt_cate->execute();

    $cate = $stmt_cate->fetchAll(PDO::FETCH_ASSOC);
    
    // print_r($cate);
?>

<div class="content set-width"> 
            <nav>
                <ul>
                    <?php if(isset($_SESSION['login'])&&$_SESSION['login'] == 'admin'){ ?>
                            <li><a href="?page=list">Danh Sách Sản Phẩm</a></li>
                            <li><a href="?page=account">Danh Sách Người Dùng</a></li>
                    <?php  }  ?>
                    <li><a href="?page=home_product">Trang chủ</a></li>
                    <li><a href="?page=new">Giới Thiệu</a></li>
                    <!-- <li><a href="?page=laptop">Laptop</a></li>
                    <li><a href="?page=phone">Điện Thoại</a></li>
                    <li><a href="?page=tablet">Máy Tính Bảng</a></li> -->
                    <?php foreach ($cate as $key => $value) { ?>
                        <li><a href="?page=cate_detail&id=<?= $value['categories_id'] ?>"><?= $value['categories_name'] ?></a></li>
                    <?php } ?>                    
                    <li><a href="?page=contact">Liên Hệ</a></li>
                    <!-- <li><a href="?page=demo">Test</a></li> -->
                </ul>
            </nav>
            <!-- end menu -->
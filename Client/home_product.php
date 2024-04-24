<?php 
    require 'Library/connection.php';

    $sql_categories = "SELECT categories_name FROM categories";

    $stmt_categories = $conn->prepare($sql_categories);

    $stmt_categories->execute();

    $loai_sanPhams = $stmt_categories->fetchAll(PDO::FETCH_COLUMN);


?>

<section class="product-list">
    <?php foreach ($loai_sanPhams as $loai_sanPham) { 
        // Truy vấn để lấy danh sách sản phẩm của loại sản phẩm đang xét
        $sql_products = "SELECT products.*, categories.categories_name 
        FROM products 
        INNER JOIN categories ON products.categories_id = categories.categories_id 
        WHERE categories.categories_name = :loai_sanPham";

        $stmt_products = $conn->prepare($sql_products);

        $stmt_products->bindParam(':loai_sanPham', $loai_sanPham, PDO::PARAM_STR);

        $stmt_products->execute();

        $products = $stmt_products->fetchAll(PDO::FETCH_ASSOC);

        // Biến đếm số sản phẩm đã hiển thị
        $count = 0;

        if (count($products) > 0) { ?>
                <div class="product-type ">
                    <h1 class="product-title"><?= $loai_sanPham ?></h1>                    
                    <div class="product-area">
                        <?php  foreach ($products as $sanPham) {
                                // Kiểm tra số lượng sản phẩm đã hiển thị
                                if ($count >= 8) {
                                    break; // Thoát khỏi vòng lặp nếu đã hiển thị đủ 8 sản phẩm
                                } // Hiển thị thông tin sản phẩm
                        ?>
                        <figure class="product-details">
                            <div class="product-picture">
                                <a href="?page=detail&id=<?= $sanPham['product_id'] ?>">
                                    <img src="./img/<?=( empty( $sanPham['product_img']) 
                                                                || !isset( $sanPham['product_img'])) 
                                                                ? 'default.jpg' : $sanPham['product_img'] ?>" alt="">
                                </a>
                            </div>
                            <div class="product-name">
                                <a href="?page=detail&id=<?= $sanPham['product_id'] ?>">
                                    <p><?= $sanPham['product_name'] ?></p>
                                </a>
                            </div>
                            <div class="product-prices">
                                <span class="original-price">7.000.000 VND</span>
                                <span class="sale-price"><?= $sanPham['product_price'] ?> VND</span>                                                            
                            </div>
                            <div class="product-status">
                                <p class="in-stock">Sẵn Hàng</p>
                                <p class="out-of-stock"></p>
                                <div class="icon-plug-in">
                                    <a href=""><i class="fa fa-heart-o " aria-hidden="true"></i></a>
                                    <a href="?page=detail&id=<?= $sanPham['product_id'] ?>"><i class="fa fa-shopping-cart " aria-hidden="true"></i></a>
                                    <!-- <a href=""><i class="fa fa-heart " aria-hidden="true"></i></a> -->
                                </div> 
                            </div>
                        </figure>   
                    <?php $count++; // Tăng biến đếm sau mỗi sản phẩm hiển thị
                    } ?>  <!-- Kết thúc vòng lặp -->                                     
                    </div>                                       
                </div>  
    <?php } } ?>      
            </section>
            <!-- end product -->
        </div>
        <!-- end content -->
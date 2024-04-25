<?php 
    // require 'Library/connection.php';

    $id_sanPham = $_GET['id'];

    // Câu truy vấn SQL để lấy các sản phẩm 
    $sql_type = "SELECT products.*, categories.categories_name 
                FROM products 
                INNER JOIN categories ON products.categories_id = categories.categories_id 
                WHERE categories.categories_id = :id_sanPham";
    
    $stmt_type = $conn->prepare($sql_type);

    $stmt_type->bindParam(':id_sanPham', $id_sanPham, PDO::PARAM_STR);

    $stmt_type->execute();
    
    $danhSachSanPham = $stmt_type->fetchAll(PDO::FETCH_ASSOC);

    // print_r($danhSachSanPham);
    
    if(!$danhSachSanPham){
        echo "Sản phẩm không tồn tại";
        exit();
    }

?>

<section class="product-list">
                <div class="product-type ">
                    <h1 class="product-title"><?= $danhSachSanPham[0]['categories_name'] ?></h1>                    
                    <div class="product-area">
                    <?php foreach ($danhSachSanPham as $sanPham) { ?>
                        <figure class="product-details">
                            <div class="product-picture">
                                <a href="?page=detail&id=<?= $sanPham['product_id'] ?>">
                                    <img src="./img/<?=( empty( $sanPham['product_img']) || !isset( $sanPham['product_img'])) ? 'default.jpg' : $sanPham['product_img'] ?>" alt="">
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
                        <?php } ?>                                      
                    </div>                                       
                </div>      
            </section>
            <!-- end product -->
        </div>
        <!-- end content -->
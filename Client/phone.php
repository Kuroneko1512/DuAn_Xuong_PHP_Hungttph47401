<?php 
    require 'Library/connection.php';

    $loai_sanPham = "SmartPhone";

    // Câu truy vấn SQL để lấy các sản phẩm là "laptop"
    $sql_type = "SELECT products.*, categories.categories_name 
                FROM products 
                INNER JOIN categories ON products.categories_id = categories.categories_id 
                WHERE categories.categories_name = :loai_sanPham";
    
    $stmt_type = $conn->prepare($sql_type);

    $stmt_type->bindParam(':loai_sanPham', $loai_sanPham, PDO::PARAM_STR);

    /*bindParam(':loai_sanPham', $loai_sanPham, PDO::PARAM_STR): 
    Phương thức bindParam() được sử dụng để ràng buộc giá trị của biến $loai_sanPham 
    vào tham số :loai_sanPham trong câu truy vấn SQL. 
    Câu truy vấn này được chuẩn bị trước đó bằng phương thức prepare(). 
    Tham số thứ hai $loai_sanPham là giá trị được ràng buộc vào tham số :loai_sanPham, 
    trong trường hợp này là "laptop". 
    Tham số thứ ba PDO::PARAM_STR xác định kiểu dữ liệu của tham số ràng buộc, ở đây là kiểu chuỗi (string).
    
    :loai_sanPham: Đây là tên của tham số trong câu truy vấn SQL, được đặt trước dấu hai chấm (:). */

    $stmt_type->execute();
    
    $danhSachSanPham = $stmt_type->fetchAll(PDO::FETCH_ASSOC);
    
    if(!$danhSachSanPham){
        echo "Sản phẩm không tồn tại";
        exit();
    }

?>

<section class="product-list">
                <div class="product-type ">
                    <h1 class="product-title"><?= $loai_sanPham ?></h1>                    
                    <div class="product-area">
                    <?php foreach ($danhSachSanPham as $sanPham) { ?>
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
                                    <a href="?page=detail&id=<?= $sanPham['product_id'] ?>">
                                        <i class="fa fa-shopping-cart " aria-hidden="true"></i>
                                    </a>
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
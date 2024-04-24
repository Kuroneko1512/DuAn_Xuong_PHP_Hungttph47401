<?php
    require 'Library/connection.php';
    // Kiểm tra xem có tham số id được truyền từ URL không
    if(isset($_GET['id'])) {
        // Lấy id sản phẩm từ URL
        $product_id = $_GET['id'];

        // print_r($product_id);
        // die();

        // Truy vấn để lấy thông tin chi tiết của sản phẩm
        $sql_pro = "SELECT products.*, categories.categories_name 
                        FROM products 
                        INNER JOIN categories ON products.categories_id = categories.categories_id 
                        WHERE product_id = :product_id";

        $stmt_pro = $conn->prepare($sql_pro);

        $stmt_pro->bindParam(':product_id', $product_id, PDO::PARAM_INT);

        $stmt_pro->execute();

        // Lấy thông tin chi tiết sản phẩm từ kết quả truy vấn
        $product_detail = $stmt_pro->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem sản phẩm có tồn tại không
        if($product_detail) { ?>
            <!-- // Hiển thị thông tin chi tiết của sản phẩm -->
            
            <section class="product-list">
                    <div class="details-pro">
                        <div id="alert" style="display: none;"></div>
                        <form  action="./Library/cart_add_pro.php?id=<?= $product_id ?>" method="POST" enctype="multipart/form-data">
                            <div class="up-area">
                                <div class="picture-area">
                                    <img src="./img/<?= ( empty( $product_detail['product_img']) || !isset( $product_detail['product_img'])) ? 'default.jpg' : $product_detail['product_img'] ?>" alt="">
                                </div>
                                <div class="text-area">
                                    <p class="ten-sanpham"><?= $product_detail['product_name'] ?></p>
                                    <hr>
                                    <p class="gia-sanpham"><?= $product_detail['product_price'] ?> VND</p><br>
                                    <p class="ma-sanpham">Mã sản phẩm:<b> VIETEN#<?= $product_detail['product_id'] ?></b></p><br>
                                    <p class="mota-sanpham">
                                        <strong>Mô tả sản phẩm :</strong>
                                        <br><br>
                                        <?= $product_detail['product_description'] ?>
                                    </p><br>
                                    <div class="cart">
                                        <label for="soluong">Số lượng:</label>
                                        <input type="number" name="soluong" id="soluong" min="0" value="1" max="<?= $product_detail['product_quantity'] ?>" inputmode="numeric">
                                        <!-- <input type="submit" name="btn_add_cart" id="btn_add_cart" value="Thêm giỏ hàng"> -->
                                        <button type="submit" name="btn_add_cart">Thêm giỏ hàng</button>
                                    </div>                                    
                                </div>
                            </div>
                        </form>
                        <div class="detail-area">
                            <h2>CHI TIẾT SẢN PHẨM</h2>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit aperiam dolore dolor cupiditate distinctio eum sit neque mollitia, beatae, modi sunt hic quasi ea? Consequuntur quo placeat officia vitae quas.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum voluptate iusto sit voluptatum officia officiis? Labore reiciendis, delectus veritatis enim blanditiis eaque minus sunt beatae ipsum exercitationem provident eligendi.
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero optio modi, sit quos velit nam! Ad, itaque! Tempore harum eaque exercitationem commodi, aut accusantium veniam? Id enim ullam placeat?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, esse suscipit doloribus nihil cumque eaque atque molestias temporibus voluptatibus fuga, eius expedita earum natus neque quisquam. Obcaecati aut a impedit?
                            </p><br>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Velit aperiam dolore dolor cupiditate distinctio eum sit neque mollitia, beatae, modi sunt hic quasi ea? Consequuntur quo placeat officia vitae quas.
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet earum voluptate iusto sit voluptatum officia officiis? Labore reiciendis, delectus veritatis enim blanditiis eaque minus sunt beatae ipsum exercitationem provident eligendi.
                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero optio modi, sit quos velit nam! Ad, itaque! Tempore harum eaque exercitationem commodi, aut accusantium veniam? Id enim ullam placeat?
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, esse suscipit doloribus nihil cumque eaque atque molestias temporibus voluptatibus fuga, eius expedita earum natus neque quisquam. Obcaecati aut a impedit?
                            </p>
                        </div>
                    </div>
                <!-- // Thêm các thông tin khác cần hiển thị về sản phẩm -->
            </section>
            <!-- end product -->
        </div>
        <!-- end content -->
            
        <?php } else {
            // Nếu không tìm thấy sản phẩm, hiển thị thông báo
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        // Nếu không có id sản phẩm được truyền, hiển thị thông báo lỗi
        echo "Lỗi: Không có id sản phẩm được cung cấp.";
    }
?>

<script>
    document.getElementById("addToCartForm").addEventListener("submit", function(event) {
        event.preventDefault(); // Ngăn chặn việc tải lại trang
        
        var formData = this;
        console.log(formData);
        
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "index.php?page=cart", true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Xử lý phản hồi từ server ở đây
                    document.getElementById("alert").textContent = "Sản phẩm đã được thêm vào giỏ hàng!";
                    document.getElementById("alert").style.display = "block";
                } else {
                    document.getElementById("alert").textContent = "Có lỗi xảy ra khi thêm vào giỏ hàng";
                    document.getElementById("alert").style.display = "block";
                }
            }
        };
        xhr.send(formData);
    });
</script>

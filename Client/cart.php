<?php 
    // session_start();
    if(!isset($_SESSION['login']) && !isset($_SESSION['UserId'])){
        header('location: login.php');
        exit();
    }

    require 'Library/connection.php';

    // giỏ hàng

    $sql_cart = "SELECT * FROM `cart` WHERE customer_id = $_SESSION[UserId]";

    $stmt_cart = $conn->prepare($sql_cart);

    $stmt_cart->execute();

    $datacart = $stmt_cart->fetchAll();
    
    $tong = 0;
    foreach($datacart as $value){
        $gia = $value['price_pro'] * $value['quantity_pro'];
        $tong += $gia;
    }
?>
    
    <div class="cart_area">
        <div class="cart">
            <h1>Giỏ hàng</h1>
            <br>
            <table>
                <tr>
                    <th>STT</th>
                    <th>Mã Sản Phẩm</th>
                    <th>Ảnh Sản Phẩm</th>
                    <th>Tên Sản Phẩm</th>
                    <th>Giá Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Thành Tiền</th>
                </tr>
                <?php foreach($datacart as $key => $value){ ?>
                <tr>
                    <td><?= ++$key ?></td>
                    <td><?= $value['product_id'] ?></td>
                    <td>
                        <img src="./img/<?= (empty($value['img_pro']) || !isset($value['img_pro'])) 
                                                        ? 'default.jpg' : $value['img_pro'] ?>" 
                        width="80px" alt="">
                    </td>
                    <td><?= $value['name_pro'] ?></td>
                    <td><?= $value['price_pro'] ?></td>
                    <td>
                        <input type="number" value="<?= $value['quantity_pro'] ?>" min="0" max="" inputmode="numeric">                    
                    </td>
                    <td>
                        <?= $gia ?>
                        <a href="./Library/cart_delete_pro.php?&id=<?=$value['cart_id'] ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                    </td>
                </tr>
                <?php } ?>
                <tr>
                    <td colspan="6">Tổng tiền: </td>
                    <td><?= $tong ?> VND</td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td >
                        <button>Cập nhập giỏ hàng</button>
                    </td>
                    <td>
                        <button><a href="?page=payment">Thanh Toán</a></button>
                    </td>
                </tr>
            </table>
            
        </div>
    </div>
</div>
        <!-- end content -->
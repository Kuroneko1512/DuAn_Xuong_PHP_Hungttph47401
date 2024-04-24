<?php 
    if(!isset($_SESSION['login'])&&$_SESSION['login'] != 'admin'){
        header('location: login.php');
        exit();
    }
    require 'Library/connection.php';
    $sql_user = " SELECT * FROM `customer` ";
    $stmt_user = $conn->prepare($sql_user);

    $stmt_user->execute();

    $data_user = $stmt_user->fetchAll(PDO::FETCH_ASSOC);
    
?>

<section class="list-product">
                <h1>Danh sách Người Dùng</h1>
                <table class="admin-list">
                    <tr>
                        <th>STT</th>
                        <th>Id</th>
                        <th>Ảnh</th>
                        <th>Tên người dùng</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Số Điện Thoại</th>
                        <th>Địa Chỉ</th>
                        <th>Vai Trò</th>
                    </tr>
            <?php foreach($data_user as $key => $value){  ?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $value['customer_id'] ?></td>
                        <td>
                            <img width="100px" src="./img/<?=( empty( $value['customer_image']) || !isset( $value['customer_image'])) ? 'default.jpg' : $value['customer_image'] ?>" alt="">
                        </td>
                        <td><?= $value['customer_name'] ?></td>
                        <td><?= $value['email'] ?></td>
                        <td class="show-password">
                            <span class="password" data-password="<?= htmlspecialchars($value['password']) ?>" data-visible="false"><?php echo str_repeat('*', strlen($value['password'])); ?></span>
                            <i class="fa fa-eye toggle-password" aria-hidden="true"></i>
                        </td>
                        <td><?= $value['phone'] ?></td>
                        <td><?= $value['address'] ?></td>
                        <td><?= $value['role'] ?></td>                        
                    </tr>
            <?php  }  ?>
                    <!-- <tr>
                        <td colspan="9">
                            <a href="./Library/add.php">Add</a>
                        </td>
                    </tr> -->
                </table>
            </section>
            <!-- end product -->
        </div>
        <!-- end content -->

<?php 
    session_start();

    require 'Library/connection.php';

    require 'Include/header.php';
?>
<?php 
    require 'Include/menu.php';
    $page = !empty($_GET['page']) ? $_GET['page'] : "home_product";

    // Kiểm tra nếu session 'login' tồn tại và có giá trị 'admin'
    if (isset($_SESSION['login']) && $_SESSION['login'] == 'admin') {
        // Kiểm tra xem file trong thư mục "Admin/" tồn tại hay không
        $adminPath = "Admin/{$page}.php"; // Thêm thư mục "Admin/"

        if (file_exists($adminPath)) {
            require $adminPath; // Yêu cầu tệp từ thư mục "Admin/"
        } else {
            // Kiểm tra và yêu cầu tệp từ thư mục "Client/"
            $clientPath = "Client/{$page}.php"; // Thêm thư mục "Client/
            
            if (file_exists($clientPath)) {
                require $clientPath;
            } else {
                echo "Trang Không Tồn Tại";
            }
        }
    } 
    
    // Nếu không phải admin hoặc không tồn tại session 'login' hoặc session 'login' không có giá trị 'admin'
    else {
        // Kiểm tra và yêu cầu tệp từ thư mục "Client/"
        $clientPath = "Client/{$page}.php"; // Thêm thư mục "Client/"
        if (file_exists($clientPath)) {
            require $clientPath; // Yêu cầu tệp từ thư mục "Client/"
        } else {
            echo "Trang Không Tồn Tại"; // Hiển thị thông báo nếu tệp không tồn tại
        }
    }   

?>    
            
<?php 
    require 'Include/footer.php';
?>
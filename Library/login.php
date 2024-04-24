<?php 
    session_start();
    require 'connection.php';

    if(isset($_POST['sign_in'])){
        $username = $_POST['Sign_in_name'];
        $password = $_POST['Sign_in_pass'];
        $sql_login = "SELECT * FROM `customer` WHERE `customer_name` = '$username' AND `password` = '$password'";
        $result_login = $conn->prepare($sql_login);

        if($result_login->execute()){

            $row = $result_login->fetch();
            
            if(!empty($row)) { // Kiểm tra nếu có dữ liệu trả về từ câu truy vấn
                $_SESSION['login'] = $row['role']; // Truy cập vào cột 'role' của dòng đầu tiên
                $_SESSION['UserId'] = $row['customer_id'];
                header('location: ../index.php');
                exit();                
            } else {
                echo "Sai tên đăng nhập hoặc mật khẩu.";
            }              
        }else{
            echo "Đã xảy ra lỗi khi thực hiện truy vấn.";
        }        
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../Public/Login_Register.css">
</head>
<body>
    <section class="login-sign-up-section ">
        <div class="log-sign" id="log-sign">
            <div class="form-container sign-up-container">
                <form action="" method="POST">
                    <h1>Create Account</h1>
                    <div class="social-container">
                        <a href="" class="social">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="" class="social">
                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </a>
                        <a href="" class="social">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                    </div>
                    <span>or use your email for registration</span>
                    <input type="text" placeholder="Name" name="Sign_up_name"/>
                    <input type="email" placeholder="Email" name="Sign_up_email" />
                    <input type="password" placeholder="Password" name="Sign_up_pass"/>
                    <button type="submit" value="sign_up" name="sign_up">Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action="" method="POST">
                    <h1>Sign in</h1>
                    <div class="social-container">
                        <a href="" class="social">
                            <i class="fa fa-facebook-f" aria-hidden="true"></i>
                        </a>
                        <a href="" class="social">
                            <i class="fa fa-google-plus" aria-hidden="true"></i>
                        </a>
                        <a href="" class="social">
                            <i class="fa fa-linkedin" aria-hidden="true"></i>
                        </a>
                    </div>
                    <span>or use your account</span>
                    <input type="text" placeholder="Username" name="Sign_in_name"/>
                    <input type="password" placeholder="Password" name="Sign_in_pass"/>
                    <div class="remember-check">
                        <div class="check-box">
                            <input type="checkbox" name="remember" id="" />
                            <label for="">Remember</label>
                        </div>
                        <a href=""><b>Forgot your password?</b></a>
                    </div>
                    <button type="submit" value="sign_in" name="sign_in">Sign In</button>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Sign In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Friend!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="../Public/Login-Register.js"></script>
</body>
</html>

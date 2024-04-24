<?php 
    $hostname = "localhost";
    $database_name = "assign_hungttph47401";    
    $username = "root";
    $password = "";

    try {
        $conn = new PDO("mysql:host=$hostname;dbname=$database_name", $username, $password);
        // thiết lập lỗi PDO để ngoại lệ
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "<p style='display: none'>Connected successfully </p>";
    } catch (PDOException $e) {
        echo "Connection failed: ". $e->getMessage();
    }    
?>
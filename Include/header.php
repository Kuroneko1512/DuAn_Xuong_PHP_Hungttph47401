<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Home</title>
    <link rel="stylesheet" href="Public/INdex.css">
    <link rel="stylesheet" href="Public/Admin-list.css">
    <link rel="stylesheet" href="Public/detail-pro.css">
</head>

<body>
    <div class="container">
        <header class="set-width">
            <div class="left-header">
                <a href="index.php">PHP1</a>
            </div>
            <div class="right-header">
                <a href="?page=cart"><i class="fa fa-cart-plus" aria-hidden="true"></i></a>
                <a href="Library/login.php"><i class="fa fa-user" aria-hidden="true"></i></a>
                <?php if (isset($_SESSION['login'])) { ?>
                <a href="Library/logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a>                 
                <?php }?>
            </div>
        </header>
        <hr>
    <!-- end header -->
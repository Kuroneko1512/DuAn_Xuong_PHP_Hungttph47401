<?php
session_start();

// Check if the session exists
if(isset($_SESSION['login']) && isset($_SESSION['username']) ){
    // Unset the specific session variable
    unset($_SESSION['username']);   
    unset($_SESSION['pass']);
    unset($_SESSION['login']);
    // Redirect the user to the login page
    header('location: index.php');
    exit();
} else {
    // Session does not exist, redirect to the login page
    header('location: index.php');
    exit();
}
?>
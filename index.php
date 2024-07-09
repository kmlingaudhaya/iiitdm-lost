<?php
require_once 'assets/php/config.php'
require_once 'assets/php/functions.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in, redirect to dashboard or another appropriate page
    echo "logged in";
    // header("location:?dashboard");
    exit;
}

if (isset($_GET['signup'])) {
    $vars = ['page_title' => 'Pictogram - signUp'];
    showPage('header', $vars);
    showPage('signup');
} else if (isset($_GET['login'])) {
    $vars = ['page_title' => 'Pictogram - login'];
    showPage('header', $vars);
    showPage('login');
} else {
    showPage('footer');
}
?>

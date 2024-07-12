<?php

require_once 'assets/php/functions.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in, check ac_status and redirect accordingly
    $user_data = getUserDataByUsernameOrEmail($_SESSION['username']);
    if ($user_data['ac_status'] == 0) {
        // Not verified, redirect to emailVerify.php
        $vars = ['page_title' => 'Pictogram - verify'];
        showPage('header', $vars);
        showPage('verify_email');
        
    } elseif ($user_data['ac_status'] == 1) {
        $vars = ['page_title' => 'Pictogram - Home'];
        showPage('header', $vars);
        showPage('wall');
        
    } elseif ($user_data['ac_status'] == 2) {
        // Blocked, redirect to block.php
        header("location: blocked.php");
        
    }
}

else    if (isset($_GET['signup'])) {
    $vars = ['page_title' => 'Pictogram - signUp'];
    showPage('header', $vars);
    showPage('signup');
} else if (isset($_GET['login'])) {
    $vars = ['page_title' => 'Pictogram - login'];
    showPage('header', $vars);
    showPage('login');
} else {
    $vars = ['page_title' => 'Pictogram - login'];
    showPage('header', $vars);
    showPage('login');
}

showPage('footer');
?>
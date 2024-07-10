<?php

require_once 'assets/php/functions.php';

if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // User is logged in, check ac_status and redirect accordingly
    $user_data = getUserDataByUsernameOrEmail($_SESSION['username']);
    if ($user_data['ac_status'] == 0) {
        // Not verified, redirect to emailVerify.php
        header("location: emailVerify.php");
        exit;
    } elseif ($user_data['ac_status'] == 1) {
        // Verified, redirect to wall.php
        header("location: wall.php");
        exit;
    } elseif ($user_data['ac_status'] == 2) {
        // Blocked, redirect to block.php
        header("location: block.php");
        exit;
    }
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
    showPage('header', ['page_title' => 'Pictogram - login']);
    showPage('login');
}

showPage('footer');
?>
<?php

require_once 'config.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME) or die('Could not connect: ' . mysqli_error($db));

// Function for showing pages
function showPage($page, $data = []) {
    extract($data);
    include("assets/pages/$page.php");
}

// Function to check if the username is unique
function isUniqueUsername($username) {
    global $db;
    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) == 0;
}

// Function to check if the email is unique
function isUniqueEmail($email) {
    global $db;
    $query = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    return mysqli_num_rows($result) == 0;
}

// Function to insert a new user into the database
function insertNewUser($first_name, $last_name, $email, $gender, $username, $password) {
    global $db;
    $query = "INSERT INTO users (first_name, last_name, email, gender, username, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'ssssss', $first_name, $last_name, $email, $gender, $username, $password);
    return mysqli_stmt_execute($stmt);
}

// Function to check if a username or email exists
function usernameOrEmailExists($username_email) {
    global $db;
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username_email, $username_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) > 0) {
        return true; // Username or email exists
    } else {
        return false; // Username or email does not exist
    }
}

// Function to get user data by username or email
function getUserDataByUsernameOrEmail($username_email) {
    global $db;
    $query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = mysqli_prepare($db, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username_email, $username_email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user_data = mysqli_fetch_assoc($result);
    return $user_data;
}


?>

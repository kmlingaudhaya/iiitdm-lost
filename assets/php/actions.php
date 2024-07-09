<?php
session_start(); // Ensure session is started?

require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_type = $_POST['form_type']; 

    if ($form_type == 'signup') {
        // Signup logic
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (empty($first_name) || empty($last_name) || empty($email) || empty($gender) || empty($username) || empty($password)) {
            header("location:../../?signup&message=Please fill in all the fields");
        } else {
            if (isUniqueUsername($username) && isUniqueEmail($email)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                if (insertNewUser($first_name, $last_name, $email, $gender, $username, $hashed_password)) {
                    header("location:../../?login");
                    exit;
                } else {
                    header("location:../../?signup&message=Failed to register user. Please try again.");
                    exit;
                }
            } else {
                header("location:../../?signup&message=Username or email already exists. Please choose a different one.");
                exit;
            }
        }
    } elseif ($form_type == 'login') {
        // Login logic
        $username_email = $_POST['username_email'];
        $password = $_POST['password'];

        if (empty($username_email) || empty($password)) {
            header("location:../../?login&message=Please fill in all the fields");
            exit;
        } else {
            if (usernameOrEmailExists($username_email)) {
                $user_data = getUserDataByUsernameOrEmail($username_email);
                $hashed_password = $user_data['password'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION['logged_in'] = true;
                    header("location:../../");
                    exit;
                } else {
                    header("location:../../?login&message=Invalid password");
                    exit;
                }
            } else {
                header("location:../../?login&message=Username or email does not exist");
                exit;
            }
        }
    }
}
?>

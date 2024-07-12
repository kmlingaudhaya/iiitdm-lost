<?php

require_once 'config.php';
require_once 'functions.php';
require_once 'PHPMailer/send_code.php';

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
        $_SESSION['form_data'] = $_POST; // storing the form data in a session to be used in functions.php

        if (empty($first_name) || empty($last_name) || empty($email) || empty($gender) || empty($username) || empty($password)) {
            $_SESSION['incomplete_error'] = "Please fill in all the fields";
            header("location:../../?signup");
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
                $_SESSION['duplicate_error'] = "Username or email already exists";
                header("location:../../?signup&message=Username or email already exists. Please choose a different one.");
                exit;
            }
        }
    } elseif ($form_type == 'login') {
        // Login logic
        $username_email = $_POST['username_email'];
        $_SESSION['username'] = $username_email; // creating a session and storing the log in detail. so that i can use this in index.php to retrieve ac_status from the database
        $password = $_POST['password'];

        if (empty($username_email) || empty($password)) {
            $_SESSION['unfilled_error'] = "Please fill in all the fields";
            header("location:../../?login");
            exit;
        } else {
            if (usernameOrEmailExists($username_email)) {
                $user_data = getUserDataByUsernameOrEmail($username_email);
                $hashed_password = $user_data['password'];
                

                if (password_verify($password, $hashed_password)) {
                    if ($user_data['ac_status'] == 0) {
                        $_SESSION['logged_in'] = true;
                        // Generate a 6-digit code and send it to the user's email
                        $code = rand(100000, 999999);
                        $_SESSION['generated_code'] = $code;
                        $email = $user_data['email']; // Get the user's email from the database
                        sendVerificationCode($email, $code); // Use the user's email to send the verification code
                        header("location:../../");
                        exit;
                    } else {
                        $_SESSION['logged_in'] = true;
                        header("location:../../");
                        exit;
                    }
                    
                } else {
                    //create a session variable and store the message
                    $_SESSION['password_error'] = "Incorrect password. Please try again.";
                    header("location:../../?login");
                    exit;
                }
            } else {
                $_SESSION['username_email_error'] = "Incorrect email or username. Please try again.";
                header("location:../../?login");
                exit;
            }
            }
    } elseif ($form_type == 'verify_email') {
        // Verify email logic
        $code = $_POST['code'];
        $user_email = $_SESSION['username']; // Get the user's email from the session
        $generated_code = $_SESSION['generated_code']; // Get the generated code from the session

        if (empty($code)) {
            $_SESSION['code_error'] = "Please enter the verification code";
            header("location:../../?verify_email");
            exit;
        } else {
            if ($code == $generated_code) {
                // Update the account status to 1 (verified)
                updateAccountStatus($user_email, 1);
                $_SESSION['verified'] = true;
                header("location:../../");
                exit;
            } else {
                $_SESSION['wrong_code_error'] = "Invalid verification code. Please try again.";
                header("location:../../?verify_email");
                exit;
            }
        }
    }
} 
?>

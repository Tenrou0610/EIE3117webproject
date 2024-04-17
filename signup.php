<?php
session_start();

// When the submit button is pressed in the registration page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    include 'function.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $nickname = $_POST['nickname'];
    $email = $_POST['email'];


    //profile image part
    if (isset($_FILES['profileimage'])) {
        $profileimage_name = $_FILES['profileimage']['name'];
        $profileimage_size = $_FILES['profileimage']['size'];
        $profileimage_tmp_name = $_FILES['profileimage']['tmp_name'];
        $profileimage_error = $_FILES['profileimage']['error'];

        if ($profileimage_error === 0) {
            if ($profileimage_size > 20 * 1024 * 1024 * 8) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> Your file size is too large! Please try a new one!
                    <button type="button" class="btn-close" onclick="history.back()">Go Back</button>
                </div>';
                exit;
            }

            $profileimage_ex = pathinfo($profileimage_name, PATHINFO_EXTENSION);
            $profileimage_ex_lc = strtolower($profileimage_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($profileimage_ex_lc, $allowed_exs)) {
                $new_profileimage_name = uniqid("IMG-", true) . '.' . $profileimage_ex_lc;
                $profileimage_upload_path = 'userimage/' . $new_profileimage_name;
                move_uploaded_file($profileimage_tmp_name, $profileimage_upload_path);
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Warning!</strong> You can only upload the jpg, jpeg, and png formats for your profile image! Please try a new one!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                exit;
            }
        } elseif ($profileimage_error === 4) {
            //when the error = 4 which means no file is uploaded, a default.jpg will be assigned
            $profileimage_upload_path = "userimage/default.jpg";
        } else {
            // Error occurred during file upload
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Something went wrong when uploading your profile image! Please try again.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
            exit;
        }
    }



    // Check if the login ID already exists
    $check_loginid_existence_query = "SELECT username FROM `registration` WHERE username = ?";
    $check_loginid_existence_stmt = mysqli_prepare($connection, $check_loginid_existence_query);
    mysqli_stmt_bind_param($check_loginid_existence_stmt, "s", $username);
    mysqli_stmt_execute($check_loginid_existence_stmt);
    $check_loginid_existence_result = mysqli_stmt_get_result($check_loginid_existence_stmt);

    if (mysqli_num_rows($check_loginid_existence_result) > 0) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Warning!</strong> This username is already in use. Please choose a different one!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
    } else {
        $check_email_existence_query = "SELECT email FROM `registration` WHERE email = ?";
        $check_email_existence_stmt = mysqli_prepare($connection, $check_email_existence_query);
        mysqli_stmt_bind_param($check_email_existence_stmt, "s", $email);
        mysqli_stmt_execute($check_email_existence_stmt);
        $check_email_existence_result = mysqli_stmt_get_result($check_email_existence_stmt);

        if (mysqli_num_rows($check_email_existence_result) > 0) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> This email is already in use. Please choose a different one!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            if ($password != $confirmpassword) {
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Warning!</strong> Passwords do not match! Please try again!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            } else {
                $hashedpassword = password_hash($password, PASSWORD_DEFAULT);

                $insert_user_query = "INSERT INTO `registration` (username, password, nickname, email, profileimage) VALUES (?, ?, ?, ?, ?)";
                $insert_user_stmt = mysqli_prepare($connection, $insert_user_query);
                mysqli_stmt_bind_param($insert_user_stmt, "sssss", $username, $hashedpassword, $nickname, $email, $profileimage_upload_path);
                mysqli_stmt_execute($insert_user_stmt);

                // Inform the user about successful registration
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> You have registered successfully! You can now log in.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
    }
}
?>


<!doctype html>
<html lang="en">



<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signup page</title>
    <!--bootstrap css-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>



<body>
    <!--bootstrap javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>


    <h1 class="text-center">Registration</h1>
    <div class="container mt-5">
        <form action="signup.php" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="loginid" class="form-label">loginid</label>
                <input type="text" class="form-control" placeholder="Enter your id for login" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <div class="mb-3">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" placeholder="Enter your password again" name="confirmpassword" required>
            </div>
            <div class="mb-3">
                <label for="nickname" class="form-label">Nickname</label>
                <input type="text" class="form-control" placeholder="Enter your Nickname" name="nickname" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" placeholder="Enter your Email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="profileimage" class="form-label">Profile Image</label>
                <input type="file" class="form-control" placeholder="upload your image" name="profileimage" id="profileimage">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <div><a href="login.php">already have an account?</a></div>
        </form>
    </div>
</body>
































</html>
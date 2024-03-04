<?php
session_start();




//when the submit button is pressed in registration page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);

    //check the loginid first then compare the password with hashed password stored in the database use password_verify
    $login_query = "SELECT * FROM `registration` WHERE username = '$username'";
    $login_result = mysqli_query($connection, $login_query);

    //check if the input is equal to the result in the database, then the user is log in
    if (mysqli_num_rows($login_result) > 0) {

        $row = mysqli_fetch_array($login_result);
        $current_row_password = $row['password'];

        if (password_verify($password, $current_row_password)) {
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning!</strong> Invalid loginid or password!Please Try again!
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
        }
    } else {
        //if the found row of query result is less than 0, that mean the user is not existed or the input is wrong
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning!</strong> Invalid loginid or password!Please Try again!
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
    }
}




?>


<!doctype html>
<html lang="en">




<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login page</title>
    <!--bootstrap used-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>




<body>
    <!--bootstrap javascript-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>




    <h1 class="text-center fs-1 text-info ">LOGIN</h1>
    <div class="container mt-5">
        <form action="login.php" method="post">
            <div class="mb-3 text-primary fs-3">
                <label for="loginid" class="form-label">Loginid</label>
                <input type="text" class="form-control" placeholder="Enter your id for login" name="username" required>
            </div>
            <div class="mb-3 text-primary fs-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" placeholder="Enter your password" name="password" required>
            </div>
            <div class="container mb-3 text-primary fs-5">
                <div class="row">
                    <div class="col-md-4 mb-3 text-start">
                        <a href="signup.php">sign up</a>
                    </div>
                    <div class="col-md-4 mb-3 text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                    <div class="col-md-4 mb-3 text-end">
                        <input type="checkbox" name="remember" class="me-2">Remember me
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>




</html>
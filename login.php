<?php
session_start();


// Check if the login cookie is set or not, if cookie is set, used them to login
if (isset($_COOKIE['username_cookie']) && isset($_COOKIE['password_cookie'])) {
   include 'connect.php';
   $login_query = "SELECT * FROM `registration` WHERE username = '{$_COOKIE['username_cookie']}' and password = '{$_COOKIE['password_cookie']}'";
   $login_result = mysqli_query($connection, $login_query);


   if (mysqli_num_rows($login_result) > 0) {
       // The username exists, so log in the user
       $_SESSION['username'] = $_COOKIE['username_cookie'];
       header("Location: index.php");
       exit();
   }
}


//when the submit button is pressed in registration page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';
    include 'function.php';
    $username = mysqli_real_escape_string($connection, $_POST['username']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
 
    // Check the loginid first, then compare the password with the hashed password stored in the database using password_verify
    $login_query = "SELECT * FROM `registration` WHERE username = '$username'";
    $login_result = mysqli_query($connection, $login_query);
 
    // Check if the input is equal to the result in the database, then the user is logged in
    if (mysqli_num_rows($login_result) > 0) {
        $row = mysqli_fetch_array($login_result);
        $current_row_password = $row['password'];
 
        if (password_verify($password, $current_row_password)) {
            //when the user press remember me, the login status will be stored in cookie
            if (!empty($_POST['rememberme'])){
            setcookie('username_cookie', $row['username'], time() + 3600, '/');
            setcookie('password_cookie', $row['password'], time() + 3600, '/');
            setcookie('nickname_cookie', $row['nickname'], time() + 3600, '/');
            } 
            $_SESSION['username'] = $row['nickname'];
            header("Location: index.php");
            exit();
        
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning!</strong> Invalid login ID or password! Please try again!
               <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
               </div>';
        }
    } else {
        // If the found row of query result is less than 0, that means the user does not exist or the input is incorrect
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning!</strong> Invalid login ID or password! Please try again!
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
   <!--<link rel="stylesheet" href="style.css">-->
</head>


<body>
   <!--bootstrap javascript-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

   <h1 class="text-center fs-1 text-info ">LOGIN</h1>
   <div class="container mt-5">
       <form action="login.php" method="post">
           <div class="mb-3 text-primary fs-3">
               <label for="loginid" class="form-label">Loginid</label>
               <input type="text"  value="<?php if(isset($_COOKIE['username_cookie'])){echo $_COOKIE['username_cookie'];} ?>"  class="form-control" placeholder="Enter your id for login" name="username" required>
           </div>
           <div class="mb-3 text-primary fs-3">
               <label for="password" class="form-label">Password</label>
               <input type="password" value="<?php if(isset($_COOKIE['password_cookie'])){echo $_COOKIE['password_cookie'];} ?>" class="form-control" placeholder="Enter your password" name="password" required>
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
                       <input type="checkbox" <?php if(isset($_COOKIE['username_cookie']) && isset($_COOKIE['password_cookie'])){echo "checked";}?> name="rememberme" class="me-2"><label for="rememberme">Remember me</label>
                   </div>
               </div>
           </div>
       </form>
   </div>
</body>




</html>

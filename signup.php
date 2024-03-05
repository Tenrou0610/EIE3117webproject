<?php
session_start();

// When the submit button is pressed in the registration page
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   include 'connect.php';
   include 'function.php';
   $username = mysqli_real_escape_string($connection, $_POST['username']);
   $password = mysqli_real_escape_string($connection, $_POST['password']);
   $confirmpassword = mysqli_real_escape_string($connection, $_POST['confirmpassword']);
   $nickname = mysqli_real_escape_string($connection, $_POST['nickname']);
   $email = mysqli_real_escape_string($connection, $_POST['email']);




   //if(!preg_match("//"))


   //check the loginid is existed or not since it is used to login
   $check_loginid_existence_query = $check_loginid_existence_query = "SELECT username FROM `registration` WHERE username = '$username'";
   $check_loginid_existence_result = mysqli_query($connection, $check_loginid_existence_query);
   if (mysqli_num_rows($check_loginid_existence_result) > 0) {
       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>Warning!</strong> This username is already been used. Please try a new one!
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
   } else { // Check if the email is already used or not. If yes, display a warning alert and prompt the user to use another one
       $check_email_existence_query = "SELECT email FROM `registration` WHERE email = '$email'";
       $check_email_existence_result = mysqli_query($connection, $check_email_existence_query);
       if (mysqli_num_rows($check_email_existence_result) > 0) {
           echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Warning!</strong> This email is already been used. Please try a new one!
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
       } else {
           if ($password != $confirmpassword) {
               // Display a warning alert if passwords are mismatched
               echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Warning!</strong> Password and Confirm Password do not match!
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
           } else {
               //if the passwords are matched insert the user data into the database and password stored with hash function
               $hashed_password = hashed_password($password);
               $sql = "INSERT INTO `registration` (username, password, nickname, email) VALUES ('$username', '$hashed_password', '$nickname', '$email')";
               $result = mysqli_query($connection, $sql);
               if ($result) {
                   // Display a success alert indicating successful registration
                   echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Welcome!</strong> Registration successful.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
               } else {
                   echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Warning!</strong> Database Connection Fail!
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
                   die(mysqli_error($connection));
               }
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
       <form action="signup.php" method="post">
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
           <div class="text-center">
               <button type="submit" class="btn btn-primary">Submit</button>
           </div>
           <div><a href="login.php">already have an account?</a></div>
       </form>
   </div>
</body>
































</html>

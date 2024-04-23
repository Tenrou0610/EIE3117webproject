<?php
ini_set("session.cookie_httponly", 1);
require_once 'config.php';
session_start();
include "connect.php";
$SESSIONID = $_COOKIE['userid_cookie'];
$userResult = mysqli_query($connection, "SELECT * FROM registration WHERE id = $SESSIONID");
$user = mysqli_fetch_assoc($userResult);
$profileimage = $user['profileimage']; 
//if not login, direct to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_COOKIE['userid_cookie']) || empty($_COOKIE['userid_cookie'])) {
    header("Location: login.php");
    exit(); 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'connect.php';

    if (empty($_POST['title'] && $_POST['description'])) {
        echo "please fill in all the blank!";
        header("Location: createpage.php");
    } else {
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);
        $sql = "INSERT INTO `chatgroup` (title, description, poster_id) VALUES ('$title', '$description','$SESSIONID')";
        $result = mysqli_query($connection, $sql);
        if ($result) {
            // Display a success alert indicating successful create
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>Welcome!</strong> Successfully Created!.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                   <strong>Warning!</strong> Something Wrong!
                   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                   </div>';
            die(mysqli_error($connection));
        }
    }
}
?>



<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-info navbar-dark ">
        <div class="container">
            <a class="navbar-brand fs-2" href="index.php">Pforum</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link fs-2 px-3 active" aria-current="page" href="mychatgroup.php">My ChatGroup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-2 px-3 active" aria-current="page" href="createpage.php">Create ChatGroup</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-2 px-3 active" aria-current="page" href="index.php">List of ChatGroup</a>
                </li>
            </ul>
        </div>

        <div class="d-inline-flex">
            <div><span class="navbar-text fs-2  px-3 text-primary"><?php echo $_COOKIE['nickname_cookie']; ?></span></div>
            <div class="image-container">
        	<img src="<?php echo $profileimage; ?>" class="img-thumbnail img-fluid"/>
            </div>
            <div>
                <form class="fs-2 px-3" action="logout.php" method="POST">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
    </nav>

    <!-- create chatgroup form -->
    <div class="container">
        <h1>Create New ChatRoom!</h1>
        <form action="createpage.php" method="post">
            <div class="mb-3">
                <label for="title" class="form-label fs-3">Title</label>
                <input type="title" class="form-control" id="title" name="title">
                <div id="titletext" class="form-text">Decide the title that you want to discuss</div>
            </div>
            <div class="mb-3">
                <p><label for="description" class="form-label  fs-3">Description</label></p>
                <textarea id="description" name="description" rows="10" cols="138"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>

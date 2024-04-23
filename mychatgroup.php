<?php
ini_set("session.cookie_httponly", 1);
require_once 'config.php';
session_start();
include 'connect.php';
$SESSIONID = $_COOKIE['userid_cookie'];
$userResult = mysqli_query($connection, "SELECT * FROM registration WHERE id = $SESSIONID");
$user = mysqli_fetch_assoc($userResult);
$profileimage = $user['profileimage'];

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
if (!isset($_COOKIE['userid_cookie']) || empty($_COOKIE['userid_cookie'])) {
    header("Location: login.php");
    exit(); 
}

?>





<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My ChatGroup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
            <div>
                <span class="navbar-text fs-2  px-3 text-primary"> Welcome,<?php echo $_COOKIE['nickname_cookie']; ?></span>
            </div>
            <div class="image-container">
        <img src="<?php echo $profileimage; ?>" class="img-thumbnail img-fluid"/>
      	    </div>
            <div>
                <form class="fs-2 px-3" action="logout.php" method="POST">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <?php
    $mychatgroup_query = "SELECT * FROM groupmember WHERE user_id = '$SESSIONID'";
    $mychatgroup_query_result = mysqli_query($connection, $mychatgroup_query);

    $mychatgroups = [];
    $groupnumbercounter = 1; 

    while ($row = mysqli_fetch_assoc($mychatgroup_query_result)) {
        $mychatgroups[] = $row;
    }

    foreach ($mychatgroups as $mychatgroup) {
    ?>
        <div class="mychatgroup">
            <h3>Joined chat group <?php echo $groupnumbercounter++; ?></h3>
            <div class="groupinformation">
                <p>Title: <?php echo $mychatgroup['title']; ?></p>
                <p>Description: <?php echo $mychatgroup['description']; ?></p>
            </div>
        </div>
    <?php
    }
    ?>
</body>

</html>

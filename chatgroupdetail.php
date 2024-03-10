<?php
session_start();
//if not login, direct to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
}
include 'connect.php';
$SESSIONID = $_COOKIE['userid_cookie'];
$userResult = mysqli_query($connection, "SELECT * FROM registration WHERE id = $SESSIONID");
$user = mysqli_fetch_assoc($userResult);
$profileimage = $user['profileimage'];

$group_id = $_GET['group_id'];
$title = $_GET['title'];

if (isset($_SESSION['comment_message'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>Success!</strong> ' . $_SESSION['comment_message'] . '
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
           </div>';
    unset($_SESSION['comment_message']);
}

if (isset($_GET['join'])) {
    setcookie('title_cookie', $_GET['title'], time() + 86400, '/');
    setcookie('group_id_cookie', $_GET['group_id'], time() + 86400, '/');
    $group_id = $_GET['group_id'];
    $title = $_GET['title'];
    $description = $_GET['description'];
    $nickname = $_COOKIE['nickname_cookie'];
    $user_id =  $_COOKIE['userid_cookie'];

    // Check if the user has already joined the group
    $check_query = "SELECT * FROM groupmember WHERE group_id = '$group_id' AND user_id = '$user_id'";
    $check_result = mysqli_query($connection, $check_query);

    if (mysqli_num_rows($check_result) === 0) {
        // Insert the user into the group
        $insert_group_query = "INSERT INTO `groupmember` (group_id, title, description, user_id, nickname) VALUES ('$group_id', '$title', '$description', '$user_id', '$nickname')";
        $group_query_result = mysqli_query($connection, $insert_group_query);

        if ($group_query_result) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Welcome!</strong> Successfully joined the group.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
               <strong>Warning!</strong> Something went wrong.
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
    <title> <?php echo $title; ?></title>
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
                <span class="navbar-text fs-2  px-3 text-primary"> HI!<?php echo $_COOKIE['nickname_cookie']; ?></span>
            </div>
            <div>
                <img src="<?php echo $profileimage; ?>" class="img-thumbnail img-fluid" width="50" height="50" />
            </div>
            <div>
                <form class="fs-2 px-3" action="logout.php" method="POST">
                    <button type="submit" class="btn btn-primary">Logout</button>
                </form>
            </div>

        </div>

    </nav>

    <div class="container mb-3">
        <h4>Joined User in the Chat Group</h4>
        <?php
        $joined_users_query = "SELECT * FROM groupmember WHERE group_id = '$group_id'";
        $joined_users_query_result = mysqli_query($connection, $joined_users_query);

        if (mysqli_num_rows($joined_users_query_result) > 0) {
            while ($joined_user = mysqli_fetch_assoc($joined_users_query_result)) {
                echo $joined_user['nickname'] . '<br />';
            }
        }




        ?>


    </div>


    <div class="container">
        <div class="top-block">
            <h1 class="mb-3">Title: <?php echo $title; ?></h1>
        </div>


        <div id="middle-chatroom-block">
            <?php
            $comment_query = "SELECT * FROM message WHERE group_id = '$group_id'";
            $comment_result = mysqli_query($connection, $comment_query);

            if (mysqli_num_rows($comment_result) > 0) {
                while ($comment = mysqli_fetch_assoc($comment_result)) {
                    echo '<div class="comment">';
                    echo '<p><label>User:</label> ' . $comment['nickname'] . '</p>';
                    echo '<p><label>Posted at:</label> ' . $comment['posted_at'] . '</p>';
                    echo '<p><label>Message:</label> ' . $comment['content'] . '</p>';
                    echo '</div>';
                    echo '<hr>';
                }
            } else {
                echo 'No comments found.';
            }
            ?>
        </div>



        <div id="comment-block">

            <form action="comment.php?group_id=<?php echo $group_id; ?>&session_id=<?php echo $SESSIONID; ?>" method="GET">
                <div class="mb-3">
                    <p><label for="comment" class="form-label fs-3">Comment</label></p>
                    <textarea id="comment" name="content" rows="10" cols="100" placeholder="Type your comment here!"></textarea>
                </div>
                <input type='hidden' name='group_id' value='<?php echo $group_id; ?>'>
                <input type='hidden' name='session_id' value='<?php echo $SESSIONID; ?>'>
                <button type="submit" name="sendchat" class="btn btn-primary">Send Chat</button>
            </form>
        </div>

        <div class="mb-3 "><button type="button" name="refresh" class="btn btn-secondary"><a class="link-dark" href="<?php $_SERVER['PHP_SELF']; ?>">Refresh Chat</a></button></div>

        <div>
            <form action="leavegroup.php" method="GET">
                <div class="mb-3">
                    <input type="hidden" name="group_id" value="<?php echo $group_id; ?>">
                    <input type="hidden" name="session_id" value="<?php echo $SESSIONID; ?>">
                    <button type="submit" name="leavegroup" class="btn btn-primary">Leave Group</button>
                </div>
            </form>
        </div>
    </div>


</body>

</html>
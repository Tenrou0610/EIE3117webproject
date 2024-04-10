<?php
session_start();
include 'connect.php';
//if not login, direct to login page
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
if (!isset($_COOKIE['userid_cookie']) || empty($_COOKIE['userid_cookie'])) {
  header("Location: login.php");
  exit(); 
}
include 'connect.php';
$SESSIONID = $_COOKIE['userid_cookie'];
$userResult = mysqli_query($connection, "SELECT * FROM registration WHERE id = $SESSIONID");
$user = mysqli_fetch_assoc($userResult);
$profileimage = $user['profileimage'];

if (isset($_SESSION['leave_message'])) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success!</strong> ' . $_SESSION['leave_message'] . '
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
  unset($_SESSION['leave_message']);
}

if (isset($_SESSION['comment_message'])) {
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Success!</strong> ' . $_SESSION['comment_message'] . '
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
  unset($_SESSION['comment_message']);
}





?>




<!doctype html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pforum</title>
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


  <!-- all chatgroup showed -->


  <div class="container">
 

    <div class="middle-block mb-3">
      <div class="allchatgroupbox">
        <?php
        $all_chatgroup_query = "SELECT * FROM chatgroup";
        $all_chatgroup_result = mysqli_query($connection, $all_chatgroup_query);

        if (mysqli_num_rows($all_chatgroup_result) > 0) {
          echo '<table>';
          echo '<tr><th>Title</th><th>Description</th><th></th></tr>';

          // Loop through each chat group
          while ($row = mysqli_fetch_assoc($all_chatgroup_result)) {
            $group_id = $row['group_id'];
            $title = $row['title'];
            $description = $row['description'];

            // Display the chat group details in a table row
            echo '<tr>';
            echo "<td>$title</td>";
            echo "<td>$description</td>";
            echo '<td><form action="chatgroupdetail.php" method="GET">';
            echo "<input type='hidden' name='group_id' value='$group_id'>";
            echo "<input type='hidden' name='title' value='$title'>";
            echo "<input type='hidden' name='description' value='$description'>";
            echo '<button type="submit" name="join" class="btn btn-primary btn-lg">JOIN</button>';
            echo '</form></td>';
            echo '</tr>';
          }

          echo '</table>';
        }else{
          echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Warming!</strong> No chatgroup found!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
        }



        ?>



      </div>
    </div>

    <div class="right-block">
    </div>





</body>




</html>
<?php
session_start();
//if not login, direct to login page
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
}

?>




<!doctype html>
<html lang="en">


<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pforum</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!--<link rel="stylesheet" href="style.css">-->
</head>




<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-info navbar-dark ">
    <div class="container">
      <a class="navbar-brand fs-2" href="index.php">Pforum</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link fs-2 px-3 active" aria-current="page" href="#">My ChatGroup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-2 px-3 active" aria-current="page" href="createpage.php">Create ChatGroup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-2 px-3 active" aria-current="page" href="#">List of ChatGroup</a>
        </li>
      </ul>
    </div>



    <div class="d-inline-flex">
      <div><span class="navbar-text fs-2  px-3 text-primary"> Welcome,<?php echo $_COOKIE['nickname_cookie']; ?></span></div>
      <div>
        <form class="fs-2 px-3" action="logout.php" method="POST">
          <button type="submit" class="btn btn-primary">Logout</button>
        </form>
      </div>
      <div>
        <form class="d-flex px-3">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>

  </nav>




  <!-- comment content part -->




</body>




</html>
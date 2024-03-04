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
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg bg-info navbar-dark">
    <div class="container d-flex flex-row">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link fs-2" href="#">Active</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-2" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fs-2" href="#">Link</a>
        </li>
      </ul>
    </div>



    <div class="d-flex">
      <div><span class="navbar-text fs-2"> Welcome,<?php echo $_SESSION['username']; ?></span></div>
      <div><form  class="fs-2" action="logout.php" method="POST">
        <button type="submit" class="btn btn-primary">Logout</button>
      </form></div>
    </div>

  </nav>



  <!-- comment content part -->

</body>

</html>
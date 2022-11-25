<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
         li {
                margin-left: 10px;
            }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
            <img src="logo.png" alt="" width="150px">
          </a>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">             
              <li class="nav-item">
                <a class="btn btn-outline-light" aria-current="page" href="home.php">Home</a>
              </li>
              <?php if($_SESSION['role']=='Director') { ?>
              <li class="nav-item">
                <a class="btn btn-outline-light" href="subjectmanagement.php">Subject management</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-outline-light" href="formationmanagement.php">Formation management</a>
              </li>
              <li class="nav-item">
                <a class="btn btn-outline-light" href="usermanagement.php">User management</a>
              </li>
              <?php } ?>
              <li class="nav-item">
                <a class="btn btn-outline-light" href="userlist.php">User list</a>
              </li>
              <?php if($_SESSION['role']!="Director") { ?>
              <li class="nav-item">
                <a class="btn btn-outline-light" href="formationlist.php">Formation list</a>
              </li>
              <?php } ?>
            </ul>
          </div>
          <a style="margin-right:15px;" class="btn btn-outline-secondary" href="deconnexion.php">Sign Out</a>
        </div>
        </nav>
</body>
</html>

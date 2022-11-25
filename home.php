<?php
    include("connect.php");
    include("connexion.php");
?>

<?php
    $sql="SELECT * FROM formation;";
    $query=$db->prepare($sql);
    $query->execute();
    $result=$query->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
        <style>
            h4 {
                text-align: center;
            }
        </style>
</head>
<body>
      <?php include('menu.php') ?>

<div class="container">
      <div class="card text-dark bg-light mb-3" style="margin-top:10px;">
  
  <h4 class="card-header">HOME</h4>
  
  <div class="card-body">
  <h6 class="card-title">Identity: <?php echo ($_SESSION['email']); ?> </h6>
  <h6 class="card-title">Statu: <?php echo ($_SESSION['role']); ?> </h6>
        <span>Welcome <?php if($_SESSION['gender']=='Male') {echo("Mr.");} else {echo('Ms.');} ?> <?php echo ($_SESSION['first_name']); ?> <?php echo($_SESSION['last_name']); ?>. You are currently connected to E-Learning</span>
        
  </div>
</div>
<div class="card" style="margin-top:10px;">
<h4 class="card-header">Your panel</h4>
      <div class="card-body">   
      <table class="table">

<thead>
<tr>
<th scope="col">N°</th>
  <th scope="col">Formation name</th>
  <th scope="col">Debut date</th>
  <th scope="col">Ending date</th>
</tr>
</thead>

<tbody>
  
<tr>
    <?php if(isset($_SESSION['detail_add'])) { ?>
    <?php if($_SESSION['role']!='Director') { ?>
    <td>1</td>         
    <td> <?php echo($_SESSION['detail_add']) ?> </td>
    <td> <?php echo($_SESSION['debut_add']); ?> </td>
    <td> <?php echo($_SESSION['end_date']); ?> </td>
</tr>

</tbody>
</table>
      </div>
  </div>

    </div>
    <?php }
    } ?>
        </div>
</body>
</html>
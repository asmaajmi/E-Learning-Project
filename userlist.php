<?php
    include("connect.php");
    include("connexion.php");
?>

<?php
    $sql="SELECT * FROM user;";
    $query=$db->prepare($sql);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php include("menu.php"); ?>

    <div class="container" style="margin-top:10px;">

    <div class="card" style="margin-top:10px;">
<h4 class="card-header">Users list</h4>
      <div class="card-body">   
      <table class="table">

<thead>
<tr>
  <th scope="col">First name</th>
  <th scope="col">Last name</th>
  <th scope="col">Degree</th>
  <th scope="col">Gendre</th>
  <th scope="col">Country</th>
  <th scope="col">Role</th>
</tr>
</thead>

<tbody>
  <?php foreach($result as $el) { ?>
<tr>
  <td> <?php echo($el['first_name']); ?> </td>
  <td> <?php echo($el['last_name']);  ?> </td>
  <td> <?php if ($el['degree']!=null) {echo($el['degree']);} else {echo ("_");} ?> </td>
  <td> <?php echo($el['gender']); ?> </td>
  <td> <?php echo($el['country']); ?> </td>
  <td> <?php echo($el['role']); ?> </td>
</tr>
    <?php } ?>
</tbody>
<?php  ?>

</table>
      </div>
  </div>

    </div>
</body>
</html>
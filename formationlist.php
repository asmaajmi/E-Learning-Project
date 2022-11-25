<?php
    include("connect.php");
    include("connexion.php");
?>

<?php
    $sql="SELECT * FROM formation;";
    $query=$db->prepare($sql);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    if(isset($_GET['id_add'])) {
        $sql="SELECT * FROM formation WHERE id=:id;";
        $query=$db->prepare($sql);
        $query->bindValue(':id', $_GET['id_add']);
        $ex=$query->execute();
        $resultat=$query->fetch();
        if($ex){
            $_SESSION['detail_add']=$resultat['detail'];
            $_SESSION['debut_add']=$resultat['date_debut'];
            $_SESSION['end_date']=$resultat['date_fin'];
            echo "<script> alert('Formation added to your panel SUCCESSFULLY');
            window.location.href='formationlist.php';</script>";

        }
        else {
            echo "<script> alert('Error');
            window.location.href='formationlist.php';</script>";
        }
    
    }
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
<h4 class="card-header">Formation list</h4>
      <div class="card-body">   
      <table class="table">

<thead>
<tr>
  <th scope="col">Formation name</th>
  <th scope="col">Debut date</th>
  <th scope="col">Ending date</th>
  <th scope="col">Action</th>
</tr>
</thead>

<tbody>
  <?php foreach($result as $el) { ?>
<tr>
  <td> <?php echo($el['detail']); ?> </td>
  <td> <?php echo($el['date_debut']);  ?> </td>
  <td> <?php echo($el['date_fin']); ?> </td>
    <?php if($_SESSION['role']=='Student') { ?>
  <td> <a class="btn btn-primary" href="formationlist.php?id_add=<?php echo ($el['id']); ?>">Add to list</a> </td>
    <?php } else { ?>
    <td> <a class="btn btn-primary" href="formationlist.php?id_add=<?php echo ($el['id']); ?>">Teach formation</a> </td>
    <?php } ?>
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
<?php
  include("connect.php");
  include("connexion.php");
?>

<?php
  $modify=NULL;
  $sql="SELECT * FROM formation;";
  $query=$db->prepare($sql);
  $ex=$query->execute();
  $result=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
if (isset($_POST['detail']) && empty($_POST['id'])) {
  $sql="SELECT * FROM formation WHERE detail=:detail;";
  $query=$db->prepare($sql);
  $query->bindValue(':detail', $_POST['detail']);
  $query->execute();
  $exist=$query->rowCount();
  if ($exist >= 1) {
    echo "<script> alert('Formation EXIST');
    window.location.href='formationmanagement.php'; </script>";
  }
  else {
    $etat=1;
    $sql="INSERT INTO formation (id, detail, date_debut, date_fin, etat) VALUES (NULL, :detail, :date_debut, :date_fin, :etat);";
    $query=$db->prepare($sql);
    $query->bindValue(':detail', $_POST['detail']);
    $query->bindValue(':date_debut', $_POST['date_debut']);
    $query->bindValue(':date_fin', $_POST['date_fin']);
    $query->bindValue(':etat', $etat);
    $ex=$query->execute();
    if($ex) {
      echo "<script> alert('Formation added SUCCESSFULLY');
      window.location.href='formationmanagement.php'; </script>";
    }
    else {
      echo "<script> alert('Error');
      window.location.href='formationmanagement.php';</script>";
    }
  }
}
?>

<?php
  if (isset($_GET['id_delete'])) {
    $sql="DELETE FROM formation WHERE id=:id;";
    $query=$db->prepare($sql);
    $query->bindValue(':id', $_GET['id_delete']);
    $ex=$query->execute();
    if ($ex) {
      echo "<script> alert('Formation deleted SUCCESSFULLY');
      window.location.href='formationmanagement.php'; </script>";
    }
    else {
      echo "<script> alert('Error');
      window.location.href='formationmanagement.php'; </script>";
    }
  }
?>

<?php
  if (isset($_GET['id_update'])) {
    $sql="SELECT * FROM formation WHERE id=:id;";
    $query=$db->prepare($sql);
    $query->bindValue(':id', $_GET['id_update']);
    $query->execute();
    $modify=$query->fetch();
  }
  
  if (isset($_POST['detail']) && !empty($_POST['id'])) {
    $sql="SELECT * FROM formation WHERE detail=:detail AND date_debut=:date_debut AND date_fin=:date_fin AND id!=:id;";
    $query=$db->prepare($sql);
    $query->bindValue(':id', $_POST['id']);
    $query->bindValue(':detail', $_POST['detail']);
    $query->bindValue(':date_debut', $_POST['date_debut']);
    $query->bindValue(':date_fin', $_POST['date_fin']);
    $query->execute();
    $exist=$query->rowCount();
    //echo($exist);
    if ($exist >= 1 ) {
      echo "<script> alert('Formation EXIST');
      window.location.href='formationmanagement.php'; </script>";
    }
    else {
      $sql="UPDATE formation SET detail=:detail, date_debut=:date_debut, date_fin=:date_fin WHERE id=:id;";
      $query=$db->prepare($sql);
      $query->bindValue(':id', $_POST['id']);
      $query->bindValue(':detail', $_POST['detail']);
      $query->bindValue(':date_debut', $_POST['date_debut']);
      $query->bindValue(':date_fin', $_POST['date_fin']);
      $ex = $query->execute();
      //var_dump($ex);
      
      if ($ex) {
        echo "<script> alert('Formation updated SUCCESSFULLY');
        window.location.href='formationmanagement.php';</script>";
    }
    else {
      echo "<script> alert('Error');
      window.location.href='formationmanagement.php'; </script>";
    }
      }
  }
?>

<?php
  if (isset($_GET['id_restarted'])) {
    $sql="UPDATE formation SET etat=1 WHERE id=:id;";
    $query=$db->prepare($sql);
    $query->bindValue(':id', $_GET['id_restarted']);
    $ex=$query->execute();
    if ($ex) {
        echo "<script> alert('Formation restarted');
        window.location.href='formationmanagement.php';</script>";
    }
    else {
        echo "<script> alert('Error');
        window.location.href='formationmanagement.php';</script>";
    }
}
?>

<?php
  if (isset($_GET['id_ended'])) {
    $sql="UPDATE formation SET etat=0 WHERE id=:id;";
    $query=$db->prepare($sql);
    $query->bindValue(':id', $_GET['id_ended']);
    $ex=$query->execute();
    if ($ex) {
        echo "<script> alert('Formation ended');
        window.location.href='formationmanagement.php';</script>";
    }
    else {
        echo "<script> alert('Error');
        window.location.href='formationmanagement.php';</script>";
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
    <script>
      function verify () {
      let dd=document.getElementById("datedebut");
      let df=document.getElementById("datefin");
        if (dd.value > df.value) {
          alert("Debut date should be inferior than End date");
          return false;
          }
          return true;
      }
    </script>
</head>
<body>
    <?php include("menu.php"); ?>

    <div class="container" style="margin-top:10px;">
  
  <div class="card">
<h4 class="card-header">Add formation</h4>
  <div class="card-body">
      
              <div class="col-sm-4">
                  <form method="POST" action="formationmanagement.php">
                      <input class="form-control" type="hidden" value="<?php if ($modify){ echo $modify['id'];} ?>" name="id" aria-label="default input example">
                      <label for="exampleFormControlInput1" class="form-label">Formation:</label>
                      <input class="form-control" type="text" value="<?php if ($modify) { echo $modify['detail'];} ?>" name="detail" placeholder="Formation" aria-label="default input example">
                      <label for="exampleFormControlInput1" class="form-label">Debut date:</label>
                      <input class="form-control" type="date" value="<?php if ($modify) { echo $modify['date_debut'];} ?>" name="date_debut" placeholder="Formation" aria-label="default input example" id="datedebut">
                      <label for="exampleFormControlInput1" class="form-label">End date:</label>
                      <input class="form-control" type="date" value="<?php if ($modify) { echo $modify['date_fin'];} ?>" name="date_fin" placeholder="Formation" aria-label="default input example" id="datefin">
              
              </div>
     
              <div style="padding-top: 5px;">
                  <button type="submit" onclick="return verify()" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                  </form>
              </div>
  
  </div>
  </div>


  <div class="card" style="margin-top:10px;">
<h4 class="card-header">Formations list</h4>
      <div class="card-body">   
      <table class="table">

<thead>
<tr>
  <th scope="col">ID</th>
  <th scope="col">Formation</th>
  <th scope="col">Debut date</th>
  <th scope="col">End date</th>
  <th scope="col">State</th>
  <th scope="col">Actions</th>
</tr>
</thead>

<tbody>
  <?php foreach ($result as $el) { ?>

<tr>
  <th scope="row"> <?php echo ($el['id']); ?> </th>
  <td> <?php echo ($el['detail']);  ?> </td>
  <td> <?php echo ($el['date_debut']) ?> </td>
  <td> <?php echo ($el['date_fin']) ?> </td>
  <td> 
  <?php if ($el['etat'] == 1 ){echo "Formation started";}
  else {echo "Formation ended";} ?> 
  </td>
  <td>
  <a href="formationmanagement.php?id_delete=<?php echo $el['id']; ?>" class="btn btn-danger" onclick="return confirm('You want to delete ?')" >Delete</a>
  <a href="formationmanagement.php?id_update=<?php echo $el['id']; ?>" class="btn btn-warning">Update</a>
  <?php if ($el['etat'] == 0 ) { ?>
  <a href="formationmanagement.php?id_restarted=<?php echo($el['id']); ?>" class="btn btn-success">Restart formation</a>
  <?php } else { ?>
  <a href="formationmanagement.php?id_ended=<?php echo($el['id']); ?>" class="btn btn-success">End formation</a>
  <?php } ?>
  </td>
</tr>
</tbody>
<?php } ?>

</table>
      </div>
  </div>

</div>

</body>
</html>
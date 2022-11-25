<?php
    include("connect.php");
    include("connexion.php");
?>

<?php
    //Ajouter matiére
    if(isset($_POST['designation']) && empty($_POST['id'])) {
        $sql = "SELECT * FROM matiere WHERE designation:=designation;";
        $query=$db->prepare($sql);
        $query->bindValue(':designation', $_POST['designation']);
        $ex=$query->execute();
        $exist=$query->rowCount();
        if ($exist >= 1){
            echo "<script> alert('Subject EXIST');
            window.location.href='subjectmanagement.php';</script>";
        }
        else {
            $sql="INSERT INTO matiere (id, designation) VALUES (NULL, :designation);";
            $query=$db->prepare($sql);
            $query->bindValue(':designation', $_POST['designation']);
            $ex=$query->execute();
            if ($ex) {
                echo "<script> alert('Subject added SUCCEFULY');
                window.location.href='subjectmanagement.php';</script>";
            }
            else {
                echo "<script> alert('Error');
                window.location.href='subjectmanagement.php';</script>";
            }
        }
    }
?>

<?php
    //affichage tableau
    $modify = NULL;
    $sql="SELECT * FROM matiere;";
    $query=$db->prepare($sql);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    //supprimer
    if (isset($_GET['id_delete'])) {
        $sql="DELETE FROM matiere WHERE id=:id1;";
        $query=$db->prepare($sql);
        $query->bindValue(':id1', $_GET['id_delete']);
        $ex=$query->execute();
        if ($ex) {
            echo "<script> alert('Deleted SUCCESSFULLY');
            window.location.href='subjectmanagement.php';</script>";
        }
        else {
            echo "<script> alert('Error');
            window.location.href='subjectmanagement.php';</script>";
        }
    }
?>

<?php
    //editer designation
    if (isset($_GET['id_update'])) {
        $sql="SELECT * FROM matiere WHERE id=:id1;";
        $query=$db->prepare($sql);
        $query->bindValue(':id1', $_GET['id_update']);
        $ex=$query->execute();
        $modify=$query->fetch();
    }

    if (isset($_POST['designation']) && !empty($_POST['id'])) {
        $sql="SELECT * FROM matier WHERE designation=:designation AND id!=:id1;";
        $query=$db->prepare($sql);
        $query->bindValue(':designation', $_POST['designation']);
        $query->bindValue(':id1', $_POST['id']);
        $ex=$query->execute();
        $exist=$query->rowCount();
        if ($exist >= 1) {
            echo "<script> alert('Subject EXIST');
            window.location.href='subjectmanagement.php';</script>";
        }
        else {
            $sql="UPDATE matiere SET designation=:designation WHERE id=:id1;";
            $query=$db->prepare($sql);
            $query->bindValue(':id1', $_POST['id']);
            $query->bindValue(':designation', $_POST['designation']);
            $ex = $query->execute();
            if ($ex) {
                echo "<script> alert('Subject UPDATED');
                window.location.href='subjectmanagement.php';</script>";
            }
            else {
                echo "<script> alert('Error');
                window.location.href='subjectmanagement.php';</script>";
            }
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
    <style>
            h4 {
                text-align: center;
            }
        </style>
</head>
<body>
    <?php include("menu.php"); ?>
    <div class="container" style="margin-top:10px;">
  
    <div class="card">
  <h4 class="card-header">Add subjects</h4>
    <div class="card-body">
        
                <div class="col-sm-4">
                    <form method="POST" action="subjectmanagement.php">
                        <input class="form-control" type="hidden" value="<?php if ($modify){ echo $modify['id'];} ?>" name="id" aria-label="default input example">
                        <label for="exampleFormControlInput1" class="form-label">Subject:</label>
                        <input class="form-control" type="text" value="<?php if ($modify) { echo $modify['designation'];} ?>" name="designation" placeholder="Subject" aria-label="default input example">
                </div>
       
                <div style="padding-top: 5px;">
                    <button type="submit" class="btn btn-primary">Submit</button>

                    <button type="reset" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
    
    </div>
    </div>


    <div class="card" style="margin-top:10px;">
  <h4 class="card-header">Subjects list</h4>
        <div class="card-body">   
        <table class="table">

<thead>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Subjects</th>
    <th scope="col">Actions</th>
  </tr>
</thead>

<tbody>
    <?php foreach ($result as $el) { ?>

  <tr>
    <th scope="row"> <?php echo $el['id']; ?> </th>
    <td> <?php echo $el['designation']; ?> </td>
    <td>
    <a href="subjectmanagement.php?id_delete=<?php echo $el['id']; ?>" class="btn btn-danger" onclick="return confirm('You want to delete ?')" >Delete</a>
    <a class="btn btn-warning" href="subjectmanagement.php?id_update=<?php echo $el['id']; ?>">Update</a>
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
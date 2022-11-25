<?php
    include("connect.php");
    include("connexion.php");
?>

<?php
    $modify=NULL;
    $sql="SELECT * FROM user;";
    $query=$db->prepare($sql);
    $query->execute();
    $result=$query->fetchAll(PDO::FETCH_ASSOC);
?>

<?php
    if(isset($_GET['id_delete'])) {
        $sql="DELETE FROM user WHERE id=:id;";
        $query=$db->prepare($sql);
        $query->bindValue(':id', $_GET['id_delete']);
        $ex=$query->execute();
        if ($ex) {
            echo "<script> alert('User deleted SUCCESSFULLY');
            window.location.href='usermanagement.php'; </script>";
        }
        else {
            echo "<script> alert('User deleted SUCCESSFULLY');
            window.location.href='usermanagement.php';</script>";
        }
    }
?>

<?php
    if(isset($_GET['id_update'])) {
        $sql="SELECT * FROM user WHERE id=:id;";
        $query=$db->prepare($sql);
        $query->bindValue(':id', $_GET['id_update']);
        $query->execute();
        $modify=$query->fetch();
    }

    if(isset($_POST['email'])) {
        $sql="SELECT * FROM user WHERE first_name=:first_name AND last_name=:last_name AND email=:email AND birthdate=:birthdate AND gender=:gender AND id!=:id;";
        $query=$db->prepare($sql);
        $query->bindValue(':id', $_POST['id']);
        $query->bindValue(':first_name', $_POST['first_name']);
        $query->bindValue(':last_name', $_POST['last_name']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':birthdate', $_POST['birthdate']);
        $query->bindValue(':gender', $_POST['gender']);
        $query->execute();
        $exist=$query->rowCount();
        if($exist >= 1) {
            echo "<script> alert('User EXIST');
            window.location.href='usermanagement.php';</script>";
        }
        else {
            $sql="UPDATE user SET first_name=:first_name, last_name=:last_name, email=:email, birthdate=:birthdate, gender=:gender WHERE id=:id;";
            $query=$db->prepare($sql);
            $query->bindValue(':id', $_POST['id']);
            $query->bindValue(':first_name', $_POST['first_name']);
            $query->bindValue(':last_name', $_POST['last_name']);
            $query->bindValue(':email', $_POST['email']);
            $query->bindValue(':birthdate', $_POST['birthdate']);
            $query->bindValue(':gender', $_POST['gender']);
            $ex=$query->execute();
            if($ex) {
                echo "<script> alert('User updated SUCCESSFULLY');
                window.location.href='usermanagement.php';</script>";
            }
            else {
                echo "<script> alert('Error');
                window.location.href='usermanagement.php';</script>";
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
</head>
<body>

    <?php include("menu.php"); ?>

    <div class="container" style="margin-top:10px;">
  
  <div class="card">
<h4 class="card-header">User informations</h4>
  <div class="card-body">
      
              <div class="col-sm-4">
                  <form method="POST" action="usermanagement.php">
                      <input class="form-control" type="hidden" value="<?php if ($modify){ echo $modify['id'];} ?>" name="id" aria-label="default input example">
                      <label for="exampleFormControlInput1" class="form-label">First name:</label>
                      <input class="form-control" type="text" value="<?php if ($modify) { echo $modify['first_name'];} ?>" name="first_name" placeholder="First name" aria-label="default input example">
                      <label for="exampleFormControlInput1" class="form-label">Last name:</label>
                      <input class="form-control" type="text" value="<?php if ($modify) { echo $modify['last_name'];} ?>" name="last_name" placeholder="Last name" aria-label="default input example" >
                      <label for="exampleFormControlInput1" class="form-label">Email:</label>
                      <input class="form-control" type="text" value="<?php if ($modify) { echo $modify['email'];} ?>" name="email" placeholder="@Email" aria-label="default input example">
                      <label for="exampleFormControlInput1" class="form-label">Birthdate:</label>
                      <input class="form-control" type="date" value="<?php if ($modify) { echo $modify['birthdate'];} ?>" name="birthdate" placeholder="Formation" aria-label="default input example" >
                      <label for="exampleFormControlInput1" class="form-label">Gender:</label>
                      <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Female">
                             <label class="form-check-label" for="inlineRadio1">Female</label>
                         </div>
                         <div class="form-check form-check-inline">
                             <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Male">
                             <label class="form-check-label" for="inlineRadio2">Male</label>
                         </div>
              
              </div>
     
              <div style="padding-top: 5px;">
                  <button type="submit" onclick="return verify()" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Cancel</button>
                  </form>
              </div>
  
  </div>
  </div>


  <div class="card" style="margin-top:10px;">
<h4 class="card-header">Users list</h4>
      <div class="card-body">   
      <table class="table">

<thead>
<tr>
  <th scope="col">ID</th>
  <th scope="col">First name</th>
  <th scope="col">Last name</th>
  <th scope="col">Email</th>
  <th scope="col">Birthdate</th>
  <th scope="col">Gender</th>
  <th scope="col">Actions</th>
</tr>
</thead>

<tbody>
  <?php foreach($result as $el) { ?>

<tr>
  <th scope="row"> <?php echo($el['id']); ?> </th>
  <td> <?php echo($el['first_name']); ?> </td>
  <td> <?php echo($el['last_name']); ?> </td>
  <td> <?php echo($el['email']); ?> </td>
  <td> <?php echo($el['birthdate']); ?> </td>
  <td> <?php echo($el['gender']); ?> </td>
  <td>
  <a href="usermanagement.php?id_delete=<?php echo($el['id']); ?>" class="btn btn-danger" onclick="return confirm('You want to delete ?')" >Delete</a>
  <a href="usermanagement.php?id_update=<?php echo($el['id']); ?>" class="btn btn-warning">Update</a>
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
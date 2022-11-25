<?php
    session_start();
    include("connexion.php");
?>

<?php
    if (isset($_POST['email']) && isset($_POST['password']))
    {
        $sql = "SELECT * FROM user WHERE email=:email AND password=:password;";
        $query = $db->prepare($sql);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':password', $_POST['password']);
        $query->execute();
        $resultat=$query->fetch();
        $exist = $query->rowCount();
            if($exist == 1) {
            $_SESSION['last_name']=$resultat['last_name'];
            $_SESSION['first_name']=$resultat['first_name'];
            $_SESSION['email']=$resultat['email'];
            $_SESSION['role']=$resultat['role'];
            $_SESSION['gender']=$resultat['gender'];
            
            echo"<script> alert('User EXIST');
            window.location.href='home.php';</script>";
            }
            else {
                echo "<script> alert('User does not exist') </script>";
            }

    
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="shortcut icon" type="png" href="favicon.png">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Index.css">

    <title>Index</title>
    
</head>
<body>
    <div class="container">
        <form method="POST" action ="index.php">
        <header>
            <img class="logo" src="LOGO.png" alt="logo">
            <input type="email" name ="email" placeholder="E-mail" class="ep">
            <div class="dec">
                <input type="password" name="password" placeholder="Password" class="ep">
                <br>
                <a href="#" class="forgotPassword">Forgot Password ? </a>
            </div>
            <button type="submit" class="btn btn-primary">Sign In</button>
        </form>    
        </header> 

        <main>
            <article>
                <h2>Modern Education</h2>
                <h1> FOR EVERYONE</h1>
                <hr>
                <button><a href="role.php">CREATE NEW ACCOUNT</a></button>
            </article>
        </main>
    </div>
</body>
</html>
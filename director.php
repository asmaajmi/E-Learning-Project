<?php
include("connexion.php");
?>

<?php
if (isset($_POST['email'])) {
    $sql = "SELECT * FROM user WHERE email=:email;";
    $query=$db->prepare($sql);
    $query->bindValue(':email', $_POST['email']);
    $query->execute();
    $exist=$query->rowCount();
    if($exist>=1){  
        echo"<script> alert('Account EXIST');
        window.location.href='director.php';</script>";
    }

    else {
        $role = "Director";
        $sql1 = "INSERT INTO user (id, first_name, last_name, email, phone, gender, birthdate, role, country, password) VALUES (NULL, :first_name, :last_name, :email, :phone, :gender, :birthdate, :role, :country, :password);";
        $query=$db->prepare($sql1);
        $query->bindValue(':first_name', $_POST['first_name']);
        $query->bindValue(':last_name', $_POST['last_name']);
        $query->bindValue(':email', $_POST['email']);
        $query->bindValue(':phone', $_POST['phone']);
        $query->bindValue(':gender', $_POST['gender']);
        $query->bindValue(':birthdate', $_POST['birthdate']);
        $query->bindValue(':role', $role);
        $query->bindValue(':country', $_POST['country']);
        $query->bindValue(':password', $_POST['password']);
        $ex=$query->execute();
            if($ex)
            {
                echo"<script> alert('Add SUCCESSFULY');
                window.location.href='director.php';</script>";
            }
            else
            {
            echo "<script> alert('Error');
            window.location.href='director.php';</script>";
            }
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
    <link rel="stylesheet" href="../intl-tel-input-master/build/css/intlTelInput.css">
    <link rel="stylesheet" href="../intl-tel-input-master/build/css/demo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
 
    <title> Register as Director</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="registration.css" rel="stylesheet" >
</head>

<body>
     <div class="card">
        <div class="avatar">
            <img src="avatardir.PNG">
        </div>
        <div class="card-body">
            <div class="card-header">
                registration form for Director
              </div>
            <form method="POST" action="director.php">
                <div class="form-row">
                  <div class="col">
                    <span> First name :</span><input type="text" class="form-control" name ="first_name" placeholder="First name">
                  </div>
                  <div class="col">
                    <span>Last name :</span><input type="text" class="form-control" name ="last_name" placeholder="Last name">
                  </div>
                </div>
                <div class="form-row">
                    <div class="col">
                      <span>Email:</span><input type="text" class="form-control" name="email" placeholder="Email">
                    </div>
                    <div class="col">
                      <span>Phone:</span><input type="tel" class="form-control" name="phone" placeholder="Phone" id="phone" name="phone">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                      <span>Date of Birth:</span><input type="date" class="form-control" name="birthdate" placeholder="Date of Birth">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                      <span>Password:</span><input type="password" class="form-control" name="password" placeholder="password">
                    </div>
                    <div class="col">
                      <span>Confirm password:</span><input type="password" class="form-control" placeholder="confirm password">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col">
                        <span>Gender:</span>
                        <br>
                         <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Female">
                             <label class="form-check-label" for="inlineRadio1">Female</label>
                         </div>
                         <div class="form-check form-check-inline">
                             <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Male">
                             <label class="form-check-label" for="inlineRadio2">Male</label>
                         </div>
                    </div>
                    <div class="col">
                        <span>country:</span>
                        <br>
                        <select name="country" class="form-select">
                              <option data-countryCode="DZ" value="Algeria">Algeria</option>  
                              <option data-countryCode="AR" value="Argentina">Argentina</option> 
                              <option data-countryCode="AU" value="Australia">Australia</option>
                              <option data-countryCode="AT" value="Austria">Austria</option>
                              <option data-countryCode="BH" value="Bahrain">Bahrain</option>
                              <option data-countryCode="BE" value="Belgium">Belgium</option>
                              <option data-countryCode="BR" value="Brazil">Brazil</option>
                              <option data-countryCode="CA" value="Canada">Canada</option>
                              <option data-countryCode="CN" value="China">China</option>
                              <option data-countryCode="DK" value="Denmark">Denmark</option>
                              <option data-countryCode="EG" value="Egypte">Egypt</option>
                              <option data-countryCode="FR" value="France">France</option>
                              <option data-countryCode="DE" value="Germany">Germany</option>
                              <option data-countryCode="IN" value="India">India</option>
                              <option data-countryCode="IQ" value="Iraq">Iraq</option>
                              <option data-countryCode="IT" value="Italy">Italy</option>
                              <option data-countryCode="JP" value="Japan">Japan</option>
                              <option data-countryCode="JO" value="Jordan">Jordan</option>
                              <option data-countryCode="KR" value="Korea South">Korea South</option>
                              <option data-countryCode="KW" value="Kuwait">Kuwait</option>
                              <option data-countryCode="LY" value="Libya">Libya</option>
                              <option data-countryCode="MX" value="Mexico">Mexico</option>
                              <option data-countryCode="MA" value="Morroco">Morocco</option>
                              <option data-countryCode="NL" value="Netherlands">Netherlands</option>
                              <option data-countryCode="NZ" value="New Zealand">New Zealand</option>
                              <option data-countryCode="NO" value="Norway">Norway</option>
                              <option data-countryCode="OM" value="Oman">Oman</option>
                              <option data-countryCode="PT" value="Portugal">Portugal</option>
                              <option data-countryCode="QA" value="Qatar">Qatar</option>
                              <option data-countryCode="RU" value="Russia">Russia</option>
                              <option data-countryCode="SA" value="Saudi Arabia">Saudi Arabia</option>
                              <option data-countryCode="ES" value="Spain">Spain</option>
                              <option data-countryCode="SE" value="Sweden">Sweden</option>
                              <option data-countryCode="SI" value="Syria">Syria</option>
                              <option data-countryCode="TN" value="Tunisia">Tunisia</option>
                              <option data-countryCode="TR" value="Turkey">Turkey</option>
                              <option data-countryCode="GB" value="United Kingdom">United Kingdom</option> 
                              <option data-countryCode="AE" value="United Arab Emirates">United Arab Emirates</option>
                              <option data-countryCode="US" value="United State">United State (+1)</option>
                              <option data-countryCode="YE" value="Yemen">Yemen</option>
                            </optgroup>
                      </select>
                    </div>
              </form>
              <br>
              <button type="submit" class="btn btn-primary" href="home.php">Register</button>
        </div>
    </div>

</body>

</html>

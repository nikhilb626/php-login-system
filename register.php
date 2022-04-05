<?php

$showAlert=false;
$showError=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/dbcon.php';

    $email=$_POST["email"];
    $phone=$_POST["phone"];
    $password=$_POST["password"];
    $confirmpassword=$_POST["confirmpassword"];


    $existSql="SELECT * FROM `userdata` WHERE email='$email'";
    $result=mysqli_query($conn,$existSql);
    $numExistRows=mysqli_num_rows($result);

    if($numExistRows>0){
      $showError=" email already exists";

    }
    else{
    if($password===$confirmpassword){

      $hash=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO `userdata` (`email`,`phone`,`password`) VALUES ('$email','$phone','$hash')";
        $result=mysqli_query($conn,$sql);

        if($result){
            $showAlert=true;
        }

    }else{
        $showError="password does not match";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
require 'partials/navbar.php';
?>

<?php

if($showAlert){
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> Your account is created, now you can log in
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
if($showError){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Register Fail</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



?>




<form id="myform" action="/log/register.php" method="POST">
  
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="text" class="form-control" maxlength="20" name="email"  id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3 ">
    <label for="exampleInputEmail1" class="form-label">Phone no.</label>
    <input type="text" name="phone" class="form-control" id="exampleInputPhone1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your Phone no. with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" name="password" class="form-label">Password</label>
    <input type="password" class="form-control" name="password" id="exampleInputPassword1">
  </div>
  
  <div class="mb-3">
    <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name="confirmpassword" id="exampleInputPassword2">
  </div>
  
 
  <button type="submit" class="btn btn-primary">REGISTER</button>
</form>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
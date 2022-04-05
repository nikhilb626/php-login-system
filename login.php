<?php 

$login=false;
$showError=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include 'partials/dbcon.php';

    $email=$_POST["email"];
    $password=$_POST["password"];



    // $sql="Select * from userdata where email='$email' AND password='$password'";
    $sql="Select * from userdata where email='$email'";

    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result);

    if($num==1){

      while($row=mysqli_fetch_assoc($result)){
        if(password_verify($password,$row['password'])){
          $login=true;
          session_start();
          $_SESSION['loggedin']=true;
          $_SESSION['email']=$email;
          header("location:welcome.php");

        }else{
          $showError="Invalid Credentials";
        }

      }
       
    }
    elseif($num==0){
        $showError="Invalid Credentials";
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

if($showError){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Register Fail</strong>'.$showError.'
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

?>


<form id="myform" action="/log/login.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputEmail" class="form-label">Email address</label>
    <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>

  <div class="mb-3">
    <label for="exampleInputPassword" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
  </div>
  


 
  <button type="submit" class="btn btn-primary">LOGIN</button>
</form>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> 
</body>
</html>
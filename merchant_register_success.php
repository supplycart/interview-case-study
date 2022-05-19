
<?php

require 'connection.php';
$conn = Connect();

$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$icnum = $conn->real_escape_string($_POST['icnum']);
$phone = $conn->real_escape_string($_POST['phone']);
$username = $conn->real_escape_string($_POST['username']);
$password = $conn->real_escape_string($_POST['password']);

$query = "INSERT into requests(name,email,icnum,phone,username,password,status) VALUES('" . $name . "','" . $email . "','" . $icnum . "','" . $phone . "','" . $username ."','" . $password ."', 'pending')";
$success = $conn->query($query);

if (!$success){
  die("Couldnt enter data: ".$conn->error);
}

$conn->close();

?>




<html>

  <head>
    <title> SUCCESS | HomeFood</title>
  </head>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

  <body>

<style> 
h1 {
  text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000;  
}
 p {
 color: white;
text-shadow: 0.0px 10.0px 0.02px #000, 9.8px 2.1px 0.02px #000, 4.2px -9.1px 0.02px #000, -8.0px -6.0px 0.02px #000, -7.6px 6.5px 0.02px #000, 4.8px 8.8px 0.02px #000, 9.6px -2.8px 0.02px #000, -0.7px -10.0px 0.02px #000, -9.9px -1.5px 0.02px #000, -3.5px 9.4px 0.02px #000, 8.4px 5.4px 0.02px #000, 7.1px -7.0px 0.02px #000, -5.4px -8.4px 0.02px #000, -9.4px 3.5px 0.02px #000, 1.4px 9.9px 0.02px #000, 10.0px 0.8px 0.02px #000, 2.9px -9.6px 0.02px #000, -8.7px -4.8px 0.02px #000, -6.6px 7.5px 0.02px #000, 5.9px 8.0px 0.02px #000, 9.1px -4.1px 0.02px #000, -2.1px -9.8px 0.02px #000, -10.0px -0.1px 0.02px #000, -2.2px 9.8px 0.02px #000, 9.1px 4.2px 0.02px #000, 6.1px -8.0px 0.02px #000, -6.5px -7.6px 0.02px #000, -8.8px 4.7px 0.02px #000, 2.7px 9.6px 0.02px #000, 10.0px -0.6px 0.02px #000, 1.5px -9.9px 0.02px #000, -9.3px -3.6px 0.02px #000, -5.5px 8.4px 0.02px #000, 7.0px 7.2px 0.02px #000, 8.5px -5.3px 0.02px #000, -3.4px -9.4px 0.02px #000, -9.9px 1.3px 0.02px #000, -0.8px 10.0px 0.02px #000, 9.6px 2.9px 0.02px #000, 4.9px -8.7px 0.02px #000, -7.5px -6.7px 0.02px #000, -8.1px 5.9px 0.02px #000, 4.0px 9.2px 0.02px #000, 9.8px -2.0px 0.02px #000, 0.2px -10.0px 0.02px #000, -9.7px -2.3px 0.02px #000, -4.3px 9.0px 0.02px #000, 7.9px 6.1px 0.02px #000
}
</style>

<section class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="height:100vh; background-size: cover; background-image: url(IMAGES/2.jpg);">
  
   <div class="container-fluid">
      <div class="row  justify-content-center align-items-center d-flex text-center h-100">
        <div class="col-12 col-md-8  h-50 ">
            <h1 class="display-2  text-light mb-2 mt-5"><strong>CONGRATS!</strong> </h1>
            <p class="lead  text-light mb-5"> <?php echo "Congrats $name! Your registration form is successfully submitted to admin." ?> </p> 
<a href="merchantsignup.php" class="btn bg-danger shadow-lg btn-round text-light btn-lg btn-rised">Login Here</a>
          
          
        </div>
     
      </div>
    </div>
    </section>
    







<div class="container">
  <div class="jumbotron" style="text-align: center;">
    <h2> <?php echo "Welcome $fullname!" ?> </h2>
    <h1>Your account has been created.</h1>
    <p>Login Now from <a href="managerlogin.php">HERE</a></p>
  </div>
</div>

    </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> Food Exploria 2017 | &copy All Rights Reserved </p>
  <br>
  </footer>
</html>
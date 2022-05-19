<?php

include('merchantsession.php');

if(!isset($login_session)){
header('Location: merchantsignup.php'); // Redirecting To Home Page
}



$name = $conn->real_escape_string($_POST['name']);
$email = $conn->real_escape_string($_POST['email']);
$contact = $conn->real_escape_string($_POST['contact']);
$address = $conn->real_escape_string($_POST['address']);


$query = "INSERT INTO RESTAURANTS(name,email,contact,address,M_ID) VALUES('" . $name . "','" . $email . "','" . $contact . "','" . $address ."','" . $_SESSION['login_user1'] ."')";
$success = $conn->query($query);

if (!$success){
?>

	<!DOCTYPE html>
	<html>
	<head>
    <body>
		<title>oOPS!</title>



      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>




<style>

body {
    background: #eee
}


body {
  background: linear-gradient(70deg, #e6e6e6, #f7f7f7);
  color: #514B64;
  min-height: 100vh;
}

code {
  background: #fff;
  padding: 0.2rem;
  border-radius: 0.2rem;
  margin: 0 0.3rem;
}

body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-image: url("IMAGES/14.jpg");
    background-repeat: repeat;
    background-size: 100% 100%
}

</style>




<nav class="navbar navbar-expand-lg py-3 navbar-dark bg-dark shadow-sm">
  <div class="container">
    <a href="#" class="navbar-brand">
      <!-- Logo Image -->
      <img src="IMAGES/13.png" width="400" alt="" class="d-inline-block align-botton mr-2">
      <!-- Logo Text -->
    </a>

    <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler"><span class="navbar-toggler-icon"></span></button>

    <div id="navbarSupportedContent" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item "><a href="merchanthome.php" class="nav-link">Home <span class="sr-only">(current)</span></a></li>




      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Listing
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
          <a class="dropdown-item" href="merchant_add_food_items.php">Add Listing</a>          
          <a class="dropdown-item" href="merchant_edit_food_items.php">Edit Listing</a>          
          <a class="dropdown-item" href="merchant_delete_food_items.php">Delete Listing</a>
        </div>


        <li class="nav-item"><a href="merchant_view_order.php" class="nav-link">View Order</a></li>
        <li class="nav-item"><a href="merchantsetlogout.php" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<br> </br>



    <div class="container">
	<div class="jumbotron" style="text-align: center;">
		<h1>Your already have your business registered.</h1>
		<p>Click here to view your <a href="merchant_view_food_items.php">page.</a></p>
	</div>
</div>
	




	</body>
	</html>

	<?php
}
else {
	header('Location: merchant_add_food_items.php');
}

$conn->close();


?>
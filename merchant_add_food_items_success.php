<?php

include('merchantsession.php');

if(!isset($login_session)){
header('Location: merchantsignup.php'); // Redirecting To Home Page
}




$name = $conn->real_escape_string($_POST['name']);
$price = $conn->real_escape_string($_POST['price']);
$description = $conn->real_escape_string($_POST['description']);
$category = $conn->real_escape_string($_POST['category']);

// Storing Session
$user_check=$_SESSION['login_user1'];
$R_IDsql = "SELECT RESTAURANTS.R_ID FROM RESTAURANTS, MANAGER WHERE RESTAURANTS.M_ID='$user_check'";
$R_IDresult = mysqli_query($conn,$R_IDsql);
$R_IDrs = mysqli_fetch_array($R_IDresult, MYSQLI_BOTH);
$R_ID = $R_IDrs['R_ID'];

$images_path = $conn->real_escape_string($_POST['images_path']);

$query = "INSERT INTO FOOD(name,price,description,R_ID,images_path, category,availability) VALUES('" . $name . "','" . $price . "','" . $description . "','" . $R_ID ."','" . $images_path . "','" . $category . "', 'available')";
$success = $conn->query($query);

if (!$success){

	?>

	<!DOCTYPE html>
	<html>
	<head>
		<title>oops! 
    </title>



      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  </head>



  <body>
     
  <style>

body {
    background: #eee
}



h1 {
    text-align: center
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


    <div id="navbarSupportedContent" class="collapse navbar-collapse">
      <ul class="navbar-nav ml-auto">

        <li class="nav-item"><a href="#" class="nav-link">Welcome <?php echo
        $login_session; ?> <span style="padding-left:12px">| <span
        style="padding-left:3px"></a></li> <li class="nav-item "><a
        href="merchanthome.php" class="nav-link">Home</span></a></li> 






      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Listing
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
          <a class="dropdown-item" href="merchant_add_food_items.php">Add Listing</a>          
          <a class="dropdown-item" href="merchant_edit_food_items.php">Edit Listing</a>          
          <a class="dropdown-item" href="merchant_delete_food_items.php">Delete Listing</a>
        </div>
      
     <li class="nav-item"><a href="merchant_view_order.php"   class="nav-link">View Order</a></li> 
        <li class="nav-item"><a
        href="merchantsetlogout.php" class="nav-link">Logout</a></li>

      </ul>
    </div>
  </div>
</nav>

<br> </br>



    <div class="container">
  <div class="jumbotron" style="text-align: center;">
    <h1>Please register your business details before listing food.</h1>
    <p>   <a href="merchantaddrestaurant.php">Click here.</a></p>
  </div>
</div>


	</body>
	  




	</html>





	<?php
	
}
else {
	echo "SUCCESS";
	header('Location: merchant_view_food_items.php');
}

$conn->close();


?>

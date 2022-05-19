<?php

include('merchantsession.php');

if(!isset($login_session)){
header('Location: merchantsignup.php'); // Redirecting To Home Page
}


?>

<html>
<title>ORDER LIST | HomeFood</title>

<body>


      <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>








  <script type="text/javascript">
    function display_alert()
    {
      alert("Data Updated Successfully...!!!");
    }
  </script>

  
  <body>
     
  <style>

body {
    background: #eee
}



h1 {
    text-align: center
}

#abc {
  background-color: lightgrey;
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
        <a class="nav-link dropdown-toggle " href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Manage Listing
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDarkDropdownMenuLink">
          <a class="dropdown-item" href="merchant_add_food_items.php">Add Listing</a>          
          <a class="dropdown-item" href="merchant_edit_food_items.php">Edit Listing</a>          
          <a class="dropdown-item" href="merchant_delete_food_items.php">Delete Listing</a>
        </div>
      
     <li class="nav-item active"><a href="merchant_view_order.php"   class="nav-link">View Order</a></li> 
        <li class="nav-item"><a
        href="merchantsetlogout.php" class="nav-link">Logout</a></li>

      </ul>
    </div>
  </div>
</nav>

<br>




<?php
   
    define('DBINFO','mysql:host=localhost;dbname=homefood');
    define('DBUSER','root');
    define('DBPASS','');

    function performQuery($query){
        $con = new PDO(DBINFO,DBUSER,DBPASS);
        $stmt = $con->prepare($query);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }
    }

    function fetchAll($query){
        $con = new PDO(DBINFO, DBUSER, DBPASS);
        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }

?>

 <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> YOUR FOOD ORDER LIST </h3>

  <section id = abc>
            <?php



$user_check=$_SESSION['login_user1'];
$query = "SELECT * FROM orders o WHERE o.R_ID IN (SELECT r.R_ID FROM RESTAURANTS r WHERE r.M_ID='$user_check') and status = 'not delivered' ORDER BY order_date";

            
                if(count(fetchAll($query))>0){
                    foreach(fetchAll($query) as $row){
                        ?>
                


<center>


<br>


                      <h3><?php echo $row["order_date"]; ?> </h3>

                    <h2 class="lead text">TOTAL RM<?php echo $row["price"]; ?></h2>

                      <h1 class="lead text">Order ID = <?php echo $row["order_ID"]; ?> | Foodname =  <?php echo $row["foodname"]; ?> | Quantity = <?php echo $row["quantity"]; ?></h1>

                      <p>




                        <a href="accept.php?order_ID=<?php echo $row['order_ID'] ?>" class="btn btn-success my-2">Deliver</a>
                        <a href="cancelled.php?order_ID=<?php echo $row['order_ID'] ?>" class="btn btn-danger my-2">Cancel</a>
                      </p>

                      ---------------------------------------------------------------------
                      <br> </br> 


                 



  <?php } }else { ?>
<br>
  <h2><center>No pending Orders</center> </h2>

  <?php } ?>
  <br>
          </center>
        </div>
          
      </section>


  </body>

 
</html>
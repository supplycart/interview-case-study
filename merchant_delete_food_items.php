<?php

include('merchantsession.php');

if(!isset($login_session)){
header('Location: merchantsignup.php'); // Redirecting To Home Page
}


?>



<html>
<title>DELETE LISTING | HomeFood</title>

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


    
    <div class="col-xs-9">
      <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="merchant_delete_food_item_success.php" method="POST">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> DELETE YOUR FOOD ITEMS FROM HERE </h3>


<?php



// Storing Session
$user_check=$_SESSION['login_user1'];
$sql = "SELECT * FROM food f WHERE f.R_ID IN (SELECT r.R_ID FROM RESTAURANTS r WHERE r.M_ID='$user_check') ORDER BY F_ID";
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) > 0)
{

  ?>

  <table class="table table-striped">
    <thead class="thead-dark">
      <tr>
        <th> # </th>
        <th> Food ID </th>
        <th> Food Name </th>
        <th> Category </th>
        <th> Price </th>
        <th> Description </th>
        <th> Restaurant ID </th>

      </tr>
    </thead>

    <?PHP
      //OUTPUT DATA OF EACH ROW
      while($row = mysqli_fetch_assoc($result)){
    ?>

  <tbody>
    <tr>
      <td> <input name="checkbox[]" type="checkbox" value="<?php echo $row['F_ID']; ?>"/> </td>
      <td><?php echo $row["F_ID"]; ?></td>
      <td><?php echo $row["name"]; ?></td>
      <td><?php echo $row["category"]; ?></td>      
      <td><?php echo $row["price"]; ?></td>
      <td><?php echo $row["description"]; ?></td>
      <td><?php echo $row["R_ID"]; ?></td>
    </tr>
  </tbody>
  
  <?php } ?>
  </table>
    <br>
          <div class="form-group">
          <button type="submit" id="submit" name="delete" value="Delete" class="btn btn-danger pull-right"> DELETE</button>    
      </div>

  <?php } else { ?>

  <h4><center>0 RESULTS</center> </h4>

  <?php } ?>

        </form>

        
        </div>
      
    </div>
</div>

  </body>


</html>
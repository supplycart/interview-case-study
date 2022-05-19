<?php

include('adminsession.php');

if(!isset($_SESSION['login_user3'])){
header('Location: adminlogin.php'); // Redirecting To Home Page
}

?>
<html>
<title> Admin Homepage | HomeFood</title>

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
        style="padding-left:3px"></a></li>


        <li class="nav-item"><a
        href="logout.php" class="nav-link">Logout</a></li>

      </ul>
    </div>
  </div>
</nav>

<br>
 <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> Seller Registration Request </h3>
<?php
$sesh = mysqli_query($conn, "SELECT * FROM requests");
$sesh2 = mysqli_query($conn, "SELECT * FROM requests");
$row = mysqli_fetch_array($sesh);
if(is_null($row)){
    echo "<h3 style='margin-bottom: 25px; text-align: center; font-size: 30px;'> No request </h3>";
}
else{
?>
  <table class="table" width='80%' border=2 align=center>
    <tr bgcolor="#CCCCCC">
      <td>Username</td>
      <td>Password</td>
      <td>Full Name</td>
      <td>Email</td>
      <td>IC Number</td>
      <td>Phone</td>
      <td>Status</td>
      <td>Action</td>
    </tr>
    <?php
    while($res = mysqli_fetch_array($sesh2)){
      echo "<tr>";
      echo "<td>".$res['username']."</td>";
      echo "<td>".$res['password']."</td>";
      echo "<td>".$res['name']."</td>";
      echo "<td>".$res['email']."</td>";
      echo "<td>".$res['icnum']."</td>";
      echo "<td>".$res['phone']."</td>";
      echo "<td>".$res['status']."</td>";
      echo "<td>";
      $accep = $res['username'];
echo "<button class='editbtn' onClick=\"return confirm('Are you sure you want to accept?')\">
<a href=\"acceptrequest.php?accep=$accep\">Accept</a></button>";
      $delid = $res['username'];
echo "<button class='editbtn' onClick=\"return confirm('Are you sure you want to delete?')\">
<a href=\"rejectrequest.php?delid=$delid\">Reject</a></button>";
echo "</td>";

echo "</tr>";
    }
}
    ?>
  </table>


  </body>

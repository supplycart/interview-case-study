<?php
session_start();


?>


<html>

  <head>
    <title> HomeFood | Food Delight </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body>

  <!--Back to top button..................................................................................-->
    <button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
  <!--Javacript for back to top button....................................................................-->
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="active navbar-brand" href="index.php"><img width="19%" src="images/13.png"></a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
<?php
if(isset($_SESSION['login_user2'])){

?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>

<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="login.php"> User Login</a></li>
              <li> <a href="merchantsignup.php"> Manager Login</a></li>
              <li> <a href="adminlogin.php"> Admin Login</a></li>
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>

    <!-- Carousal ================================================================ -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
      <img src="images/slide001.jpg" style="width:100%;">
      <div class="carousel-caption">
      </div>
      </div>

      <div class="item">
      <img src="images/slide002.jpg" style="width:100%;">
      <div class="carousel-caption">

      </div>
      </div>
      <div class="item">
      <img src="images/slide003.jpg" style="width:100%;">
      <div class="carousel-caption">
      
      </div>
      </div>
    
    </div>
    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
    </div>
<!-- Carousal End -->

<div class="jumbotron">
  <div class="container text-center">
    <h1><img width="50%" src="IMAGES/12.png"></h1>      
    <p>Freshly cooked goodness from the comfort of home</p>
  </div>
</div>



<?php

require 'connection.php';
$conn = Connect();
$sql2 = "SELECT DISTINCT f.availability,r.R_ID,r.name,f.F_ID,f.images_path FROM RESTAURANTS r JOIN FOOD f on f.R_ID = r.R_ID WHERE f.F_ID in (select min(F_ID) from FOOD group by R_ID) AND f.availability='available' ORDER BY R_ID";
$result2 = mysqli_query($conn, $sql2);
$count=1;
if (mysqli_num_rows($result2) > 0)
{

  while($row2 = mysqli_fetch_assoc($result2)){


?>
<div class="col-md-4">
<div class="mypanel" align="center";>
<input id="myImg<?php echo $count; ?>" type="image" src="<?php echo $row2["images_path"]; ?>" name="submit" style="width:100%;max-width:300px" alt="submit"/>  
<h5 class="text-info"><?php echo $row2["name"]; ?></h5>
</div>
</div>
<!-- The Modal -->
<div id="myModal<?php echo $count; ?>" class="modal<?php echo $count; ?>">

  <!-- Modal content -->
  <div class="modal-content<?php echo $count; ?>">
    <span class="close<?php echo $count; ?>">&times;</span>
    <div class="container" style="width:95%;">

<!-- Display all Food from food table -->
<?php

$rid=$row2["R_ID"];
$sql = "SELECT * FROM FOOD WHERE R_ID = '$rid' AND availability='available' ORDER BY F_ID";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{

  while($row = mysqli_fetch_assoc($result)){

?>
<div class="col-md-4">
<?php
if(isset($_SESSION['login_user2'])){

?>
<form method="post" action="cart.php?action=add&id=<?php echo $row["F_ID"]; ?>">

<?php
}
else{
?>

<form method="post" action="login.php">

<?php
}
?>

<div class="mypanel" align="center";>
<img src="<?php echo $row["images_path"]; ?>" class="img-responsive">
<h5 class="text-info"><?php echo $row["name"]; ?></h5>
<h5 class="text-info"><?php echo $row["description"]; ?></h5>
<h5 class="text-danger">RM <?php echo $row["price"]; ?>/-</h5>
<h5 class="text-info">Quantity: <input type="number" min="1" max="25" name="quantity" class="form-control" value="1" style="width: 60px;"> </h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["price"]; ?>">
<input type="hidden" name="hidden_RID" value="<?php echo $row["R_ID"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
}
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No food is available.</h1> </label>
        <p>Stay Hungry...! :P</p>
      </center>
       
    </div>
  </div>

  <?php

}

?>
  </div>
</div>
</div>
<?php
$count+=1;
}
}
?>

<style type="text/css">
<?php

$sqlstyle = "SELECT * FROM FOOD ORDER BY F_ID";
$resultstyle = mysqli_query($conn, $sqlstyle);
$countstyle =1;
if (mysqli_num_rows($resultstyle) > 0)
{

  while($rowstyle = mysqli_fetch_assoc($resultstyle)){

?>

.modal<?php echo $countstyle; ?> {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content<?php echo $countstyle; ?> {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close<?php echo $countstyle; ?> {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close<?php echo $countstyle; ?>:hover,
.close<?php echo $countstyle; ?>:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
<?php
$countstyle+=1;
}
}
?>
</style>
   <script type="text/javascript">
  // Get the modal


// Get the button that opens the modal
<?php

$sqlbtn = "SELECT * FROM FOOD ORDER BY F_ID";
$resultbtn = mysqli_query($conn, $sqlbtn);
$countbtn =1;
if (mysqli_num_rows($resultbtn) > 0)
{

  while($rowbtn = mysqli_fetch_assoc($resultbtn)){

?>
var btn<?php echo $countbtn; ?> = document.getElementById("myImg<?php echo $countbtn; ?>");
var modal<?php echo $countbtn; ?> = document.getElementById("myModal<?php echo $countbtn; ?>");

// Get the <span> element that closes the modal
var span<?php echo $countbtn; ?> = document.getElementsByClassName("close<?php echo $countbtn; ?>")[0];

// When the user clicks on the button, open the modal
btn<?php echo $countbtn; ?>.onclick = function() {
  modal<?php echo $countbtn; ?>.style.display = "block";
}


// When the user clicks on <span> (x), close the modal
span<?php echo $countbtn; ?>.onclick = function() {
  modal<?php echo $countbtn; ?>.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal<?php echo $countbtn; ?>.style.display = "none";
  }
}

<?php
$countbtn+=1;
}
}
?>
</script>

</body>

</html>
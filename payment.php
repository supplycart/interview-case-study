<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: login.php"); //Redirecting to myrestaurant Page
}
$gtotal = $_SESSION['gtotal'];
$_SESSION['ordertime'] = $_POST['ordertime'];
?>

<html>

  <head>
    <title> Payment | HomeFood </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/payment.css">
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
  ?>


        </div>

      </div>
    </nav>

        <div class="container">
          <div class="jumbotron">
            <h1>Place Order?</h1>
          </div>
        </div>
        <br>
<h1 class="text-center">Grand Total: RM<?php echo "$gtotal"; ?>/-</h1>
<h5 class="text-center">including all service charges. (no delivery charges applied)</h5>
<br>
<h1 class="text-center">
  <a href="cart.php"><button class="btn btn-warning"><span class="glyphicon glyphicon-circle-arrow-left"></span> Go back to cart</button></a>
  <a href="addorder.php"><button class="btn btn-success"><span class="glyphicon glyphicon-"></span> Place Order</button></a>
</h1>
        


<br><br><br><br><br><br>
        </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HomeFood 2021  | &copy All Rights Reserved </p>
  <br>
  </footer>
</html>
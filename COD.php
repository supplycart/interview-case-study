<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: login.php"); //Redirecting to myrestaurant Page
}
if(!isset($_SESSION['count'])){
header("location: cart.php"); //Redirecting to myrestaurant Page
}

$countorder = $_SESSION['count'];
$username=$_SESSION['login_user2'];

$maxquery = mysqli_query($conn, "SELECT MAX(order_ID) AS max from orders");
$rowquery = mysqli_fetch_array($maxquery);
$max = $rowquery['max'];

$maxminuscount = $max - $countorder +1 ;


$order = mysqli_query($conn, "SELECT * FROM orders
      WHERE username = '$username' AND order_ID BETWEEN $maxminuscount AND $max");


unset($_SESSION["cart"]);
unset($_SESSION["gtotal"]);
unset($_SESSION["ordertime"]);
?>

<html>

  <head>
    <title> Checkout | HomeFood </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/COD.css">
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
              <li> <a href="#"> Admin Login</a></li>
            </ul>
            </li>
          </ul>

<?php
}
?>


        </div>

      </div>
    </nav>




        <div class="container">
          <div class="jumbotron">
            <h1 class="text-center" style="color: green;"><span class="glyphicon glyphicon-ok-circle"></span> Order Placed Successfully.</h1>
          </div>
        </div>
        <br>

<h2 class="text-center"> Thank you for shopping at HomeFood! The ordering process is now complete.</h2>


<h3 class="text-center"> <strong>Your Order Number:</strong></h3>


 <div class="container" >
  <h5 class="text-center">Please read the following information about your order.</h5>
  <div class="box">
    <div class="col-md-10" style="float: none; margin: 0 auto; text-align: center;">
      <table class="table"  border=0>
    <tr>
      <td>Order ID</td>
      <td>Food Name</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Total Price</td>
      <td>Restaurant Name</td>
      <td>Order Time/Date</td>
    </tr>
    <?php
    while($row2= mysqli_fetch_array($order)){
      echo "<tr>";
      echo "<td>".$row2['order_ID']."</td>";
      echo "<td>".$row2['foodname']."</td>";
      echo "<td>".$row2['price']."</td>";
      echo "<td>".$row2['quantity']."</td>";

      $total= $row2['price']*$row2['quantity'];

      echo "<td>".$total."</td>";


      $resid = $row2['R_ID'];
$resquery = mysqli_query($conn, "SELECT * FROM RESTAURANTS
      WHERE R_ID = '$resid'");
      $row3 = mysqli_fetch_array($resquery);

      echo "<td>".$row3['name']."</td>";
      echo "<td>".$row2['order_date']."</td>";
echo "</tr>";
    }
    ?>
  </table>

    </div>
  </div>
    <h5>Warning! <strong>Do not reload this page</strong> or the above display will be lost. If you want a hardcopy of this page, please print it now.</h5>
  </div>

        

<?php
unset($_SESSION["count"]);
?>
<br><br>
        </body>

  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HomeFood 2021  | &copy All Rights Reserved </p>
  <br>
  </footer>
</html>
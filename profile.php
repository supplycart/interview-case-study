<?php
include_once("connection.php");
$conn = Connect();
  session_start();


  if(!isset($_SESSION['login_user2']))
  {
  header("location: login.php");
}

  $username=$_SESSION['login_user2'];
$cust = mysqli_query($conn, "SELECT * FROM customer
      WHERE username = '$username'");
$row = mysqli_fetch_array($cust);
$order = mysqli_query($conn, "SELECT * FROM orders
      WHERE username = '$username'");
?>


<html>

  <head>
    <title> Profile | HomeFood </title>
  </head>


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

    <hr>
<div class="container bootstrap snippet">
    <div class="row">

      <div class="col-sm-9">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#home">Profile</a></li>
                <li><a data-toggle="tab" href="#changepassword">Change Password</a></li>
                <li><a data-toggle="tab" href="#current">Past Order</a></li>
              </ul>

              
          <div class="tab-content">
            <div class="tab-pane active" id="home">
                <hr>
                  <form class="form" method="post" action="" id="registrationForm">
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="first_name"><h4>Username</h4></label>
                              <input type="text" class="form-control" name="username" id="username" value="<?php echo($row['username']) ?>" Disabled >
                          </div>
                      </div>
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                            <label for="last_name"><h4>Full Name</h4></label>
                              <input type="text" class="form-control" name="name" id="name" value="<?php echo($row['fullname']) ?>" required="">
                          </div>
                      </div>
          
                      <div class="form-group">
                          
                          <div class="col-xs-6">
                              <label for="phone"><h4>Email</h4></label>
                              <input type="text" class="form-control" name="email" id="email" value="<?php echo($row['email']) ?>" required="">
                          </div>
                      </div>
          
                      <div class="form-group">
                          <div class="col-xs-6">
                             <label for="mobile"><h4>Contact</h4></label>
                              <input type="text" class="form-control" name="contact" id="contact" value="<?php echo($row['contact']) ?>"required="">
                          </div>
                      </div>


                      <div class="form-group">
                          <div class="col-xs-6">
                              <label for="password"><h4>Address</h4></label>
                              <textarea class="form-control" name="address" id="address" required=""><?php echo($row['address']) ?></textarea>
                          </div>
                      </div>

                      <div class="form-group">
                           <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" name="submit"type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                                <button class="btn btn-lg" type="reset"><i class="glyphicon glyphicon-repeat"></i> Reset</button>
                            </div>
                      </div>
<?php
if(isset($_POST['submit'])){
  include_once("connection.php");
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $contact = mysqli_real_escape_string($conn,$_POST['contact']);
  $address = mysqli_real_escape_string($conn,$_POST['address']);

  $result = mysqli_query($conn, "UPDATE customer SET fullname='$name',email='$email',contact='$contact',address='$address' WHERE username='$username'");
    //display success message
  echo '<script type="text/javascript">alert("Profile edited!");</script>';
  echo "<meta http-equiv='refresh' content='0'>";
}
?>

                </form>
              
              <hr>
              
             </div><!--/tab-pane-->


             <div class="tab-pane" id="changepassword">
               
               <h2></h2>
               <form class="form" method="post" id="changepass" action="#changepassword">
          <div class="row">
          <div class="form-group col-xs-12">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Password: </label>
            <div class="input-group">
              <input class="form-control" id="password" type="password" name="password" placeholder="Password" required="" autofocus="">
              </span>
            </div>           
          </div>
        </div>

        <div class="row">
          <div class="form-group col-xs-12">
            <label for="password"><span class="text-danger" style="margin-right: 5px;">*</span> Confirm Password: </label>
            <div class="input-group">
              <input class="form-control" id="confirm" type="password" name="confirm" placeholder="Confirm Password" required="">
            </div>           
          </div>
        </div>

        <script>
        var password = document.getElementById("password")
  , confirm_password = document.getElementById("confirm");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}
password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
</script>

<?php
if(isset($_POST['submit1'])){
  include_once("connection.php");
  $password = mysqli_real_escape_string($conn,$_POST['password']);

  $result = mysqli_query($conn, "UPDATE customer SET password='$password' WHERE username='$username'");
    //display success message
  echo '<script type="text/javascript">alert("Password changed!");</script>';
  echo "<meta http-equiv='refresh' content='0'>";
}
?>
        <div class="row">
          <div class="form-group col-xs-4">
              <button class="btn btn-primary" name="submit1" type="submit" value=" Login ">Submit</button>

          </div>

        </div>
      </form>
               
               
             </div><!--/tab-pane-->


             

              <div class="tab-pane" id="current">
                  <hr>
                  <table class="table"  border=0>
    <tr>
      <td>Order ID</td>
      <td>Food Name</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Total Price</td>
      <td>Order Date</td>
      <td>Restaurant Name</td>
    </tr>
    <?php
    while($row2= mysqli_fetch_array($order)){
      echo "<tr class='danger'>";
      echo "<td>".$row2['order_ID']."</td>";
      echo "<td>".$row2['foodname']."</td>";
      echo "<td>".$row2['price']."</td>";
      echo "<td>".$row2['quantity']."</td>";

      $total= $row2['price']*$row2['quantity'];

      echo "<td>".$total."</td>";
      echo "<td>".$row2['order_date']."</td>";

      $resid = $row2['R_ID'];
$resquery = mysqli_query($conn, "SELECT * FROM RESTAURANTS
      WHERE R_ID = '$resid'");
      $row3 = mysqli_fetch_array($resquery);

      echo "<td>".$row3['name']."</td>";
echo "</tr>";
    }
    ?>
  </table>
            
              </div><!--/tab-pane-->
          </div><!--/tab-content-->

        </div><!--/col-9-->
    </div><!--/row-->
</body>
  <footer class="container-fluid bg-4 text-center">
  <br>
  <p> HomeFood 2021  | &copy All Rights Reserved </p>
  <br>
  </footer>
</html>
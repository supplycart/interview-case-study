    <?php
include('custsetlogin.php'); // Includes Login Script

if(isset($_SESSION['login_user2'])){
header("location: index.php"); //Redirecting to myrestaurant Page
}
?>


<html>

  <head>
    <title> Customer Signup | HOMEFOOD </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/login.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <body>


   <style>
@import url('https://fonts.googleapis.com/css?family=Mukta');
body{
  background-image: url(IMAGES/1.jpg);
}
 </style>
    

<div class="login-reg-panel">
    <div class="login-info-box">
      <h2>Already have an  account?</h2>
      <p>Click here to Login!</p>
      <label id="label-register" for="log-reg-show">Login</label>
      <input type="radio" name="active-log-panel" id="log-reg-show"  checked="checked">
    </div>
              
    <div class="register-info-box">
      <h2>Don't have an account?</h2>
      <p>Register Now!</p>
      <label id="label-login" for="log-login-show">Register</label>
      <input type="radio" name="active-log-panel" id="log-login-show">
    </div>
              
    <div class="white-panel">
      <div class="login-show">
        <h2>CUSTOMER LOGIN </h2>
         <form role="form" action="" method="POST">
        <input type="text" name="username" placeholder="Username" >
        <input type="password" name="password" placeholder="Password" >
 
 <p style="color:red;"> <?php echo $error;  ?> </p> 
    
        <br>
               <input type="submit" name="submit" value="Login">

           </form>  
      </div>
      <div class="register-show">

        <h2>REGISTER</h2>
          <form role="form" action="cust_register_success.php" method="POST">
        
        <input type="text" name="name" placeholder="Your Full Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <input type="text" name="phone" placeholder=" Phone Number" required>
        <input type="text" name="address" placeholder=" Your Address" required>
        <input type="text" name="username" placeholder="Create Username" required> 
        <input type="password" name="password" placeholder="Create Password" required>
        <input type="submit" value="Register">
      </form>
      </div>
    </div>
  </div>



    </body>

    <script>
      $(document).ready(function(){
    $('.login-info-box').fadeOut();
    $('.login-show').addClass('show-log-panel');
});


$('.login-reg-panel input[type="radio"]').on('change', function() {
    if($('#log-login-show').is(':checked')) {
        $('.register-info-box').fadeOut(); 
        $('.login-info-box').fadeIn();
        
        $('.white-panel').addClass('right-log');
        $('.register-show').addClass('show-log-panel');
        $('.login-show').removeClass('show-log-panel');
        
    }
    else if($('#log-reg-show').is(':checked')) {
        $('.register-info-box').fadeIn();
        $('.login-info-box').fadeOut();
        
        $('.white-panel').removeClass('right-log');
        
        $('.login-show').addClass('show-log-panel');
        $('.register-show').removeClass('show-log-panel');
    }
});
  </script>


</html>
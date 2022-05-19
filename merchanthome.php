
<!DOCTYPE html>
<html>

  <head>
    <title> HOMEFOOD </title>
  </head>

 <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<style>
  .image-grid-cover {
    width: 100%;
    background-size: cover;
    min-height: 180px;
    position: relative;
    margin-bottom: 30px;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    border-radius: 4px;
}
.image-grid-clickbox {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    display: block;
    width: 100%;
    height: 100%;
    z-index: 20;
    background: rgba(0,0,0,.45);
}
.cover-wrapper {
    font-size: 18px;
    text-align: center;
    display: block;
    color: #fff;
    text-shadow: rgba(0,0,0,.8) 0 1px 0;
    z-index: 21;
    position: relative;
    top: 80px;
}
a, a:focus, a:hover {
    text-decoration: none;
    outline: 0;
  }

  


}
</style>

    

<body class="pt-5 pb-5 mt-0 align-items-center d-flex bg-dark" style="height:100vh; background-size: cover; background-image: linear-gradient(rgba(0, 0, 0, 0.927),rgba(0, 0, 0, 0.7)) , url(IMAGES/2.jpg);">
  
 
<div class="container">
  <center> <img id="logo-main" src="IMAGES/11.png" width="900" alt="Logo Thing main logo"> </center>
  <br>

<br>


<div class="row">
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/7.jpg );" class="image-grid-cover">
                <a href="merchantaddrestaurant.php" class="image-grid-clickbox"></a>
                <a href="merchantaddrestaurant.php" class="cover-wrapper">My restaurant</a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/3.jpg  );" class="entry-cover image-grid-cover has-image">
                <a href="merchant_view_food_items.php" class="image-grid-clickbox"></a>
                <a href="merchant_view_food_items.php" class="cover-wrapper">View Food Items</a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/6.jpg );" class="entry-cover image-grid-cover has-image">
                <a href="merchant_add_food_items.php" class="image-grid-clickbox"></a>
                <a href="merchant_add_food_items.php" class="cover-wrapper">Add Food Items</a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/5.jpg );" class="entry-cover image-grid-cover has-image">
                <a href="merchant_edit_food_items.php" class="image-grid-clickbox"></a>
                <a href="merchant_edit_food_items.php" class="cover-wrapper">Edit Food Items</a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/9.jpg );" class="entry-cover image-grid-cover has-image">
                <a href="merchant_delete_food_items.php" class="image-grid-clickbox"></a>
                <a href="merchant_delete_food_items.php" class="cover-wrapper">Delete Food Items</a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 image-grid-item">
              <div style="background-image: url(IMAGES/8.jpg );" class="entry-cover image-grid-cover has-image">
                <a href="merchant_view_order.php" class="image-grid-clickbox"></a>
                <a href="merchant_view_order.php" class="cover-wrapper">View Order Details</a>
              </div>
            </div>
          </div>
      <a style="text-align: right;" class="nav-link" href="merchantsetlogout.php">LOGOUT</a>  
</div>

  </html>

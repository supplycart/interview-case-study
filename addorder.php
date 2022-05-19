<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: login.php"); //Redirecting to myrestaurant Page
}

$gtotal = 0;
$count=0;
  foreach($_SESSION["cart"] as $keys => $values)
  {

    $F_ID = $values["food_id"];
    $foodname = $values["food_name"];
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"]);
    $R_ID = $values["R_ID"];
    $username = $_SESSION["login_user2"];
    $order_date = $_SESSION['ordertime'];
    $status = 'Not Delivered';

    
    $gtotal = $gtotal + $total;


     $query = "INSERT INTO ORDERS (F_ID, foodname, price,  quantity, order_date, status, username, R_ID) 
              VALUES ('" . $F_ID . "','" . $foodname . "','" . $price . "','" . $quantity . "','" . $order_date . "','" . $status . "','" . $username . "','" . $R_ID . "')";
             
              
              $count+=1;
              $success = $conn->query($query);         

      if(!$success)
      {
header("location: payment.php");
      }
      
  }
      $_SESSION['count']=$count;
      header("location: COD.php");

?>
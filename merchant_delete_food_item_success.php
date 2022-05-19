<?php

include('merchantsession.php');

if(!isset($login_session)){
header('Location: merchantsignup.php'); // Redirecting To Home Page
}




$cheks = implode("','", $_POST['checkbox']);
$sql = "DELETE FROM FOOD WHERE F_ID in ('$cheks')";
$result = mysqli_query($conn,$sql) or die(mysqli_error());

header('Location: merchant_delete_food_items.php');
$conn->close();


?>
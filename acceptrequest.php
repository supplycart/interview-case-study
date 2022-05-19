<?php
//including the database connection file
include_once("connection.php");
    $conn = Connect();


//getting id of the data from url
$username = $_GET['accep'];

$sesh = mysqli_query($conn, "SELECT * FROM requests WHERE username='$username'");
$row = mysqli_fetch_array($sesh);

$username = $row['username'];
$password = $row['password'];
$name = $row['name'];
$email = $row['email'];
$icnum = $row['icnum'];
$phone = $row['phone'];


$query = mysqli_query($conn, "INSERT INTO manager(username,password,name,email,icnum,phone,status) VALUES('" . $username . "','" . $password . "','" . $name . "','" . $email . "','" . $icnum ."','" . $phone ."','approved')");

//deleting the row from table
$query1 = mysqli_query($conn, "DELETE FROM requests WHERE username = '$username'");
header("Location:adminhome.php");
?>
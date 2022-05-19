<?php
//including the database connection file
include_once("connection.php");
    $conn = Connect();


//getting id of the data from url
$username = $_GET['delid'];

//deleting the row from table
$query1 = mysqli_query($conn, "DELETE FROM requests WHERE username = '$username'");

header("Location:adminhome.php");
?>
<?php

function Connect()
{

	//local
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "homefood";

	//remote
	//$dbhost = "remotemysql.com";
	//$dbuser = "F033H1Jylx";
	//$dbpass = "6i3HnRLYp2";
	//$dbname = "F033H1Jylx";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

	return $conn;
}
?>
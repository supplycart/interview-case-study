<?php

function Connect()
{

	//local
	//$dbhost = "localhost";
	//$dbuser = "root";
	//$dbpass = "";
	//$dbname = "homefood";

	//remote
	$dbhost = "remotemysql.com";
	$dbuser = "yezDtDbrzw";
	$dbpass = "HzRLIwXRtB";
	$dbname = "yezDtDbrzw";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);

	return $conn;
}
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "myproject";

$conn = mysqli_connect($servername,$username,$password,$db);

if(!$conn)
{

	die ("no".mysqli_connect_error());
}


 ?>
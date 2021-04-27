<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "kokogee";

$conn = mysqli_connect("localhost","root","","kokogee");
// Check connection
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}

$conn = mysqli_connect("localhost","root","","kokogee");
// Check connection
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
date_default_timezone_set('Africa/Lagos');
$error = "";
?>
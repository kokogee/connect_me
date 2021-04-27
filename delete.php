<?php
require('db.php');
$id=$_REQUEST['id'];
$query = "DELETE FROM courses WHERE id=$id"; 
$result = mysqli_query($conn,$query) or die();
header("Location: view.php"); 
?>
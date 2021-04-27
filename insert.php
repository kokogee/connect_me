<?php
require('db.php');
include("auth.php");
$status = "";
if(isset($_POST['new']) && $_POST['new']==1){
    $firstname =$_REQUEST['firstname'];
    $lastname =$_REQUEST['lastname'];
    $course = $_REQUEST['course'];
    $submittedby = $_SESSION["username"];
    $ins_query="insert into courses
    (`firstname`,`lastname`,`course`,`submittedby`)values
    ('$firstname','$lastname','$course','$submittedby')";
    mysqli_query($conn,$ins_query)
    or die();
    $status = "New course Added Successfully.
    </br></br><a href='view.php'>View Added Course</a>";
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Insert New Course</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="view.php">View Course</a> 
| <a href="logout.php">Logout</a></p>
<div>
<h1>Insert New Course</h1>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<p><input type="text" name="Firstname" placeholder="Enter First Name" required /></p>
<p><input type="text" name="Lastname" placeholder="Enter Last Name" required /></p>
<p><input type="text" name="Course" placeholder="Enter Course" required /></p>
<p><input name="submit" type="submit" value="Submit" /></p>
</form>
<p style="color:#FF0000;"><?php echo $status; ?></p>
</div>
</div>
</body>
</html>
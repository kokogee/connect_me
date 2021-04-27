<?php
require('db.php');
include("auth.php");
$id=$_REQUEST['id'];
$query = "SELECT * from courses where id='".$id."'"; 
$result = mysqli_query($conn, $query) or die();
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Course</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p><a href="dashboard.php">Dashboard</a> 
| <a href="insert.php">Insert New Course</a> 
| <a href="logout.php">Logout</a></p>
<h1>Update Course</h1>
<?php
$status = "";
if(isset($_POST['new']) && $_POST['new']==1)
{
$id=$_REQUEST['id'];
$firstname =$_REQUEST['firstname'];
$lastname =$_REQUEST['lastname'];
$course =$_REQUEST['course'];
$submittedby = $_SESSION["username"];
$update="update courses set ".$firstname."',
Firstname='".$lastname."', course='".$course."',
submittedby='".$submittedby."' where id='".$id."'";
mysqli_query($conn, $update) or die();
$status = "Course Updated Successfully. </br></br>
<a href='view.php'>View Updated Record</a>";
echo '<p style="color:#FF0000;">'.$status.'</p>';
}else {
?>
<div>
<form name="form" method="post" action=""> 
<input type="hidden" name="new" value="1" />
<input name="id" type="hidden" value="<?php echo $row['id'];?>" />
<p><input type="text" firstname="Firstname" placeholder="Enter Name" 
required value="<?php echo $row['Firstname'];?>" /></p>
<p><input type="text" lastname="Lastname" placeholder="Enter Name" 
required value="<?php echo $row['Lastname'];?>" /></p>
<p><input type="text" name="Course" placeholder="Enter Course" 
required value="<?php echo $row['course'];?>" /></p>
<p><input name="submit" type="submit" value="Update" /></p>
</form>
<?php } ?>
</div>
</div>
</body>
</html>
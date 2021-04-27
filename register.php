<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Register</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
    
    </body>
</html>

<?php
require('db.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['username'])){
        // removes backslashes
 $firstname = stripslashes($_REQUEST['firstname']);
        //escapes special characters in a string
 $firstname = mysqli_real_escape_string($conn,$firstname); 
 $lastname = stripslashes($_REQUEST['lastname']);
 $lastname = mysqli_real_escape_string($conn,$lastname);
 $username = stripslashes($_REQUEST['username']);
 $username = mysqli_real_escape_string($conn,$username);
 $password = stripslashes($_REQUEST['password']);
 $password = mysqli_real_escape_string($conn,$password);
 
        $query = "INSERT into `users` (firstname, lastname, username, password)
VALUES ('$firstname', '$lastname', '$username' '".md5($password)."')";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<div class='form'>
    <h3>You are registered successfully.</h3>
    <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{
?>
<div class="form">
<form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="Register">
<h1>Welcome User!</h1>
<h3>Register Here!</h3>

  Firstname: <input type="text" name="firstname" value="<?php //pre-filling text-fields
  echo htmlspecialchars($firstname, ENT_QUOTES);?>"><br>
  Lastname: <input type="text" name="lastname" value="<?php //pre-filling text-fields
  echo htmlspecialchars($lastname, ENT_QUOTES);?>"><br>
  Username:<input type="text" name="username" value="<?php //pre-filling text-fields
  echo htmlspecialchars($username, ENT_QUOTES);?>"><br>
  Password: <input type="text" name="password"><br>
   </select><br>
   <input type="submit" name="submit" value="Register">

   <div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
	</div>

</div>
<?php } ?>
</body>
</html>

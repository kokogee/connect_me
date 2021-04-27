<?php
//include auth.php file on all pages
include("auth.php");

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Welcome Home</title>
</head>
<body>
<div class="container">
	<h2>Login and Registration</h2>		
	<div class="collapse navbar-collapse" >
		<ul class="nav navbar-nav navbar-left">
			<?php if (isset($_SESSION['username'])) { ?>
			<li><p class="navbar-text"><strong>Welcome!</strong> You're signed in as <strong><?php echo $_SESSION['username']; ?></strong></p></li>
			<li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
			<?php } else { ?>
			<li><a href="login.php">Login</a></li>
			<li><a href="register.php">Sign Up</a></li>
			<?php } ?>
		</ul>
	</div>	
</div>	


<!-- I don't know, if i have to add this here but this down here is the index for Forgot passwor file. -->
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Password Recovery</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="container-fluid">
<div class="row">
<div class="col-md-4">

<h2> Forgot Password </h2>

<?php
use PHPMailer\PHPMailer\PHPMailer;

include('db.php');
if(isset($_POST["username"]) && (!empty($_POST["username"]))){
$username = $_POST["username"];
$username = filter_var($username, FILTER_SANITIZE_EMAIL);
$username = filter_var($username, FILTER_VALIDATE_EMAIL);
if (!$username) {
   $error .="<p>Invalid email address please provide a valid email address!</p>";
   }else{
   $sel_query = "SELECT * FROM `users` WHERE email='".$username."'";
   $results = mysqli_query($conn,$sel_query);
   $row = mysqli_num_rows($results);
   if ($row==""){
   $error .= "<p>User not registered with this email!</p>";
   }
  }
   if($error!=""){
   echo $error;
   }else{

    $output="";

   $expFormat = mktime(
   date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
   $expDate = date("Y-m-d H:i:s",$expFormat);
   $key = md5(2418*2+$email);
   $addKey = substr(md5(uniqid(rand(),1)),3,10);
   $key = $key . $addKey;

// Insert Temp Table
mysqli_query($conn,
"INSERT INTO `password_reset` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");
 

$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="https://localhost/connect_me/password_reset/.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">
https://localhost/connect_me/password_reset/.php?key='.$key.'&email='.$email.'&action=reset</a></p>'; 
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';  


$body = $output; 
$subject = "Password Recovery";
 
$email_to = $username;

//Autoload the PHPMailer

require("vendor/autoload.php");
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Host = ""; // Enter your host here
$mail->SMTPAuth = true;
$mail->Username = "support@yi4GxZuriTeam.com"; // Enter your email here
$mail->Password = "password"; //Enter your password here
$mail->Port = 25;
$mail->IsHTML(true);
$mail->From = "support@yi4GxZuriTeam.com";
$mail->FromName = "i4GxZuriTeam";


$mail->Subject = $subject;
$mail->Body = $body;
$mail->AddAddress($email_to);
if(!$mail->Send()){
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<div class='error'>
<p>An email has been sent to you with instructions on how to reset your password.</p>
</div><br /><br /><br />";
 }
   }
}else{
?>
<form method="post" action="" name="reset"><br /><br />
<label><strong>Enter Your Email Address:</strong></label><br /><br />
<input type="email" name="email" placeholder="username@email.com" />
<br /><br />
<input type="submit" value="Reset Password"/>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>
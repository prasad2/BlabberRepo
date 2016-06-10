<?php

session_start();
$uid=$_SESSION['user_id'];
$offline="offline";

$con=mysqli_connect("localhost","root","scott","chat");
if(!$con){

	die("Failed to connect!!!".mysqli_connect_error());
}

$res4=mysqli_query($con,"UPDATE login_details SET status='$offline' WHERE id='$uid'");
mysqli_close($con);

	?>

	<script type="text/javascript"> window.location.href = "login.php"</script>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
</html>
<!-- Prasad Deshpande W1113935

	This is the login form which is used to enter our application "BLABBER".
	I have included a stylesheet "style.css" to include styling. 

 -->

<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Welcome to Blabber</title> 														  <!-- Name of the application-->
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<div class ="body">
<body>
	<form name="form3" action="login.php" method="post">								<!-- This is the login form where the user enters username and passwd-->

	<div class = "borderImg">
		<div class="login_title">
		<h2 align="center"><i>Blabber</i></h2>
	</div>
	<div class="login_table">
		<table align="center" border="2.5">
		<tr>
		<td>Enter Username:</td><td><input type="text" name="username"></td>				<!-- Username entered-->
		</tr>
		<tr>
		<td>Enter Password:</td><td><input type="password" name="password"></td>			<!-- Password entered-->
		</tr>
		<tr>
		<td><input type="submit" name="login" value="Login"></td>							<!-- Login button to enter "BLABBER"-->
		</tr>
		</table>
	</div>
	<p align="center">Not a member?? <a href="register.php">Register here</a></p>			<!-- Link to the registration form-->
</form>
</div>

</body>
</html>


<?php	// this is the PHP script to check the login details 
if(isset($_POST['login'])){


	$con=mysqli_connect("localhost","root","scott","chat");						// Connection query to the database
	if(!$con){

		die("Connection Failed!!!".mysqli_connect_error());						// Connection failed message
	}

	$username=$_POST['username'];												// Values from login form are stored in local variables for validation
	$password=$_POST['password'];
	
	$res5=mysqli_query($con, "SELECT * FROM login_details WHERE username='$username' AND password='$password' ");	// The entered values are matched
	if(mysqli_num_rows($res5)==1){
																		// if the match is found 
		while($row5=mysqli_fetch_array($res5)){
		
			$fname=$row5['firstName'];										// Storing the retrieved values into new variables
			$lname=$row5['lastName'];
		
		}
		session_start();
		$_SESSION['name_of_user']=$username;								// Starting the session for current user if all validation is successful
		$_SESSION['User_fname']=$fname;
		$_SESSION['User_lname']=$lname;

		?>
		<br/><script>window.location="home.php"</script>					<!-- Redirects the page to Home.php which is the homepage-->

	<?php 	
	}
	else {
		
?> 
       <script>alert("Username or password incorrect !!!");					// Returns an alert message if the credentials do not match
      </script>
      
<?php 

      }
      mysqli_close($con);												// Closing the connection
}
	
?>	
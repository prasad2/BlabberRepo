<!-- 
		This is the registration form which registers the user to "BLABBER" application.
-->
<html>
	<head>
		<title>Register new users</title>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>

<div class = "borderImg">
	<form name="form1" action="register.php" method="post">					<!-- Define a form for users to enter thier details -->
		<div class="register_title">
		<h2 align="center"><i>Register to Blabber</i></h2>
		</div>

	<table align="center" border="2">
	<tr>
		<td>Enter FirstName:</td>											<!-- User enters First name -->
		<td><input type="text" name="firstname"></td>
	</tr>
	<tr>
		<td>Enter LastName:</td>											<!-- User enters last name -->
		<td><input type="text" name="lastname"></td>
	</tr>
	<tr>
		<td>Enter Username:</td>											<!-- User enters username -->
		<td><input type="text" name="username"></td>
	</tr>
	<tr>
		<td>Enter Password:</td>											<!-- User enters password -->
		<td><input type="password" name="password"></td>
	</tr>
	<tr>
		<td>Re-Enter Password:</td>											<!-- User re-enters username -->
		<td><input type="password" name="password2"></td>
	</tr>
	<tr>
	<td><input type="submit" name="register" value="Register"></td>			<!-- Submit button -->
	</tr>
	</table>
	
	</form>

</div>
</body>

</html>

<?php

if(isset($_POST['register'])){
	
	
	$con=mysqli_connect("localhost","root","scott","chat");					// Php script to register new users and enter all their data into DB
	if(!$con){
		
		die("Connection Failed!!!".mysqli_connect_error());
	}
	
	
	
	$fname=$_POST['firstname'];										// Taking all the values in local variables
	$lname=$_POST['lastname'];
	$username=$_POST['username'];
	$password=$_POST['password'];
	$password2=$_POST['password2'];

	if($username == NULL){
?>
		<script>alert(" Please enter username. It cannot be blank !!!");</script>

	<?php

		}
	
	else if($password!=$password2){
?>
		<script>alert("Re-entered Password must be same !!!");</script>
<?php
	}
	
	else 
	{
		$exist=mysqli_query($con,"SELECT username FROM login_details WHERE username='$username'");		// Query to check if the user already exits
		if(mysqli_num_rows($exist)!=0){
?>	
	      <script>alert("Username already exists!!! Please enter another username.");</script>		
<?php 		}

        else {																		// New user record is inserted by this query
        																							
        																					
        	$count=mysqli_query($con,"INSERT INTO login_details(firstName,lastName,username,password) VALUES('$fname','$lname','$username','$password')");
        	if($count!=0){
        	?>
        	<p align="center">Sucessfully registered!!!<p>													<!-- Successfully registered -->
        	<p align="center">Click <a href="login.php">here</a> to login!!!</p>			
        	
        	<?php
        }
        	if ( false===$count ) {
        		printf("error: %s\n", mysqli_error($con));
        	}
        }
	}

    mysqli_close($con);
}
?>

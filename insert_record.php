<?php
session_start();

$now = "no";
$user_num=$_SESSION['user_no'];

$msg=$_REQUEST['msg'];

$user_id=$_SESSION['user_id'];


$con=mysqli_connect("localhost","root","scott","chat");
if(!$con){

	die("Connection Failed!!!".mysqli_connect_error());
}

		// This query is used to insert the message logs into the logs table.

mysqli_query($con, "INSERT INTO logs(user1_id,user2_id,message, message_read) VALUES('$user_id','$user_num','$msg', '$now') ");

/*$result3=mysqli_query($con, "SELECT * FROM logs WHERE user1_id='$user_id' AND user2_id='$user_num'");*/

//$result4=mysqli_query($con, "SELECT * FROM login_details WHERE id='$user_id' AND id='$user_num'");

mysqli_close($con);

?>
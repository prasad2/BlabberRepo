<?php 

session_start();

$user_num=$_SESSION['user_no'];

$user_id=$_SESSION['user_id'];


$con=mysqli_connect("localhost","root","scott","chat");
if(!$con){

	die("Connection Failed!!!".mysqli_connect_error());
}

$res3=mysqli_query($con, "SELECT * FROM logs WHERE user1_id='$user_id' AND user2_id='$user_num' OR user1_id='$user_num' AND user2_id='$user_id'");


$res4=mysqli_query($con, "SELECT * FROM login_details WHERE id='$user_id'");
$res9=mysqli_query($con, "SELECT * FROM login_details WHERE id='$user_num'");
$row7=mysqli_fetch_array($res4);
$row8=mysqli_fetch_array($res9);

while($row3=mysqli_fetch_array($res3)){

    if($row3['user1_id']==$user_id){
	
    	echo "<b>".$row7['username']."</b>".":".$row3['message']. "<br>";
    }
    else if($row3['user1_id']==$user_num){
    	echo "<b>".$row8['username']."</b>".":".$row3['message']. "<br>";
    }
}

mysqli_close($con);
?>
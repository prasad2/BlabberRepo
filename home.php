<!--  Prasad Deshpande

	This is the homepage. "People you may know" is one functionality that lets you add friends. Online friends are displayed in different box
-->


<!DOCTYPE html>
<html>
	<head>
	<meta charset="ISO-8859-1">
		<title>Welcome to Blabber</title>
			<script src="https://code.jquery.com/jquery-2.1.3.min.js"></Script>
			<script src="hide.js"></script>
	<script>
		function getChat(user){																// This function returns the previous chat history between two users

    		var user_number=user;
			var msg=form2.msg.value;
	
			var xmlhttp=new XMLHttpRequest();
		
			xmlhttp.onreadystatechange=function(){

			if(xmlhttp.readyState==4 && xmlhttp.status==200){

				document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open('GET', 'insert.php?user_number='+user_number,true);					// calls insert.php to return previous record
		xmlhttp.send();
	}
</script>
<script>
function submitChat(){

    var msg=form2.msg.value;
	
	var xmlhttp=new XMLHttpRequest();											// This function is used to submit chat
	
	
	xmlhttp.onreadystatechange=function(){

		if(xmlhttp.readyState==4 && xmlhttp.status==200){

			document.getElementById('chatlogs').innerHTML=xmlhttp.responseText;
			}
		}
	xmlhttp.open('GET', 'insert_record.php?msg='+msg,true);
	xmlhttp.send();
	form2.msg.value="";


	$(document).ready(function(){

        $.ajaxSetup({cache:true});
		setInterval(function(){$('#chatlogs').load('logs.php');}, 1000);
		
	});
	
}
</script>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="borderImg">
		<div class="logout">												<!-- Log out functionality -->
			<a href="logout.php">Logout</a>
		</div>
	<div class="welcome"><i>Welcome to Blabber</i>
	</div>
</div>



<form name= form2 method="post" action="home.php">						
			<a href="logout.php">Logout</a>
	<div class="chat_box">
		<div class="chat_head">Online Friends 								<!-- this shows which friends of the user are online -->
		</div>
		<div class="chat_body">
		<div class="friend">
	<!-- Friend code to be added -->
<?php 
   session_start();
   error_reporting(0);														// Session starts
   $user_fname=$_SESSION['User_fname'];
   $user_lname=$_SESSION['User_lname'];
   $name_of_user=$_SESSION['name_of_user'];
   $online="online";
   $no = "no";
   $yes = "yes";
   
   
   $con=mysqli_connect("localhost","root","scott","chat");
   if(!$con){

	   die("Connection Failed!!!".mysqli_connect_error());
}


   $result2=mysqli_query($con,"SELECT * FROM login_details WHERE firstName='$user_fname' AND FriendOrNot = '$no'");
   while($row2=mysqli_fetch_array($result2)){
   	
   	$user_id=$row2['id'];
    $_SESSION['user_id']=$user_id; 	 

    //notification code

    $receiver = $_SESSION['user_no'];


    if($receiver != $user_id){										// Whenever the user has new message the notification is displayed when the page is refreshed
    	?>
    	<script>
    	alert("You have new unread Message!!");
    	</script>
    	<?php
    	$now1 ="yes";
    	mysqli_query($con,"UPDATE logs SET message_read='$now1' WHERE user1_id='$user_id'");		// Update the logs when the message is read
    }

    //notification code ends
   	
   }
   $id=$_SESSION['user_id'];
   $res3=mysqli_query($con,"UPDATE login_details SET status='$online' WHERE id='$id'");		// Query to set the status of the user online
   
   $result=mysqli_query($con,"SELECT * FROM login_details WHERE status='$online' AND id!='$id' AND FriendOrNot = '$no'");
   
   
?>
<?php 
   
   while($row=mysqli_fetch_array($result)){
   	
   	$first_name=$row['firstName'];
   	$last_name=$row['lastName'];
   	$username=$row['username'];
   	$unique=$row['id'];
   	
 ?>  	
 <table><tr><td><div id="<?php echo $unique;?>"><?php echo $username;?>					
</div></td></tr></table>  
<?php 
 }
?>
<!-- Friend code to added till here -->
<script>
$(document).ready(function(){

	
	<?php for ($i=1;$i<=$unique;$i++){  ?>

	$('#<?php echo $i; ?>').click(function(){				//	<!-- Toggles the message box to show and hide the message box  -->
		
		$('.msg_wrap').show();
		$('.msg_box').show();

        display(<?php echo $i; ?>);
		
	});
	<?php }  ?>
});
</script>
<script>
function display(user){

//	document.getElementById("msg_head").innerHTML=user;
//	alert(user);
    getChat(user);
}
</script>
<?php 
mysqli_close($con);
?>
</div>
</div>
</div>
<div class="msg_box">
	<div id="msg_head">Message Box
		<div class="close">x</div>
	</div>																				<!-- Div tags to create the message box, chat box  -->
<div class="msg_wrap">
	<div class="msg_body">
		<div id="chatlogs"> 
		</div>
	</div>
<div class="msf_footer">
	<textarea rows ="3" class="input_msg" name="msg"></textarea>
</div>
	<div class="send">
		<button type="button" class="button" id="btn1" onclick="submitChat()">Send</button>
	</div>
</div>
</div>

<!-- Div tag for adding friends -->
<div class= "add_friends_box">															<!-- Div tag to create add friends box -->
	<div id= "add_friend_head">People you may know
		</div>
	<!-- Adding code -->	
	<div id= "add_friend_body">
		<div class="user">
			<?php 
   			session_start();
   			error_reporting(0);
   			$user_fname=$_SESSION['User_fname'];
   			$user_lname=$_SESSION['User_lname'];
   			$name_of_user=$_SESSION['name_of_user'];
   			$online="online";
   
   
   		$con=mysqli_connect("localhost","root","scott","chat");
   		if(!$con){

	   		die("Connection Failed!!!".mysqli_connect_error());
		}

   			$result2=mysqli_query($con,"SELECT * FROM login_details WHERE firstName='$user_fname' ");
   			while($row2=mysqli_fetch_array($result2)){
   	
   			$user_id=$row2['id'];
    		$_SESSION['user_id']=$user_id; 	
   	
   		}
   			$id=$_SESSION['user_id'];
   			$res3=mysqli_query($con,"UPDATE login_details SET status='$online' WHERE id='$id'");
   
   			$result=mysqli_query($con,"SELECT * FROM login_details WHERE status='$online' AND id!='$id' AND FriendOrNot != '$no'");
   
   
			?>
		<?php 
   
   			while($row=mysqli_fetch_array($result)){
   	
   			$first_name=$row['firstName'];
   			$last_name=$row['lastName'];
   			$username=$row['username'];
   			$unique=$row['id'];
   	
 			?>  	
 		<table>
 			<tr>
 				<td><div id="<?php echo $unique;?>"><?php echo $username;?></div>
 				</td>
 				<td><input type="submit" name="addFriend" id="addButton" value="Add Friend" onclick = "this.value='Added'">
 				</td>
			</tr>
		</table>  


		<script>
			function addToFriends(){

				
				
			}

		</script>
	</div>
</div>

<?php 
 }
?>




		<!-- end -->

</div>

</form>
</body>

<!-- on click functionality -->

<?php
$yes = "yes";
$no = "no";
if(isset($_POST['addFriend'])){


	$con=mysqli_connect("localhost","root","scott","chat");
	if(!$con){

		die("Connection Failed!!!".mysqli_connect_error());
	}

	
	
	$res =mysqli_query($con, "UPDATE login_details SET FriendOrNot = '$no' WHERE username ='$username'");
	
		?>

<!-- on click end -->
      
<?php 

      
      mysqli_close($con);
}
	
?>	


<div class="logged_user">
<?php echo $name_of_user."'s spot";
?>
</div>
</html>
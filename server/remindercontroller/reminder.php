<?php
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");
	/*
	$mailId = mysqli_real_escape_string($con, $_POST['mailId']);
	$all = mysqli_real_escape_string($con, $_POST['all']);
	*/
	$mailId = $_REQUEST['mailId'];
	$all = $_REQUEST['all'];
	echo $all;
	if($all=="true"){
		echo "Inside all";
		//Query to Send Msg to all
		$query = "SELECT * FROM T_WISH_LIST WHERE WL_IS_CONTRIBUTED = 'NO'";
		$result = mysqli_query($con,$query);
			
		while($row = mysqli_fetch_array($result)) {
			$mailAdd = $row['WL_CONTRIBUTOR_MAIL'];
			echo $mailAdd." ";
			sendMail($mailAdd);
		}
	}
	else{
		sendMail($mailId);
	}
	
	function sendMail($mailId){
		$email_to = $mailId;
		$email_subject = "Avnet Touch: Reminder Mail";
		$email_from = "Avnet Touch";
		
		$email_message = "Your wish list due for Avnet Touch is still pending.<br/> Kindly deliver the item(s) to below people.<br/>Please ignore if already contributed.";

		//mail to us
		// create email headers
		$headers = 'From: '.$email_from."\r\n".
		'Reply-To: '.$email_from."\r\n" .
		'X-Mailer: PHP/' . phpversion();
		@mail($email_to, $email_subject, $email_message, $headers);  
					
		echo "Email Sent";
	}
	
	mysqli_close($con);
?>
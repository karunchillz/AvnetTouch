<?php
	$con=mysqli_connect("localhost","root","passw0rd1","avnettouch");

	$mailId = "nijin.atech@gmail.com";
	
	$postdata = file_get_contents("php://input");
	$request = json_decode($postdata);

	$orgName = $request->orgName;
	$orgPhone = $request->orgPhone;
	$orgRef = $request->orgRef;
	$orgSugg = $request->orgSugg;
	
	$email_to = $mailId;
	$email_subject = "Avnet Touch: Organization Reference";
	$email_from = "Avnet Touch";
	
	$email_message = "Organization Name:".$orgName."<br/>";
	$email_message .= "Organization Contact:".$orgPhone."<br/>";
	$email_message .= "Referred By:".$orgRef."<br/>";
	$email_message .= "Suggestions:".$orgSugg."<br/>";

	//mail to us
	// create email headers
	$headers = 'From: '.$email_from."\r\n".
	'Reply-To: '.$email_from."\r\n" .
	'X-Mailer: PHP/' . phpversion();
	@mail($email_to, $email_subject, $email_message, $headers);  
				
	echo "Your Suggestion has been recorded. We will contact you soon!";
	
	mysqli_close($con);
?>
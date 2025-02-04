<?php

if(!isset($_POST['submit']))
{
	//This page should not be accessed directly. Need to submit the form.
	echo "error; you need to submit the form!";
}

$form_name = htmlspecialchars($_POST['newsletter']);
$creator = htmlspecialchars($_POST['creator-contact']);
$business = htmlspecialchars($_POST['business-contact']);
$name = htmlspecialchars($_POST['name']);
$visitor_email = htmlspecialchars($_POST['email']);
$url = htmlspecialchars($_POST['website']);
$subject = htmlspecialchars($_POST['subject']);
$message = htmlspecialchars($_POST['message']);
$newsletter = htmlspecialchars($_POST['subscriber-checked']);



$sanitizedEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);


//Validate first
if(empty($name) || empty($sanitizedEmail)){
    echo "Name and email are mandatory!";
  
}

if(!filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)){
  if($visitor_email == $sanitizedEmail && filter_var($visitor_email, FILTER_VALIDATE_EMAIL)){
    echo "The $visitor_email is a valid email address";
} else{
    echo "The $visitor_email is not a valid email address";
}
}

if (empty($_POST["website"])) {
  $url = "";
} else {
  $url = test_input($_POST["website"]);
  // check if URL address syntax is valid (this regular expression also allows dashes in the URL)
  if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    $websiteErr = "Invalid URL";
  }
}

$email_from = "info@peerandinfluence.co.za";//<== update the email address
$email_subject = "New contact from Website: $subject  \r\n";
$email_body = "You have received a new message from the user : $sanitizedEmail \r\n";
    "This is a contact for : $creator \r\n";
    "This is a contact for : $business \r\n";
    "This is a subject : $subject \r\n";
    "This is a message : $message  \r\n";

    
$mailTo = "info@peerandinfluence.co.za";//<== update the email address
$headers = "Reply to: $visitor_email \r\n";
$headers .= "This comes from : $name \r\n";
$headers .= "The subject is : $subject \r\n";
$headers .= "The message is : $message \r\n";
$headers .= "The website name is : $url \r\n";
$txt = "You have received an email from " .$name ;

//Send the email!
mail($mailTo, $txt, $headers, $email_subject, $email_body);
//done. redirect to thank-you page.
header("Location: thank-you.html");
exit;



// Function to validate against any email injection attempts
function IsInjected($str)
{
  $injections = array('(\n+)',
              '(\r+)',
              '(\t+)',
              '(%0A+)',
              '(%0D+)',
              '(%08+)',
              '(%09+)'
              );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if(preg_match($inject,$str))
    {
    return true;
  }
  else
    {
    return false;
  }
}
   
?> 
<?php

/* 
	this file contains the text that is used throughout this application
                      
*/


define('EMAIL_REGISTERED_SUBJECT', 10);
define('EMAIL_REGISTERED_BODY', EMAIL_REGISTERED_SUBJECT + 1);

define('UNSUPPORTED_REQUEST',   EMAIL_REGISTERED_BODY + 1);
define('UNKNOWN_REQUEST',       UNSUPPORTED_REQUEST + 1);
define('REGISTRATION',          UNKNOWN_REQUEST + 1);
define('REGISTRATION_EXISTS',   REGISTRATION + 1);
define('LOGINFAILED',           REGISTRATION_EXISTS + 1);
define('ENDOFSESSION',           LOGINFAILED + 1);
define('NOEMAILADDRESS',           ENDOFSESSION + 1);
define('ENOTIFICATION',            NOEMAILADDRESS + 1);
define('ENOTIFY6MONTH',            ENOTIFICATION + 1);
define('UNKNOWN_REQUEST_TITLE',    ENOTIFY6MONTH + 1); 
define('NOSESSIONPENDING',       UNKNOWN_REQUEST_TITLE + 1);
define('ENDOFSURVEY',            NOSESSIONPENDING + 1);

$hl_responses = array();
$hl_responses['title'] = "Mindful Awareness and Happiness";
$hl_responses[EMAIL_REGISTERED_SUBJECT] = "re: Nature relatedness intervention survey registration ";

$hl_responses[EMAIL_REGISTERED_BODY] = "Thank you for participating in this survey\n\n".
                          				"An account has been created for you along with a generated password.\n".
                          				"To log in you will use your email address along with this password %s.\n\n".
                          				"You can complete your registration and start your first session by going to %s \n\n".
                          				"Once again thank you for participating.";
 
$hl_responses[UNSUPPORTED_REQUEST] = "This is an unsupported request, please try again";

$hl_responses[UNKNOWN_REQUEST_TITLE] = "Mindful Awareness and Happiness";
$hl_responses[UNKNOWN_REQUEST] = "Unable to handle this request, please try again";




$hl_responses[REGISTRATION] = "<p>The link to the study and the password has been sent to your email account.</p>".
							  "<p>Please check your e-mail now, and continue the study.</p>".
							  "<p>Please note that some email programs might place these emails into your junk or spam folders.</p>".
							  "<p>Thank you for registering.</p>"; 

$hl_responses[REGISTRATION_EXISTS] = "<p>It seems you are already registered.</p>";	

$hl_responses[LOGINFAILED] = "<p>Login failed. The user name and password combination is invalid.</p>" .
								"<p>Please try again.</p>";                        
                          
  
$hl_responses[NOSESSIONPENDING] = "<p>There is no survey to do at this time. You will be contacted by email at the appropriate time.</p>" .
								"<p>Please try again.</p>";                        
                        
$hl_responses[ENDOFSESSION] = "<br /><p>Thank you for completing this session.</p>".
								"<br /><p> You will be notified  by email when the next session is to start.</p><br />";


$hl_responses[ENDOFSURVEY] = "<br /><p>You have completed the survey.</p>".
								"<br /><p> We thank you for your participation.</p><br />";


							                       
$hl_responses[NOEMAILADDRESS] = "<p>Registration failed, no email address entered.</p>";
				


//Script for Carleton participants receiving credit:
$hl_responses[ENOTIFICATION][0] = "\nHello. This is a reminder to log in to the Happiness Study webpage " .
                  "%s ( password: %s ) for survey number %s today.  Remember, completing the surveys count " .
                  "towards your experimental credits.".
				  "\nThank you for participating!\n";


//Script for Community participants:
$hl_responses[ENOTIFICATION][1] = "\nHello. This is a reminder to log in to the Happiness Study webpage %s ".
					"( password: %s ) for survey number %s today. Remember, you earn one chance in the $500 prize draw ".
					"for each of the surveys you complete.".
					"\nThank you for participating!\n";



$hl_responses[ENOTIFY6MONTH] =
"\nHello.  This is a message from the Happiness Study researchers that we have a follow-up survey we would appreciate you completing.  To thank you for your help with this, your name will be entered in a draw for $200 (U.S.) for completing this final online questionnaire. ".
"\n\nTo complete the survey and have your name entered in the draw, please visit the study webpage, %s ( password: %s ) using the same log-in information as before.". 
"\n\nThank you for participating!\n";
					
				

?>


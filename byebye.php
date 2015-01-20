<?php
/* 
	this code handles basicalyy the end of a session. various clean-up functions will
	be called dependent on the type of clean-up required.
	
	input: reqMsg - could be 1 of the following messages/form types
                          - registration : new participant, need email address
                          
 	output: this will either create an account, end a session (write the data, destroy
 	        session),....
                       
*/
session_start(); 
// start the session - MUST have this or will not work. 

 ////// phpinfo(INFO_VARIABLES);  // gives post/get and for variables
////////print_r($_SESSION);

include_once("hl_config.php");
require_once( "logger.php");
require_once(  "fileManager.php");
require_once ( "general.php");
require_once ( "./text/text.php");

$form_name = 'welcome';

$responseMsg = "";

if ( isset($_REQUEST['reqMsg'])  ){
	switch ($_REQUEST['reqMsg']){
		case "registration":
			if ( isset($_REQUEST['emailAdr'])  ){
				$scrubbed_user = checkInputString($_REQUEST['emailAdr']);
				$scrubbed_cuid = checkInputString($_REQUEST['CUId']);
				$scrubbed_cuemail = checkInputString($_REQUEST['cuemailAdr']);
				$user = verifyUser($scrubbed_user);
				if ( strlen($user) > 0){
         			// match found
					$responseMsg = sprintf($hl_responses[REGISTRATION_EXISTS]);
				}else{
					// user not found, register...
					$newUserId = generateUserId(USERIDFILE);
					$upw = generatePW();
					$condition_grp = ( (int)$newUserId & 1 ) ? "NR" : "CC";
					$XOver = "O";
					$new_user_rec = $newUserId . $internal_delimiter . $scrubbed_user . $internal_delimiter . $upw .  
						$internal_delimiter . $condition_grp . $internal_delimiter . $XOver .$internal_delimiter . $scrubbed_cuid;
					append2FileFile($userAccounts, $new_user_rec);
					$connectEmailAdr = (strlen($scrubbed_cuemail) > 0)?$scrubbed_cuemail."@connect.carleton.ca" : "";
					append2FileFile($userMapping, $newUserId . $internal_delimiter . $scrubbed_user.  $internal_delimiter . $connectEmailAdr);
					$email_resp = emailNotification($scrubbed_user, 
									sprintf($hl_responses[EMAIL_REGISTERED_SUBJECT]), 
									sprintf($hl_responses[EMAIL_REGISTERED_BODY], $upw, LOGINURL) );

					$responseMsg = sprintf($hl_responses[REGISTRATION]);
				}
			}else{
				$responseMsg = sprintf($hl_responses[NOEMAILADDRESS]);
			}

			break;

		case "goodbye":
			if ( isset($_REQUEST['respMsg'])  ){
				$responseMsg = sprintf($hl_responses[$_REQUEST['respMsg']]);
			}
			break;


		case "endOSession":
			for($i=0; $i < count($nr_session[$_SESSION['current_session']] ); $i++){
				if ( isset($_SESSION[$nr_session[$_SESSION['current_session']][$i]])  ){
					writeSurvey2FileFile( $_SESSION['uid'], $_SESSION['grp'], $_SESSION['xover'],
											$_SESSION[$nr_session[$_SESSION['current_session']][$i]]);
				}
			}
			updateSessionTracker($_SESSION['uid'], $_SESSION['current_session'], date('d-m-Y', strtotime('+' . $sessionInterval[$_SESSION['current_session']] . ' days')));
			$responseMsg = sprintf($hl_responses[ENDOFSESSION]);
			
			// wipe out the session data
		    $_SESSION = array();
    		session_destroy();
			
			break;
			
			
		case "endOSurvey":
			xOverParticipant($_SESSION['uid']);
			deleteSessionTracker($_SESSION['uid']);
			$responseMsg = sprintf($hl_responses[ENDOFSESSION]);
			
			// wipe out the session data
		    $_SESSION = array();
    		session_destroy();
			
			break;			
			
		default:
			$responseMsg = sprintf($hl_responses[UNSUPPORTED_REQUEST]);
			break;
	}  //end of switch
}else{
	$responseMsg = sprintf($hl_responses[UNKNOWN_REQUEST]); 
}



///$iamMe = $_SESSION['iam'];
///$iamMid = $_SESSION['iuser'];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>hl: thank you -  v 0.01</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="coreClientFuncs.js"></script>
	<script type="text/javascript" src="myAjax.js"></script>
	<script type="text/javascript" src="common.js"></script>  
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>

<script type="text/javascript">
  
function setInit()
{

}  // end of setInit()

</script>

<!--  START HTML HERE   -->

<body id="home" onLoad='setInit();'>

  <!-- Begin Wrapper -->
   <div id="hl_wrapper">
   
         <!-- Begin Header -->
         <div id="hl_header">

		 	<img src="img/logo.jpg" alt="Carleton University">
		 	<span class="pageTitle"><?php  ?> </span>
		    <img src="img/banner.jpg" >   
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="hl_leftcolumn">
		 
		       <!-- Left Column  -->
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="hl_rightcolumn">

       		<?php  echo $responseMsg;  ?>  		
		 
	      </div>
		 <!-- End Right Column -->
		 
		 <!-- Begin Footer -->
		 <div id="hl_footer">
		       <div id="footer"><p>&copy; 2008 Carleton University | 1125 Colonel By Drive, Ottawa, ON, Canada K1S 5B6 | <a href="#" onclick="return contactInfo()">Contact</a> the researchers</p></div>
	     </div>                                                                                                                                 
		 
   </div>

   <!-- End Wrapper -->

</body>

</html>





  


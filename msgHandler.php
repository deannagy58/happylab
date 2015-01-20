<?php

// call session_start() to create a session. 
session_start();  


include_once("hl_config.php");
require_once "json/JSON.php";
require_once "logger.php";
require_once "fileManager.php";
require_once "general.php";
require_once ( "text/text.php");

//////////phpinfo(INFO_VARIABLES);
////phpinfo();
$json = new Services_JSON();

$msgResp = array('status'=> 'err', 
               'response' => 'Unable to process request',
               'action'=> 'standard',
               'stuff'=> null);



if ( isset($_REQUEST['action'])  ){
	switch ($_REQUEST['action']){
		case "loggit":
			remoteLogging( "client ", $_REQUEST['myDee'], $_REQUEST['sayWot']);
			break;
			
		case "ttloginreq":
			$scrubbed_user = checkInputString($_REQUEST['uname']);
			$scrubbed_pwd = checkInputString($_REQUEST['upw']);
			
			//echo "tryin to login: " ;
			$msgResp['response'] = "tryin to login:";
			$theUserRec = verifyUserII($scrubbed_user, $scrubbed_pwd);
			if ("" != $theUserRec){
				$msgResp['response'] = "verified user";
				$theUserParts = explode(INTERNAL_DELIMITER, $theUserRec);		
				$userSessionRec = getUserSessionTrackerRec($theUserParts[0]);
				if ("" != $userSessionRec){
					$msgResp['response'] = "usr sess rec".$userSessionRec;
					$userSessionParts = explode(INTERNAL_DELIMITER, $userSessionRec);	
					if ("10" == $userSessionParts[1]){
						$msgResp['goto'] = HLBASEURL."byebye.php?reqMsg=goodbye&respMsg=".ENDOFSURVEY;
						break;
					}
					//	$nextDate = strtotime($userSessionParts[2]);  // orig
					//	$nextDate =  $userSessionParts[2];
					//	$today = strtotime(date("d-m-Y", strtotime("now")));   // orig
					//	$today =  date("d-m-Y"); //  strtotime(date("d-m-Y")); 
 
            		$n_date = explode('-', $userSessionParts[2]);
            				$nextDate =  mktime(0, 0, 0, $n_date[1], $n_date[0], $n_date[2]); // strtotime($userSessionParts[2]);
					$today = strtotime( "now"); 

					if ($today >= $nextDate) {
						$msgResp = logUserIn($scrubbed_user, $scrubbed_pwd);
					//	$msgResp['response'] = "can do";
						if ($msgResp['status']){
							$next_session = getNextSession($_SESSION['uid']);
							if ($next_session == SESS_0){
								// tried to login earlier that required
								$msgResp['goto'] = HLBASEURL."byebye.php?reqMsg=goodbye&respMsg=".NOSESSIONPENDING;
							}else{
								$_SESSION['task_idx'] = 0; // starting index within $nr_session array, which lists pages to do
			 					$_SESSION['current_session'] = $next_session;  // current session to start
								$msgResp['goto'] = HLBASEURL.$nr_session_handlers[$nr_session[$_SESSION['current_session']][$_SESSION['task_idx']]];
							}
						}else{
							$msgResp['goto'] = HLBASEURL."byebye.php?reqMsg=goodbye&respMsg=".LOGINFAILED;
						}
					}else{
						// tried to login earlier that required
						$msgResp['goto'] = HLBASEURL."byebye.php?reqMsg=goodbye&respMsg=".NOSESSIONPENDING;				
					}
				}else{
					//first time in
					$msgResp = logUserIn($scrubbed_user, $scrubbed_pwd);
					$next_session = SESS_1;
					$_SESSION['task_idx'] = 0; // starting index within $nr_session array, which lists pages to do
			 		$_SESSION['current_session'] = SESS_1;  // current session to start
					$msgResp['goto'] = HLBASEURL.$nr_session_handlers[$nr_session[1][0]];
				}
			}else{
				$msgResp['goto'] = HLBASEURL."byebye.php?reqMsg=goodbye&respMsg=".LOGINFAILED;
			}
			break;

		default:
			$msgResp['response'] =  'action not recognized' ;
			$msgResp['action'] =  null ;
			break;
	}  //end of switch
}else{
	$msgResp['response'] =  'request has no action' ;
	$msgResp['action'] =  null ;
    
}


//convert php object to json 
$output = $json->encode($msgResp);

print($output);// echo $output;

  

?>


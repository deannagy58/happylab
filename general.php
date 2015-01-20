<?php


include_once('classes/class.phpmailer.php');



/*
	this function cleans the string, 

*/
function checkInputString($in_string)
{ 
	$scrubbed_str = "";
	
	$scrubbed_str = $in_string;
	
	return $scrubbed_str;
		
}  // end of function checkInputString()



function append2FileFile($file, $new_rec)
{ 

	$fh = fopen($file, "a");
	fwrite($fh, $new_rec."\n");
	fclose($fh);	

		
}  // end of function append2FileFile()


 
function writeSurvey2FileFile($uid, $grp, $xover, $surveySelections)
{ 
	$fd = fopen(SESSIONFILE.$_SESSION['current_session'], "a");
	// write string
	fwrite($fd, $uid . INTERNAL_DELIMITER . $grp . INTERNAL_DELIMITER . $xover. INTERNAL_DELIMITER . $surveySelections."\n" );
	// close file
	fclose($fd);

}  // end of function writeSurvey2FileFile()


	
function writeDemogInfo($uid)
{ 
	$demog_info = $uid . INTERNAL_DELIMITER;

	$demog_info .= ((isset( $_REQUEST["sex"]))? $_REQUEST["sex"] : "999") . INTERNAL_DELIMITER;
		
	$demog_info .= (("" == $_REQUEST["age"])? "999" : $_REQUEST["age"]) . INTERNAL_DELIMITER;
	$demog_info .= (("" == $_REQUEST["Ethnicity"])? "999" : $_REQUEST["Ethnicity"]) . INTERNAL_DELIMITER;

	$demog_info .= ((isset( $_REQUEST["education"]))? $_REQUEST["education"] : "999") . INTERNAL_DELIMITER;

	$demog_info .= ((isset( $_REQUEST["growup"]))? $_REQUEST["growup"] : "999") . INTERNAL_DELIMITER;	
	
	$demog_info .= (("" == $_REQUEST["grow_other"])? "999" : $_REQUEST["grow_other"]) . INTERNAL_DELIMITER;

	$demog_info .= ((isset( $_REQUEST["live"]))? $_REQUEST["live"] : "999") . INTERNAL_DELIMITER;
	
		
	$demog_info .= (("" == $_REQUEST["now_other"])? "999" : $_REQUEST["now_other"]) . INTERNAL_DELIMITER;
	
	$demog_info .= ((isset( $_REQUEST["building"]))? $_REQUEST["building"] : "999") . INTERNAL_DELIMITER;
	
	
	$demog_info .= (("" == $_REQUEST["otherbuilding"])? "999" : $_REQUEST["otherbuilding"]) . INTERNAL_DELIMITER;
	$demog_info .= (("" == $_REQUEST["country"])? "999" : $_REQUEST["country"]) . INTERNAL_DELIMITER;
	
	$demog_info .= ((isset( $_REQUEST["employed"]))? $_REQUEST["employed"] : "999") . INTERNAL_DELIMITER;
	
	
	$demog_info .= (("" == $_REQUEST["job"])? "999" : $_REQUEST["job"]) . INTERNAL_DELIMITER;

	$demog_info .= ((isset( $_REQUEST["student"]))? $_REQUEST["student"] : "999") . INTERNAL_DELIMITER;
		
		
	$demog_info .= ((isset( $_REQUEST["full"]))? $_REQUEST["full"] : "999") . INTERNAL_DELIMITER;

	append2FileFile(DEMOGRAFIKS, $demog_info);
	
}  // end of function writeDemogInfo()
	 
	 
	 
function addResponse2Session($user, $surveyName, $surveyObj)
{ 
	$templ_str = "%s%s%s";
	
	$build_q_str = "";
	
	for ($i=0; $i < sizeof($surveyObj[$surveyName]['qs']); $i++)
	{
		$idx = 'q_'.($i+1);

		if(isset($_POST[ $idx])){
			//remove  carriage return line feed chars = \n \r 
			$newLineCode = " ";
			if ("" == $_POST[ $idx]){
				$build_q_str .= "999";
			}else{
				$message = str_replace ("\n", $newLineCode, $_POST[ $idx]);
				$build_q_str .= str_replace ("\r", $newLineCode, $message);
			}
		}else{
			$build_q_str .= "999";			
		}
		if($i < sizeof($surveyObj[$surveyName]['qs']) -1 )
		{
			$build_q_str .= INTERNAL_DELIMITER;
		}
	}
	
	$survey_str = sprintf($templ_str, $surveyName, INTERNAL_DELIMITER, $build_q_str); 
    $_SESSION[$surveyName] = $survey_str;
}

 function getNextPage($current_page, $pageList){

	foreach ($pageList as $key => $value){
		if (is_numeric($key)){
			if ($getThis){
				return $value;
			}
			if ($value == $current_page){
				$getThis = true;
			}
		}
		
	}

		
	return "";
} // end of function getNextPage()

/*
logUserIn - determines is the user name and password combinations exits
            if it does it creates a session record
            if it fails, the object returns with status fail.

*/
function logUserIn($in_usrname, $in_pwd)
{ 
     $in_value = array();
     
     $user = verifyUserII($in_usrname, $in_pwd);
     
     if ( strlen($user) > 0){
     //	session_start();
         // match found
  		$pieces = explode("^", $user);
        $in_value['status'] =true;
        
        $_SESSION['uid'] = $pieces[0] ;
        $_SESSION['user'] = $pieces[1] ;
        $_SESSION['grp'] = trim($pieces[3],"\n");
        $_SESSION['xover'] = trim($pieces[4],"\n");
    ///    echo "logUserIn: " . print_r($_SESSION);
        if ( "X" == trim($pieces[4]) ){
        	$_SESSION['grp'] = ( "NR" == trim($pieces[3]) )? "CC" : "NR";	
		}
    ////     echo "logUserIn II: " . print_r($_SESSION);
      }
      else
      {
        $in_value['status'] =false;
       }
                      
    $in_value['response']="Request successful: login";

    $in_value['action']= "action"; // $_GET['action'];
    
	return $in_value;
	
}  // end of function logUserIn()




function remoteLogging($param1, $param2, $param3)
{ 
   logToFile("tstLog", $param1 .$param2 . $param3);
   
}  // end of function remoteLogging()


function emailNotification($emailAdr, $subject, $body)
{ 
	$return_value = "email notification to " . " successfully sent";

	$from = MAIL_FROMNAME;
	$headers = "From: $from";
	mail($emailAdr,	$subject, $body,	$headers);			
	
/*	
	$mail = new PHPMailer();

	$mail->IsSMTP(); // send via SMTP
	$mail->Host = MAIL_HOST; // 'smtp.broadband.rogers.com';
	$mail->SMTPAuth = MAIL_SMTPAUTH; // turn on SMTP authentication
//	$mail->Username = MAIL_USERNAME; // SMTP username
//	$mail->Password = MAIL_PASSWORD; // SMTP password

	if ("www.chillipepper.com" != $_SERVER['SERVER_NAME']){
		$mail->Port = MAIL_PORT;
	}

	$mail->From = MAIL_FROM; 
	$mail->FromName = MAIL_FROMNAME;
	$mail->AddAddress($emailAdr,'');

	$mail->AddReplyTo($emailAdr,'jello');
	
	$mail->WordWrap = 150; // set word wrap

	$mail->IsHTML(true); // send as HTML

	$mail->Subject = $subject;
	$mail->Body =  $body ;

  $return_value .= " host: " .$mail->Host . "  ";
	if(!$mail->Send())
	{
		$return_value =  "email notification to " .$emailAdr. " NOT successfully sent";
		$return_value .= 'Mailer Error: ' . $mail->ErrorInfo;
	}
	
	* */


	
	
	return $return_value;
   
}  // end of function emailNotification()




?>


#!/usr/bin/php
<?PHP


// server moded
//
// how to create and run cronjob
//
//   export EDITOR=vi    <- this set the default editor to vi
//
//   jello@dbase-server:/var/www/hl/crscripts$ sudo crontab -l
//   */5 * * * * php /var/www/hl/crscripts/hlMail.php
//   jello@dbase-server:/var/www/hl/crscripts$

//include_once('Mail.php');
//include_once('Mail/mime.php');
//include_once('/var/www/hl/classes/class.phpmailer.php');
include_once('../text/text.php');
require_once "../hl_config.php";
require_once "../fileManager.php";

  $targetText = "Hello.  You recently received an email reminder for our follow-up happiness survey, ".
                "which may have mentioned course credits, by mistake, instead of the cash draw for $200.".

                "\n\nWe would greatly appreciate your help with a final short online questionnaire.".
                "\nTo thank you for your help with this, your name will be entered in a draw for $200 (U.S.) for completing this final survey. ".

                "\nTo complete the survey and have your name entered in the draw, please visit the study webpage, %s ( password: %s) using the same log-in information as before." .

                "\n\nThank you for participating!\n\n";



function getUserRecFromUID($uid)
{

	$lines = file( "../" . USERACCOUNTS );

	for( $i = 0; $i < sizeof($lines); $i++ ){
    	$pieces = explode("^", $lines[$i]);
		if ($uid == $pieces[0]){
        	return  $lines[$i];
    	}
	}
	return "";

} // end of function getUserRecFromUID()



function LgetUserSessionTrackerRec($uid)
{
	$userSessionRec = "";
	if (file_exists("../" . SESSIONTRACKER)){
		// file exists
		$trackerFile = file("../" . SESSIONTRACKER);
		for( $i = 0; $i < sizeof($trackerFile); $i++ ){
    		$pieces = explode(INTERNAL_DELIMITER, $trackerFile[$i]);
			if (  ($uid == $pieces[0]) ){
				// found record,
				return $trackerFile[$i];
    		}
		}
	}

	return $userSessionRec;

} // end of function getUserSessionTrackerRec()






/// code tested go into cron script
$todo = 0;
if (file_exists("../" . SESSIONTRACKER)){
	$todo++;
	$sessionRec = file( "../" . SESSIONTRACKER );

	for( $i = 0; $i < sizeof($sessionRec); $i++ ){
		$sessionPieces = explode("^", $sessionRec[$i]);
		$usrSession["'" . $sessionPieces[0] . "'"]['uid'] = $sessionPieces[0];
		$usrSession["'" . $sessionPieces[0] . "'"]['sess'] = (int)$sessionPieces[1];
		$usrSession["'".$sessionPieces[0]."'"]['date'] = $sessionPieces[2];
		$usrSession["'".$sessionPieces[0]."'"]['count'] = (int)$sessionPieces[3];
	}
}

$e_idx = 0;
if (file_exists("../" . USERACCOUNTS)){
	$aUser = file( "../" . USERACCOUNTS );

    $target_count =0;
	for( $i = 0; $i < sizeof($aUser); $i++ ){
		$uPieces = explode("^", $aUser[$i]);
		if ($usrSession["'" .$uPieces[0]."'"] != null){
			// session exists for participant
			$cuStud = 1;
			if (null != trim($uPieces[5], "\n")){
				$cuStud = 0;
			}

            if (($uPieces[0] >= 1084) && ($uPieces[0] <= 1535) && ($usrSession["'".$uPieces[0]."'"]['sess'] == 9)){
                $target_count++;
					$sendEmailNotify[$e_idx]['emailAdr'] = "dnagy@datacast.com"; // $uPieces[1];
					$sendEmailNotify[$e_idx]['pw'] = $uPieces[2];
					$sendEmailNotify[$e_idx]['sess'] = $usrSession["'" .$uPieces[0]."'"]['sess'];
					$sendEmailNotify[$e_idx]['cuStud'] = $cuStud;
					$usrSession["'" .$uPieces[0]."'"]['count']++;
					$e_idx++;

			}
		}
	}
}

if ($e_idx > 0){
	$from = MAIL_FROMNAME;
	$headers = "From: $from";
	for ($i = 0; $i < $e_idx; $i++){
		$subject = "re: Happiness Study reminder";
        $body = sprintf($targetText, LOGINURL, $sendEmailNotify[$i]['pw']);
       // echo $sendEmailNotify[$i]['emailAdr'], "\n--", $body;

		mail($sendEmailNotify[$i]['emailAdr'],$subject,	$body,$headers);
	}  
}


?>










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
       //////////////// echo $uPieces[0], " ", $uPieces[1], "\n";
		if ($usrSession["'" .$uPieces[0]."'"] != null){
			// session exists for participant
			$cuStud = 1;
			if (null != trim($uPieces[5], "\n")){
				$cuStud = 0;
			}

            echo $uPieces[0], " ", $usrSession["'".$uPieces[0]."'"]['sess'] , "  ",  $usrSession["'".$uPieces[0]."'"]['date'];

            if (($uPieces[0] >= 1084) && ($uPieces[0] <= 1535) && ($usrSession["'".$uPieces[0]."'"]['sess'] == 9)){
                $target_count++;
                echo " <<<< ",$uPieces[1], " ", $target_count; // , " :: ", LOGINURL;

            }
            echo "\n";
			if (1 >= $usrSession["'".$uPieces[0]."'"]['count']){

				// check date, if interval exceeded
				$userSessionRec = LgetUserSessionTrackerRec($uPieces[0]);
				$userSessionParts = explode(INTERNAL_DELIMITER, $userSessionRec);

				// orig $nextDate = strtotime($userSessionParts[2]);
				// orig $today = strtotime(date("d-m-Y", strtotime("now")));
                        $datePieces = explode("-", $userSessionParts[2]);
                        $nextDate =  mktime(0,0,0,$datePieces[1],$datePieces[0],$datePieces[2]) ;
                        $today =  mktime(0,0,0,date("m"), date("d"), date("Y"));

				if ($today >= $nextDate) {
					//send email notification
					$sendEmailNotify[$e_idx]['emailAdr'] = $uPieces[1];
					$sendEmailNotify[$e_idx]['pw'] = $uPieces[2];
					$sendEmailNotify[$e_idx]['sess'] = $usrSession["'" .$uPieces[0]."'"]['sess'];
					$sendEmailNotify[$e_idx]['cuStud'] = $cuStud;
					$usrSession["'" .$uPieces[0]."'"]['count']++;
					$e_idx++;
				}
			}
		}
	}
}

if ($e_idx > 0){
	//email to send, update session tracker file
	$fd = fopen("../" . SESSIONTRACKER, "w");
	foreach( $usrSession as $key => $value){
	// june 24 09	fwrite($fd, $usrSession[$key ]['uid'] .INTERNAL_DELIMITER . $usrSession[$key]['sess']. INTERNAL_DELIMITER .$usrSession[$key]['date']. INTERNAL_DELIMITER . $usrSession[$key]['count']. "\n");
	//	echo $usrSession[$key ]['uid'] .INTERNAL_DELIMITER . $usrSession[$key]['sess']. INTERNAL_DELIMITER .$usrSession[$key]['date']. INTERNAL_DELIMITER . $usrSession[$key]['count']. "\n";
	}
	// close file
	fclose($fd);

	$from = MAIL_FROMNAME;
	$headers = "From: $from";
	for ($i = 0; $i < $e_idx; $i++){
		$subject = "re: Happiness Study reminder";
            if ($sendEmailNotify[$i]['sess']+1 == "10"){
                $body = sprintf($hl_responses[ENOTIFY6MONTH], LOGINURL, $sendEmailNotify[$i]['pw'], $sendEmailNotify[$i]['sess']+1);
            }else{
                $body = sprintf($hl_responses[ENOTIFICATION][$sendEmailNotify[$i]['cuStud']], LOGINURL, $sendEmailNotify[$i]['pw'], $sendEmailNotify[$i]['sess']+1);
            }
		// june 24 09mail($sendEmailNotify[$i]['emailAdr'],
		// june 24 09	$subject,
		// june 24 09	$body,
		// june 24 09	$headers);
	}  
}

/*
if (file_exists("../" . SIXMONTHTRACKER)){
	$sixMonthRecs = file( "../" . SIXMONTHTRACKER );

	$newSixMonth[0] = "";
	$newI = 0;
	for( $i = 0; $i < sizeof($sixMonthRecs); $i++ ){
		$sixMonthPieces = explode("^", $sixMonthRecs[$i]);
		$nextDate = strtotime($sixMonthPieces[1]);
		$today = strtotime(date("d-m-Y", strtotime("now")));

		$body = $sixMonthPieces[0] . " -- " . $sixMonthPieces[1];

		if ($today >= $nextDate) {
			$userRec = getUserRecFromUID( $sixMonthPieces[0]);
			$userPieces = explode("^", $userRec);
			//send email notification
			$subject = "re: Happiness Study - 6 month follow-up";
			$body = sprintf($hl_responses[ENOTIFY6MONTH], LOGINURL, $userPieces[2]);

			$from = MAIL_FROMNAME;
			$headers = "From: $from";
			mail($userPieces[1],
				$subject,
				$body,
				$headers);
		}else{
			$newSixMonth[$newI] = $sixMonthRecs[$i];
			$newI++;
		}

	}


		$fd = fopen("../" . SIXMONTHTRACKER, "w");
		for( $i = 0; $i < sizeof($newSixMonth); $i++ ){
			fwrite($fd, $newSixMonth[$i] . "\n");
		}
		fclose($fd);

}

*/
?>










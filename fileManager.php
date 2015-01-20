<?php

/*
 * getNextSession() reads task tracker file to determine whats the next
 *               session that should be started.
 * 
 *               input: the user id
 * 
 *               output: 0 - nothing to do at this time
 *                       x - 1-9 (i think) the session being done.
 * 
 * fmt of tasktracker file:  uid^x^DD-MM-YYYY^y
 * 
 *                         where x is the last session done
 *                               DD-MM-YYYY - when the last session done
 *                               y - reminders sent: 0,1=today, 2 day after, 3 2 days after, 4 no more
 * */

function getNextSession($userid)
{

	$nextTask = SESS_1;	

	if (file_exists(SESSIONTRACKER)){
		// file exists
		$trackerFile = file(SESSIONTRACKER);
	
		for( $i = 0; $i < sizeof($trackerFile); $i++ ){
    		$pieces = explode("^", $trackerFile[$i]);
			if (  ($userid == $pieces[0]) ){
				// found record, 
				$nextTask = $pieces[1] +1;
    		}
		} 	
	}	
	
	return $nextTask;
	
} // end of function getNextSession()



function updateSessionTracker($uid, $current_session, $nextDate)
{
	//$nextTask = SESS_1;	
	$updated_session_rec =  (string)$uid . INTERNAL_DELIMITER ;
	$updated_session_rec .= (string)$current_session . INTERNAL_DELIMITER;
	$updated_session_rec .= $nextDate . INTERNAL_DELIMITER;
	$updated_session_rec .= (string)0;	
	
	if (file_exists(SESSIONTRACKER)){
		// file exists
		$found = false;
		$trackerFile = file(SESSIONTRACKER);
		for( $i = 0; $i < sizeof($trackerFile); $i++ ){
    		$pieces = explode("^", $trackerFile[$i]);
			if (  ($uid == $pieces[0]) ){
				// found record, 
				$found = true;
				$trackerFile[$i] = $updated_session_rec;
    		}
		} 
		
		if (!$found){
			$trackerFile[sizeof($trackerFile)] = $updated_session_rec;			
		}
		
		$fh = fopen(SESSIONTRACKER, "w");
		for( $j = 0; $j < sizeof($trackerFile); $j++ ){
			fwrite($fh, trim($trackerFile[$j], "\n") . "\n" );
		}
		fclose($fh);	
	
	}else{
		// tracker file dosent exist, create a new one
	//	append2FileFile(SESSIONTRACKER, $updated_session_rec);
		$fh = fopen(SESSIONTRACKER, "w");
		fwrite($fh, $updated_session_rec."\n");
		fclose($fh);	
	}	
	
//	return $nextTask;
	
} // end of function updateSessionTracker()



function getUserSessionTrackerRec($uid)
{
	$userSessionRec = "";
	if (file_exists(SESSIONTRACKER)){
		// file exists
		$trackerFile = file(SESSIONTRACKER);
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




function deleteSessionTracker($uid)
{
	if (file_exists(SESSIONTRACKER)){
		// file exists
		$trackerFile = file(SESSIONTRACKER);
		$n_i = 0;
		for( $i = 0; $i < sizeof($trackerFile); $i++ ){
    		$pieces = explode("^", $trackerFile[$i] );
			if (  ($uid != $pieces[0]) ){
				// found record, 
				$newTrackerFile[$n_i] = $trackerFile[$i];
				$n_i++;
    		}
		} 
		
		$fh = fopen(SESSIONTRACKER, "w");
		for( $j = 0; $j < sizeof($newTrackerFile); $j++ ){
			fwrite($fh, trim($newTrackerFile[$j], "\n") ."\n");
		}
		fclose($fh);	
	}	
	
} // end of function deleteSessionTracker()


function xOverParticipant($uid)
{
	if (file_exists(USERACCOUNTS)){
		// file exists
		$users = file(USERACCOUNTS);
		for( $i = 0; $i < sizeof($users); $i++ ){
    		$pieces = explode("^", trim($users[$i], "\n") );
			if (  ($uid == $pieces[0]) ){
				// found record, 
				$pieces[4] = "X";
				$users[$i] = implode(INTERNAL_DELIMITER,$pieces);
    		}
		} 
		
		$fh = fopen(USERACCOUNTS, "w");
		for( $j = 0; $j < sizeof($users); $j++ ){
			fwrite($fh, trim($users[$j], "\n") ."\n");
		}
		fclose($fh);	
	}	
	
} // end of function xOverParticipant()


///////////////////////////
function generateUserId($uIdFil)
{

	$uid = "";	

	if (file_exists($uIdFil)){
		// file exists
		$temp = file($uIdFil);
		$uid = (int)$temp[0];
	}else{
		// file does not exist
		global $id_seed;
		$uid = (int)$id_seed;
	}
	// update the id
	$uid++;
	$fh = fopen($uIdFil, "w");
	fwrite($fh, (string)$uid."\n");
	fclose($fh);	
	
	return $uid;
	
} // end of function generateUserId()


function generatePW()
{

	$pw = "";

   $lim = rand(8,10);
   for ($i = 1; $i <= $lim; $i++)
   {
     $pw .= chr(ord('a') + rand(0,25));
   }
  
  	return $pw;

} // end of function generatePW()



function verifyUser($account_name)
{
	if (file_exists(USERACCOUNTS)){
		$lines = file( USERACCOUNTS );

		for( $i = 0; $i < sizeof($lines); $i++ ){
   			$pieces = explode("^", $lines[$i]);
			if ($account_name == $pieces[1]){
        		return  $lines[$i];
    		}
		}	 
	}	
	return "";
} // end of function verifyUser()

function verifyUserII($u_name, $u_pwd)
{
	
	$lines = file( USERACCOUNTS );

	for( $i = 0; $i < sizeof($lines); $i++ ){
    	$pieces = explode("^", $lines[$i]);
		if (  ($u_name == $pieces[1]) &&  ($u_pwd == $pieces[2]) ){
        	return  $lines[$i];
    	}
	} 	
	return "";
} // end of function verifyUserII()

/*
function getUserRecFromUID($userFile, $uid)
{
	
	$lines = file( $userFile );

	for( $i = 0; $i < sizeof($lines); $i++ ){
    	$pieces = explode("^", $lines[$i]);
		if ($uid == $pieces[0]){
        	return  $lines[$i];
    	}
	} 	
	return "";
	
} // end of function getUserRecFromUID()
*/


?>

<?php

/*

this file contains configuration information


*/

//define('HLBASEURL', "http://www.chillipepper.com/hl/");
// define('HLBASEURL', "http://www.carletonhappystudy.org/");
define('HLBASEURL', "http://localhost/hl/");
define('LOGINURL', HLBASEURL."/login.php");


// sessions
define('SESS_0', 0);
define('SESS_1', 1);
define('SESS_2', 2);
define('SESS_3', 3);
define('SESS_4', 4);
define('SESS_5', 5);
define('SESS_6', 6);
define('SESS_7', 7);
define('SESS_8', 8);
define('SESS_9', 9);
define('SESS_10', 10);


define('SESSION_INTERVAL', 3); // days between sessions
// num of days before next session can be done
$sessionInterval[SESS_0] = 0;
$sessionInterval[SESS_1] = 3;
$sessionInterval[SESS_2] = 4;
$sessionInterval[SESS_3] = 3;
$sessionInterval[SESS_4] = 4;
$sessionInterval[SESS_5] = 3;
$sessionInterval[SESS_6] = 4;
$sessionInterval[SESS_7] = 3;
$sessionInterval[SESS_8] = 7;
$sessionInterval[SESS_9] = 180;
$sessionInterval[SESS_10] = 0;

$nr_session = array();
$nr_session[SESS_1] = array("importantInfo", "demog", "PANAS1", "vitality1", "SWLS", "CESD", "PHS", "SHS1", "SHS2","SHS3","SHS4","interconnect1", "interconnect2", "interconnect3", "interconnect4", "interconnect5", "interconnect6","interconnect7","wellBeing", "BFFI", "MAAS", "activity1", "endOfSession" );

$nr_session[SESS_2] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity2", "endOfSession" );
$nr_session[SESS_3] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity3", "endOfSession" );
$nr_session[SESS_4] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity4", "endOfSession" );
$nr_session[SESS_5] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity5", "endOfSession" );
$nr_session[SESS_6] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity6", "endOfSession" );
$nr_session[SESS_7] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity7", "endOfSession" );
$nr_session[SESS_8] = array("PANAS", "vitality", "weather1", "weather2", "time", "activity8", "endOfSession" );

$nr_session[SESS_9] = array("time", "PANAS1", "vitality1", "SWLS", "CESD", "PHS", "SHS1", "SHS2","SHS3","SHS4", "wellBeing", "MAAS", "interconnect1", "interconnect2", "interconnect3", "interconnect4", "interconnect5", "interconnect6", "interconnect7", "naturerelatedness", "envconcern", "ecology", "sustainability", "debrief9", "endOfSession" );

$nr_session[SESS_10] = array("PANAS1", "vitality1", "SWLS", "CESD", "PHS", "SHS1", "SHS2","SHS3","SHS4", "wellBeing", "MAAS", "interconnect1", "interconnect2", "interconnect3", "interconnect4", "interconnect5", "interconnect6","interconnect7", "time", "naturerelatedness", "envconcern", "ecology", "sustainability", "interest", "comments", "debrief9", "endOfSession" );



$nr_session_handlers = array();
$nr_session_handlers["importantInfo"]  = "importantInfo.php";
$nr_session_handlers["surveyIntro"]  = "surveyIntro.php";
$nr_session_handlers["PANAS"]        = "surveyPage.php";
$nr_session_handlers["PANAS1"]        = "surveyPage.php";
$nr_session_handlers["vitality"]     = "surveyPage.php";
$nr_session_handlers["vitality1"]     = "surveyPage.php";
$nr_session_handlers["SWLS"]         = "surveyPage.php";
$nr_session_handlers["CESD"]         = "surveyPage.php";
$nr_session_handlers["interconnect1"] = "surveyPage.php";
$nr_session_handlers["interconnect2"] = "surveyPage.php";
$nr_session_handlers["interconnect3"] = "surveyPage.php";
$nr_session_handlers["interconnect4"] = "surveyPage.php";
$nr_session_handlers["interconnect5"] = "surveyPage.php";
$nr_session_handlers["interconnect6"] = "surveyPage.php";
$nr_session_handlers["interconnect7"] = "surveyPage.php";
$nr_session_handlers["PHS"]          = "surveyPHS.php";   ///////    "surveyCustomSHS.php";
$nr_session_handlers["SHS1"]          = "surveyPage.php";   ///////    "surveyCustomSHS.php";
$nr_session_handlers["SHS2"]          = "surveyPage.php";
$nr_session_handlers["SHS3"]          = "surveyPage.php";
$nr_session_handlers["SHS4"]          = "surveyPage.php";
$nr_session_handlers["wellBeing"]              = "surveyPage.php";
$nr_session_handlers["BFFI"]                   = "surveyPage.php";
$nr_session_handlers["MAAS"]                   = "surveyPage.php";
$nr_session_handlers["demog"]                  = "demog.php";
$nr_session_handlers["weather1"]               = "surveyPage.php";
$nr_session_handlers["weather2"]               = "surveyPage.php";
$nr_session_handlers["time"]                   = "surveyTimeUse.php";
$nr_session_handlers["naturerelatedness"]      = "surveyPage.php";
$nr_session_handlers["envconcern"]             = "surveyPage.php";
$nr_session_handlers["ecology"]                = "surveyPage.php";
$nr_session_handlers["sustainability"]         = "surveyPage.php";
$nr_session_handlers["debrief9"]               = "debriefPage.php";
$nr_session_handlers["activity1"]              = "activity1-8.php";
$nr_session_handlers["activity2"]              = "activity1-8.php";
$nr_session_handlers["activity3"]              = "activity1-8.php";
$nr_session_handlers["activity4"]              = "activity1-8.php";
$nr_session_handlers["activity5"]              = "activity1-8.php";
$nr_session_handlers["activity6"]              = "activity1-8.php";
$nr_session_handlers["activity7"]              = "activity1-8.php";
$nr_session_handlers["activity8"]              = "activity1-8.php";
$nr_session_handlers["interest"]               = "surveyPage.php";
$nr_session_handlers["comments"]               = "activity1-8.php";

$nr_session_handlers["endOfSession"]           = "byebye.php";


define('INTERNAL_DELIMITER', "^");
$internal_delimiter = "^";
$external_delimiter = "\t";


define('ID_SEED', 1011);
 
 
// various file paths
define('USERIDFILE', "hl_data/id.txt");
define('HL_LOGFILE', "./tstLog");


$userAccounts = "hl_subjects/participants.txt";
$userMapping = "hl_subjects/mapping.txt";
define('USERACCOUNTS', "hl_subjects/participants.txt");
define('SESSIONTRACKER', "hl_subjects/sessiontracker.txt");
define('SIXMONTHTRACKER', "hl_subjects/sixmonth.txt");
define('DEMOGRAFIKS', "surveys/demografiks.txt");
define('SESSIONFILE', "surveys/session");


define('MAIL_FROMNAME',  'researcher@carletonhappystudy.org');




?>


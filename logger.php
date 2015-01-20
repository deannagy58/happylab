<?php

  // can pass anything back...

  

  

/////////////////////   require_once "json/JSON.php";


$filename = "tstLog";
 
function logToFile($filename, $msg)
{ 
   // open file
   $fd = fopen($filename, "a");
   // append date/time to message
   $str = "[" . date("Y/m/d h:i:s", mktime()) . "] " . $msg; 
   // write string
   fwrite($fd, $str . "\n");
   // close file
   fclose($fd);
}

 function myErrorHandler($errno, $errstr, $errfile, $errline)
 { 
    switch ($errno) {
    case E_USER_ERROR:
        echo "<b>My ERROR</b> [$errno] $errstr<br />\n";
        echo "  Fatal error on line $errline in file $errfile";
        echo ", PHP " . PHP_VERSION . " (" . PHP_OS . ")<br />\n";
        echo "Aborting...<br />\n";
        exit(1);
        break;

    case E_USER_WARNING:
        echo "<b>My WARNING</b> [$errno] $errstr<br />\n";
        break;

    case E_USER_NOTICE:
        echo "<b>My NOTICE</b> [$errno] $errstr<br />\n";
        break;

    default:
        echo "Unknown error type: [$errfile : $errline] $errstr<br />\n";
        break;
    }
	die();
    /* Don't execute PHP internal error handler */
    return true;
}



$old_error_handler = set_error_handler("myErrorHandler");
?>


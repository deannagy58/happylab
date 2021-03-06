<?php

// start the session - MUST have this or will not work. 

session_start(); 

/////phpinfo();

 //////////  phpinfo(INFO_VARIABLES);  // gives post/get and for variables
//print_r($_SESSION);


require_once "hl_config.php";
require_once "func.makeTables.php";
require_once "logger.php";
require_once "fileManager.php";
require_once "text/surveyText.php";
require_once "general.php";

$nextPhase = "var dna=0;";

$cur_sess_sub_task = $nr_session_handlers[$nr_session[$_SESSION['current_session']][$_SESSION['task_idx']]];

// which "page" being processed
$form_name = $nr_session[$_SESSION['current_session']][$_SESSION['task_idx']];

if( isset($_REQUEST['submitState']) ){
	// a submission
	addResponse2Session($_SESSION['uid'], $form_name, $myQuestions);
     $t_idx = $_SESSION['task_idx'];
     if ( ($t_idx+1) < count($nr_session[$_SESSION['current_session']]) ){
    	if ($nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx]]
    					!= 
    		$nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx+1]]){
    		$byeMsg = "";	
    		if( ($t_idx+1) == count($nr_session[$_SESSION['current_session']]) -1  ){
    			$byeMsg = "?reqMsg=endOSession";	
			}
    		//this "page and next page handler are different, means change page processor
    		$nextPhase = 'window.location="' . HLBASEURL . $nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx+1]] . $byeMsg . '"';
 		}
	}

    $_SESSION['task_idx'] = $_SESSION['task_idx'] +1;
  
}
$form_name = $nr_session[$_SESSION['current_session']][$_SESSION['task_idx']];

if ("var dna=0;" == $nextPhase){
	$simple_table = simpleSurvey($form_name, 
   							$myQuestions[$form_name]['qs'] , 
   							$myQuestions[$form_name]['cols'], 
   							"coll");  
}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>hl: page 1 -  v 0.01</title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="coreClientFuncs.js"></script>
	<script type="text/javascript" src="myAjax.js"></script>
	<script type="text/javascript" src="common.js"></script>  
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>



<script type="text/javascript">
<?php  echo $nextPhase;  ?>; 

function submitForm()
{
	document.<?php echo $form_name ?>.submit();
}

  
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
		 	<span class="pageTitle"><?php echo $myQuestions[$form_name]['title']  ?> </span>
		    <img src="img/banner.jpg" >  
		 </div>
		 <!-- End Header -->
	
		 <!-- Begin middle row -->
		 <div id="hl_middle">
		 <div style="float:right">survey <?php echo $_SESSION['task_idx'] +1 ?> of <?php echo count($nr_session[$_SESSION['current_session']]) -1 ?></div>
			<?php
				if ($myQuestions[$form_name]['pre'] != null){
					echo $myQuestions[$form_name]['pre'];
				}
			?>

			<form name="<?php  echo $form_name ?>" method="post" action="<?php  echo $cur_sess_sub_task ?>">
				<input type="hidden" name="submitState" value="1" size="3" />
 				<?php  echo $simple_table;  ?>
			</form>	
			
			
			<?php
				if ($myQuestions[$form_name]['post'] != null){
					echo $myQuestions[$form_name]['post'];
				}
			?>

			<span class="chevron"><br />>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="submitForm();"> Continue </span> 
			<br /><br />
	     </div>
		 <!-- End middle row -->
		 
		 <!-- Begin Footer -->
		 <div id="hl_footer">
		       <div id="footer"><p>&copy; 2008 Carleton University | 1125 Colonel By Drive, Ottawa, ON, Canada K1S 5B6 | <a href="#" onclick="return contactInfo()">Contact</a> the researchers</p></div>
	     </div>                                                                                                                                 
		 <!-- End Footer -->
		 
   </div>

   <!-- End Wrapper -->

</body>

</html>





  


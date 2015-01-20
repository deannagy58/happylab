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

//$simple_table = simpleSurvey($form_name, 
//   							$myQuestions[$form_name]['qs'] , 
//   							$myQuestions[$form_name]['cols'], 
//   							"coll");  


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="coreClientFuncs.js"></script>
	<script type="text/javascript" src="myAjax.js"></script>
	<script type="text/javascript" src="common.js"></script>  
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>



<script type="text/javascript">
<?php  echo $nextPhase;  ?>; 



function checknumber(strNum){
	var anum=/(^\d+$)|(^\d+\.\d+$)/
	if (anum.test(strNum)){
		testresult=true
	}else{
		testresult=false
	}
	return (testresult)
}


function submitThisForm()
{

	document.<?php echo $form_name ?>.submit();

}

  


</script>

<!--  START HTML HERE   -->

<body id="home" >

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
  				<center>
 				<table id="PHS" border="0" >
 					<tr><td></td><td><strong>number of hours</strong></td></tr>
 					<tr><td >Shopping</td><td align=center><input name="q_1" id="1_1" value=""  type="text" maxlength="3" size="4"></td></tr>
  					<tr><td >at a restaurant</td><td align=center><input name="q_2" id="2_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >listening to music</td><td align=center><input name="q_3" id="3_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >at a gym or fitness facility</td><td align=center><input name="q_4" id="4_1" value=""  type="text" maxlength="3" size="4"></td></tr>
  					<tr><td >on a walk, hike or activity in nature</td><td align=center><input name="q_5" id="5_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >visiting friends</td><td align=center><input name="q_6" id="6_1" value=""  type="text" maxlength="3" size="4"></td></tr>
					<tr><td >watching television</td><td align=center><input name="q_7" id="7_1" value=""  type="text" maxlength="3" size="4"></td></tr>
  					<tr><td >doing housework</td><td align=center><input name="q_8" id="8_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >commuting to work/school</td><td align=center><input name="q_9" id="9_1" value=""  type="text" maxlength="3" size="4"></td></tr>
					<tr><td >talking on the phone</td><td align=center><input name="q_10" id="10_1" value=""  type="text" maxlength="3" size="4"></td></tr>
  					<tr><td >taking care of children</td><td align=center><input name="q_11" id="11_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >sending e-mail/surfing the internet</td><td align=center><input name="q_12" id="12_1" value=""  type="text" maxlength="3" size="4"></td></tr>
					<tr><td >Eating</td><td align=center><input name="q_13" id="13_1" value=""  type="text" maxlength="3" size="4"></td></tr>
  					<tr><td >Sleeping</td><td align=center><input name="q_14" id="14_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 					<tr><td >Relaxing</td><td align=center><input name="q_15" id="15_1" value=""  type="text" maxlength="3" size="4"></td></tr>
 
 				</table>
 				</center>
 				
			</form>	
			
			
			<?php
				if ($myQuestions[$form_name]['post'] != null){
					echo $myQuestions[$form_name]['post'];
				}
			?>

			<span class="chevron"><br />>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="submitThisForm();"> Continue </span> 
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





  


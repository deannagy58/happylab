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

$simple_table = simpleSurvey($form_name, 
   							$myQuestions[$form_name]['qs'] , 
   							$myQuestions[$form_name]['cols'], 
   							"coll");  


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
		 	<span class="pageTitle">SHS </span>
		    <img src="img/banner.jpg">  
		 </div>
		 <!-- End Header -->
	
		 <!-- Begin middle row -->
		 <div id="hl_middle">

			<p><br>Please respond to each of the following statements by indicating the degree to which the statement is true for you in general in your life.  Use the following scale:</p>
			<form name="vitality" method="post" action="surveyPage.php">
				<input name="submitState" value="1" size="3" type="hidden">
 				<table id="vitality" class="coll" border="0">
<tbody><tr><th class="thdr"> </th>
<th class="thdr">not very<br />not at all</th>
<th class="thdr"></th>
<th class="thdr"></th>
<th class="thdr">somewhat true</th>

<th class="thdr"></th>
<th class="thdr"></th>
<th class="thdr">very true</th>
</tr><tr id="t1" class="trOdd" onmouseover="mOver('t1')" onmouseout="mOut('t1', 'trOdd')"> <td class="tdQuestion">I feel alive and vital</td>
<td class="tdCell" onclick='mClick("1_1")'><input name="q_1" id="1_1" value="1" onclick='mClick("1_1")' type="radio"></td><td class="tdCell" onclick='mClick("1_2")'><input name="q_1" id="1_2" value="2" onclick='mClick("1_2")' type="radio"></td><td class="tdCell" onclick='mClick("1_3")'><input name="q_1" id="1_3" value="3" onclick='mClick("1_3")' type="radio"></td><td class="tdCell" onclick='mClick("1_4")'><input name="q_1" id="1_4" value="4" onclick='mClick("1_4")' type="radio"></td><td class="tdCell" onclick='mClick("1_5")'><input name="q_1" id="1_5" value="5" onclick='mClick("1_5")' type="radio"></td><td class="tdCell" onclick='mClick("1_6")'><input name="q_1" id="1_6" value="6" onclick='mClick("1_6")' type="radio"></td><td class="tdCell" onclick='mClick("1_7")'><input name="q_1" id="1_7" value="7" onclick='mClick("1_7")' type="radio"></td></tr>
<tr id="t2" class="trEven" onmouseover="mOver('t2')" onmouseout="mOut('t2', 'trEven')"> <td class="tdQuestion">Sometimes I feel so alive I just want to burst</td>
<td class="tdCell" onclick='mClick("2_1")'><input name="q_2" id="2_1" value="1" onclick='mClick("2_1")' type="radio"></td><td class="tdCell" onclick='mClick("2_2")'><input name="q_2" id="2_2" value="2" onclick='mClick("2_2")' type="radio"></td><td class="tdCell" onclick='mClick("2_3")'><input name="q_2" id="2_3" value="3" onclick='mClick("2_3")' type="radio"></td><td class="tdCell" onclick='mClick("2_4")'><input name="q_2" id="2_4" value="4" onclick='mClick("2_4")' type="radio"></td><td class="tdCell" onclick='mClick("2_5")'><input name="q_2" id="2_5" value="5" onclick='mClick("2_5")' type="radio"></td><td class="tdCell" onclick='mClick("2_6")'><input name="q_2" id="2_6" value="6" onclick='mClick("2_6")' type="radio"></td><td class="tdCell" onclick='mClick("2_7")'><input name="q_2" id="2_7" value="7" onclick='mClick("2_7")' type="radio"></td></tr>
<tr id="t3" class="trOdd" onmouseover="mOver('t3')" onmouseout="mOut('t3', 'trOdd')"> <td class="tdQuestion">I have energy and spirit</td>
<td class="tdCell" onclick='mClick("3_1")'><input name="q_3" id="3_1" value="1" onclick='mClick("3_1")' type="radio"></td><td class="tdCell" onclick='mClick("3_2")'><input name="q_3" id="3_2" value="2" onclick='mClick("3_2")' type="radio"></td><td class="tdCell" onclick='mClick("3_3")'><input name="q_3" id="3_3" value="3" onclick='mClick("3_3")' type="radio"></td><td class="tdCell" onclick='mClick("3_4")'><input name="q_3" id="3_4" value="4" onclick='mClick("3_4")' type="radio"></td><td class="tdCell" onclick='mClick("3_5")'><input name="q_3" id="3_5" value="5" onclick='mClick("3_5")' type="radio"></td><td class="tdCell" onclick='mClick("3_6")'><input name="q_3" id="3_6" value="6" onclick='mClick("3_6")' type="radio"></td><td class="tdCell" onclick='mClick("3_7")'><input name="q_3" id="3_7" value="7" onclick='mClick("3_7")' type="radio"></td></tr>
<tr id="t4" class="trEven" onmouseover="mOver('t4')" onmouseout="mOut('t4', 'trEven')"> <td class="tdQuestion">I look forward to each new day</td>

<td class="tdCell" onclick='mClick("4_1")'><input name="q_4" id="4_1" value="1" onclick='mClick("4_1")' type="radio"></td><td class="tdCell" onclick='mClick("4_2")'><input name="q_4" id="4_2" value="2" onclick='mClick("4_2")' type="radio"></td><td class="tdCell" onclick='mClick("4_3")'><input name="q_4" id="4_3" value="3" onclick='mClick("4_3")' type="radio"></td><td class="tdCell" onclick='mClick("4_4")'><input name="q_4" id="4_4" value="4" onclick='mClick("4_4")' type="radio"></td><td class="tdCell" onclick='mClick("4_5")'><input name="q_4" id="4_5" value="5" onclick='mClick("4_5")' type="radio"></td><td class="tdCell" onclick='mClick("4_6")'><input name="q_4" id="4_6" value="6" onclick='mClick("4_6")' type="radio"></td><td class="tdCell" onclick='mClick("4_7")'><input name="q_4" id="4_7" value="7" onclick='mClick("4_7")' type="radio"></td></tr>
<tr id="t5" class="trOdd" onmouseover="mOver('t5')" onmouseout="mOut('t5', 'trOdd')"> <td class="tdQuestion">I nearly always feel alert and awake</td>
<td class="tdCell" onclick='mClick("5_1")'><input name="q_5" id="5_1" value="1" onclick='mClick("5_1")' type="radio"></td><td class="tdCell" onclick='mClick("5_2")'><input name="q_5" id="5_2" value="2" onclick='mClick("5_2")' type="radio"></td><td class="tdCell" onclick='mClick("5_3")'><input name="q_5" id="5_3" value="3" onclick='mClick("5_3")' type="radio"></td><td class="tdCell" onclick='mClick("5_4")'><input name="q_5" id="5_4" value="4" onclick='mClick("5_4")' type="radio"></td><td class="tdCell" onclick='mClick("5_5")'><input name="q_5" id="5_5" value="5" onclick='mClick("5_5")' type="radio"></td><td class="tdCell" onclick='mClick("5_6")'><input name="q_5" id="5_6" value="6" onclick='mClick("5_6")' type="radio"></td><td class="tdCell" onclick='mClick("5_7")'><input name="q_5" id="5_7" value="7" onclick='mClick("5_7")' type="radio"></td></tr>
<tr id="t6" class="trEven" onmouseover="mOver('t6')" onmouseout="mOut('t6', 'trEven')"> <td class="tdQuestion">Some people are generally not very happy. Although they are not depressed, they never seem as happy as they might be. To what extent does this characterization describe you?</td>
<td class="tdCell" onclick='mClick("6_1")'><input name="q_6" id="6_1" value="1" onclick='mClick("6_1")' type="radio"></td><td class="tdCell" onclick='mClick("6_2")'><input name="q_6" id="6_2" value="2" onclick='mClick("6_2")' type="radio"></td><td class="tdCell" onclick='mClick("6_3")'><input name="q_6" id="6_3" value="3" onclick='mClick("6_3")' type="radio"></td><td class="tdCell" onclick='mClick("6_4")'><input name="q_6" id="6_4" value="4" onclick='mClick("6_4")' type="radio"></td><td class="tdCell" onclick='mClick("6_5")'><input name="q_6" id="6_5" value="5" onclick='mClick("6_5")' type="radio"></td><td class="tdCell" onclick='mClick("6_6")'><input name="q_6" id="6_6" value="6" onclick='mClick("6_6")' type="radio"></td><td class="tdCell" onclick='mClick("6_7")'><input name="q_6" id="6_7" value="7" onclick='mClick("6_7")' type="radio"></td></tr>
</tbody></table>
			</form>	
			
			
			
			<span class="chevron"><br>&gt;&gt;</span><span style="cursor: pointer; color: black; font-weight: bold;" onclick="submitForm();"> Continue </span> 
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





  


<?php

// start the session - MUST have this or will not work. 

session_start(); 

/////phpinfo();

 ////// phpinfo(INFO_VARIABLES);  // gives post/get and for variables
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


var startTimer = false;


function checknumber(x){
/////////////var x=document.checknum.pnum.value
	var anum=/(^\d+$)|(^\d+\.\d+$)/
	if (anum.test(x))
		testresult=true
	else{
		///////alert("Please input a valid number!")
		testresult=false
	}
return (testresult)
}



maxKeys = 50;
var IE = (document.all) ? 1 : 0;
var DOM = 0; 
if (parseInt(navigator.appVersion) >=5) {DOM=1};

function txtshow( txt2show ) {
	// Detect Browser
    if (DOM) {
		var viewer = document.getElementById("txtmsg");
        viewer.innerHTML=txt2show;
    }
    else if(IE) {
        document.all["txtmsg"].innerHTML=txt2show;
    }
}

function keyup(what) 
{
//	alert(what.value);
	checknumber(what.value);
  var str = new String(what.value);
  var len = str.length;
  var showstr = len + " characters of " + maxKeys + " entered";
  if (len > maxKeys) showstr += '<br>Some information will be lost, please revise your entry';
 /////////////// txtshow( showstr );
  if (!startTimer){
  	countDown();
  	startTimer = true;
  }
}





var sec = 00;   // set the seconds
var min = 20;   // set the minutes

function countDown() {
   	sec--;
	if (sec == -01) {
   		sec = 59;
   		min = min - 1; 
   	}else{
   		min = min; 
   	}

	if (sec<=9){
		sec = "0" + sec; 
	}

  	time = (min<=9 ? "0" + min : min) + ":" + sec + " sec ";

	if (document.getElementById){
		 document.getElementById('theTime').innerHTML = time; 
	}

	SD=window.setTimeout("countDown();", 1000);
	if (min == '00' && sec == '00'){
		 sec = "00"; 
		 window.clearTimeout(SD); 
		 var textArea = document.getElementById('1_1').value;
		 document.forms[0].q_1.readOnly = "true";
		 alert("times up");
		 
	}
}  // end of countDown()  


</script>

<!--  START HTML HERE   -->

<body id="home" >

 <!-- Begin Wrapper -->
   <div id="hl_wrapper">
   
         <!-- Begin Header -->
         <div id="hl_header">

		 	<img src="img/logo.jpg" alt="Carleton University">
		 	<span class="pageTitle"><?php echo $myQuestions[$form_name]['title']  ?> </span>
		    <!-- <img src="img/banner.jpg" >   -->
		 </div>
		 <!-- End Header -->
		 <!-- Begin Left Column -->
		 <div id="hl_leftcolumn">
		 	
		 	<?php
			
			if ("CC" == $_SESSION['grp']){
				if ($myQuestions[$form_name]['imgcc'] != null){
					echo $myQuestions[$form_name]['imgcc'];
				}
			}
			if ("NR" == $_SESSION['grp']){
				if ($myQuestions[$form_name]['imgnr'] != null){
					echo $myQuestions[$form_name]['imgnr'];
				}
			}
			?>
		 	
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="hl_rightcolumn">
		 
			<?php
				
				
				if ("CC" == $_SESSION['grp']){
					if ($myQuestions[$form_name]['preCC'] != null){
						echo $myQuestions[$form_name]['preCC'];
					}
				}
				if ("NR" == $_SESSION['grp']){
					if ($myQuestions[$form_name]['preNR'] != null){
						echo $myQuestions[$form_name]['preNR'];
					}
				}
				
			?>

			<form name="<?php  echo $form_name ?>" method="post" action="<?php  echo $cur_sess_sub_task ?>">
				<input type="hidden" name="submitState" value="1" size="3" />
  <!-- 				<table width="100%">
 					<tr><td width="100%" align="center"><span id="theTime" class="timeClass"></span></td></tr>
				</table>
 				<textarea id="1_1" name="q_1" cols="50" rows="10" onkeyup="keyup(this)"></textarea>
 -->
 				<?php
					echo $myQuestions[$form_name]['qs'];
				?>
 	
			</form>	
			<!-- <div id="txtmsg">3 characters of 50 entered</div> -->
			
			<?php
				//if ($myQuestions[$form_name]['post'] != null){
				//	echo $myQuestions[$form_name]['post'];
				//}
			?>

			<span class="chevron"><br />>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="submitThisForm();"> Continue </span> 
			<br /><br />
	     </div>
		 <!-- End Right Column -->
		 
		 <!-- Begin Footer -->
		 <div id="hl_footer">
		       <div id="footer"><p>&copy; 2008 Carleton University | 1125 Colonel By Drive, Ottawa, ON, Canada K1S 5B6 | <a href="#" onclick="return contactInfo()">Contact</a> the researchers</p></div>
	     </div>                                                                                                                                 
		 <!-- End Footer -->
		 
   </div>

   <!-- End Wrapper -->

</body>

</html>





  


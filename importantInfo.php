<?php

 session_start(); 
print_r($_SESSION);

require_once "hl_config.php"; 
require_once "logger.php";
require_once "general.php";
////////////phpinfo();
require_once "text/generalText.php";


$form_name = 'importantInfo';

$nextPhase = "var dna=0;";

$cur_sess_sub_task = $nr_session_handlers[$nr_session[$_SESSION['current_session']][$_SESSION['task_idx']]];

// which "page" being processed
$form_name = $nr_session[$_SESSION['current_session']][$_SESSION['task_idx']];


if(isset($_REQUEST['submitState'])){
    $t_idx = $_SESSION['task_idx'];
 
    if ( ($t_idx+1) < count($nr_session[$_SESSION['current_session']]) ){
    	if ($nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx]]
    					!= 
    		$nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx+1]]){
    		//this "page and next page handler are different, means change page processor
    		$nextPhase = 'window.location="' . HLBASEURL . $nr_session_handlers[$nr_session[$_SESSION['current_session']][$t_idx+1]] . '"';
		}
	}
    $_SESSION['task_idx'] = $_SESSION['task_idx'] +1;
  
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="myAjax.js"></script>
 	<script type="text/javascript" src="common.js"></script>
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>


<script type="text/javascript">

function setInit(){

	// empty

}  // end of setInit()

<?php  echo $nextPhase;  ?>; 


function submitForm()
{
	document.<?php echo $form_name ?>.submit();
}



</script>

<!--  START HTML HERE   -->

<body  onLoad='setInit()'>
	<form name="<?php  echo $form_name ?>" method="post" action="<?php  echo $cur_sess_sub_task ?>"> 
		<input type="hidden" name="submitState" value="1" size="3" />
	</form>	


   <!-- Begin Wrapper -->
   <div id="hl_wrapper">
   
         <!-- Begin Header -->
         <div id="hl_header">

		 	<img src="img/logo.jpg" alt="Carleton University">
		 	<span class="pageTitle"><?php echo $generalText[$form_name]['title']  ?> </span>
		    <img src="img/banner.jpg" >  
		 </div>
		 <!-- End Header -->
		 
		 <!-- Begin Left Column -->
		 <div id="hl_leftcolumn">
		 
		       <!-- Left Column  -->
		 
		 </div>
		 <!-- End Left Column -->
		 
		 <!-- Begin Right Column -->
		 <div id="hl_rightcolumn">
			<?php
				if ($generalText[$form_name]['pre'] != null){
					echo $generalText[$form_name]['pre'];
				}
			?>
 			
			<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="submitForm();"> Begin surveys</span> 
		 <br /><br />
		 <!--  TEST START   -->
		 
		 		
		 <!--  TEST END     -->
	      </div>
		 <!-- End Right Column -->
		 
		 <!-- Begin Footer -->
		 <div id="hl_footer">
		       <div id="footer"><p>&copy; 2008 Carleton University | 1125 Colonel By Drive, Ottawa, ON, Canada K1S 5B6 | <a href="#" onclick="return contactInfo()">Contact</a> the researchers</p></div>
	     </div>                                                                                                                                 
		 <!-- End Footer -->
		 
   </div>

   <!-- End Wrapper -->
   
</body></html>





  


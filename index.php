<?php
 //session_start(); 
 //   print_r($_SESSION);

require_once "logger.php";
require_once "general.php";
require_once "text/generalText.php";
require_once "hl_config.php";

require_once "text/text.php";

$form_name = 'welcome';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	
<head>
	<title>Welcome </title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
	<meta name="generator" content="HAPedit 3.1">
 	<script type="text/javascript" src="common.js"></script>  
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>

<script type="text/javascript">

function joinSubmit()
{
	var e_adr = document.getElementById('emailAdr').value;
	if (0 == e_adr.length ){
		alert("Please enter your email address.");
	}else{
		//var cuid=prompt("If you are a Carleton University student you can get 2% credit for participating.\n\n" +
		//                 "Enter your Carleton student number",
		//                 "");
		//if (cuid!=null && cuid!="")
  		//{
  		//	document.getElementById('CUId').value = cuid;
  		//}
		
		document.joinFrm.submit();
	}

}  // end of setInit()


</script>


<body >

<!--    NEW LAYOUT  START    -->

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
			
<!--			<p onclick="toggleDiv('agree');" style="cursor:pointer;">If you are currently a student at Carleton University, enrolled in PSYC1001 or PSYC1002, please <strong>click here</strong></p> -->
	
			<div id="agree" class="message">
				<?php
				if ($generalText[$form_name]['mid'] != null){
					echo $generalText[$form_name]['mid'];
				}
			?>
				<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="toggleDiv('agree');"> Close</span> 
			</div> 
			
			<p onclick="toggleDiv('notstud');" style="cursor:pointer;">Please <strong>click here</strong> for information about the survey participation incentive.</p>
	
			<div id="notstud" class="message">
				<?php
					if ($generalText[$form_name]['mid2'] != null){
						echo $generalText[$form_name]['mid2'];
					}
				?>
				<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="toggleDiv('notstud');"> Close</span> 
			</div> 
            <div>
				<form name="joinFrm" method="post" action="byebye.php"> 
					<input type="hidden" name="joinsurvey" value="myemail" size="20" />
					<input type="hidden" name="reqMsg" value="registration" size="20" />
 					<input type="hidden" name="CUId" id="CUId" value="" size="20" />
 					<br />
 					&nbsp;&nbsp;&nbsp;Email address: <input id="emailAdr" name="emailAdr" type="text"  style="background-color: white;"/><span style="color:red;" >*</span>
 					<br />
					<span style="color:red;	font-style: oblique;sfont-size: 10px;" >(* IMPORTANT: you will be emailed a password and link to begin the survey. Please check that this and other study reminder emails aren't lost in your junk folder.)</span>
					<br />
					<!-- new code start -->
					 <p><br />Please enter your Carleton Connect email address (as this study is not part
                          of the Carleton SONA system, your connect/portal email is the only way we
                           are able to know you are in the study to assign you credit)</p>
           			&nbsp;&nbsp;&nbsp;<input id="cuemailAdr" name="cuemailAdr" type="text"  size="8" maxlength="8" style="background-color: white;"/>@connect.carleton.ca
					<!-- new code end -->
 				</form>	
 				</div>
  			<?php
				if ($generalText[$form_name]['post'] != null){
					echo $generalText[$form_name]['post'];
				}
			?>
				<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="joinSubmit();">I AGREE </span> 
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


<!--    NEW LAYOUT  END    -->


</body>
</html>




  


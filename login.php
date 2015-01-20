<?php

////////////phpinfo();
require_once "text/generalText.php";


$form_name = 'login';

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script type="text/javascript" src="myAjax.js"></script>
	<script type="text/javascript" src="common.js"></script>
	<LINK href="ttApp.css" type="text/css" rel="stylesheet"> 
</head>


<script type="text/javascript">

function setInit(){

	// empty

}  // end of setInit()


function login(){
   makeRequest('msgHandler.php', resp2Login, 
   				"action=ttloginreq"+"&uname="+document.getElementById('usr').value+
   				"&upw="+document.getElementById('pwd').value);   
} // end of login()


function resp2Login(text){

	alert("respLogin response: "+document.URL+"\n"+text);

  	var the_object = eval("(" + text + ")");
   	var iStatus = the_object.status;
  	var uGoTo = the_object['goto'];   
  	
   	window.location.href = uGoTo;

 } // end of respLogin()

</script>

<!--  START HTML HERE   -->

<body  onLoad='setInit()'>


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
       		  <div >  Email address:&nbsp;
           	<input id="usr" type="text"  style="background-color: white;"/> 
          	</div>  
				<br />
         	  <div >  Password:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
           	<input id="pwd" type="text"  style="background-color: white;"/> 
         	 </div> 

			<!-- <input type="button" value= "login" name="login" onclick="login();"> -->
			<br />
			<!-- <p onclick="login();"> >> Loggin </p> -->
			<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="login();"> Login</span> 
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





  


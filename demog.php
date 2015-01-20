<?php

 session_start(); 
 
 //  print_r($_SESSION);
////phpinfo(INFO_VARIABLES);

require_once "hl_config.php"; 
require_once "logger.php";
require_once "general.php";
require_once "text/generalText.php";

//   $form_name = 'demog';

$nextPhase = "var dna=0;";

$cur_sess_sub_task = $nr_session_handlers[$nr_session[$_SESSION['current_session']][$_SESSION['task_idx']]];

// which "page" being processed
$form_name = $nr_session[$_SESSION['current_session']][$_SESSION['task_idx']];
$form_name = 'demog';

if(isset($_REQUEST['submitState'])){
    $t_idx = $_SESSION['task_idx'];
	writeDemogInfo($_SESSION['uid']);
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
	<title>"Mindful Awarness and Happiness";</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
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



</script>

<body>

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

<!--<form name="demographic" action="http://surveyshare.com/" method="get"> -->
	<form name="<?php  echo $form_name ?>" method="post" action="<?php  echo $cur_sess_sub_task ?>"> 
		<input type="hidden" name="submitState" value="1" size="3" />




<table border="0" cellpadding="5" cellspacing="6">

<tbody><tr>
<td valign="middle">
Please tell us a bit about yourself... <br><br>
<b> Are you Male or Female?</b><br>
<input name="sex" value="Male" type="radio"> Male<br>

<input name="sex" value="Female" type="radio"> Female<br>
<br />
</td>
</tr><tr>


<td valign="middle">
<b> Age:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input name="age" value="" size="3" type="text"><br>
<br />
</td>
</tr>

<tr>
<td valign="middle">

<b> Ethnicity:</b> <input name="Ethnicity" value="" size="20" type="text"><br>
<br />
</td>
</tr>

<tr>
<td valign="middle">

<b> What is your educational experience</b><br>
<input name="education" value="some high school" type="radio"> some high school<br>
<input name="education" value="completed high school" type="radio"> completed high school<br>

<input name="education" value="completed college degree" type="radio"> completed college degree<br>
<input name="education" value="trade" type="radio"> completed trade or apprenticeship training<br>
<input name="education" value="some uni" type="radio"> some university<br>
<input name="education" value="undergraduate" type="radio"> completed undergraduate degree<br>
<input name="education" value="master" type="radio"> completed master's degree<br>
<input name="education" value="PhD" type="radio"> completed PhD<br>
<br />
</td>
</tr><tr>



<td valign="middle">

<b> Where did you spend the most time while growing up?</b><br>
<input name="growup" value="grow  city center" type="radio"> city center<br>
<input name="growup" value="grow  city suburbs" type="radio"> city suburbs<br>
<input name="growup" value="grow  small town" type="radio"> small town<br>
<input name="growup" value="grow  rural or farm" type="radio"> rural or farm<br>
<input name="growup" value="grow  other" type="radio"> Other: <input name="grow other" value="" size="40" type="text"><br>
<br />
</td>
</tr><tr>

<td valign="middle">

<b> Where do you live now?</b><br>
<input name="live" value="now city center" type="radio"> city center<br>
<input name="live" value="now city suburbs" type="radio"> city suburbs<br>
<input name="live" value="now small town" type="radio"> small town<br>
<input name="live" value="now rural or farm" type="radio"> rural or farm<br>
<input name="live" value="now other" type="radio"> Other: <input name="now other" value="" size="40" type="text"><br>
<br />
</td>
</tr><tr>


<td valign="middle">

<b> What type of building do you currently live in?</b><br>
<input name="building" value="apartment" type="radio"> apartment or condo<br>
<input name="building" value="townhouse" type="radio"> duplex or townhouse<br>
<input name="building" value="detached" type="radio"> detached house<br>
<input name="building" value="building other" type="radio"> Other: <input name="otherbuilding" value="" size="40" type="text"><br>
<br />
</td>
</tr><tr>


<tr>
<td valign="middle">


<b> What country do you currently live in?</b><br>
<select name="country" size="1">
<option>Afghanistan</option><option>Åland Islands</option><option>Albania</option><option>Algeria</option><option>American Samoa</option><option>Andorra</option><option>Angola</option><option>Anguilla</option><option>Antarctica</option><option>Antigua and Barbuda</option><option>Argentina</option><option>Armenia</option><option>Aruba</option><option >Australia</option><option>Austria</option><option>Azerbaijan</option><option>Bahamas</option><option>Bahrain</option><option>Bangladesh</option><option>Barbados</option><option>Belarus</option><option>Belgium</option><option>Belize</option><option>Benin</option><option>Bermuda</option><option>Bhutan</option><option>Bolivia</option><option>Bosnia and Herzegovina</option><option>Botswana</option>

<option>Bouvet Island</option><option>Brazil</option><option>British Indian Ocean territory</option><option>Brunei Darussalam</option><option>Bulgaria</option><option>Burkina Faso</option><option>Burundi</option><option>Cambodia</option><option>Cameroon</option><option selected="selected">Canada</option><option>Cape Verde</option><option>Cayman Islands</option><option>Central African Republic</option><option>Chad</option><option>Chile</option><option>China</option><option>Christmas Island</option><option>Cocos (Keeling) Islands</option><option>Colombia</option><option>Comoros</option><option>Congo</option><option>Congo, Democratic Republic</option><option>Cook Islands</option><option>Costa Rica</option><option>Côte d'Ivoire (Ivory Coast)</option><option>Croatia (Hrvatska)</option><option>Cuba</option><option>Cyprus</option>

<option>Czech Republic</option><option>Denmark</option><option>Djibouti</option><option>Dominica</option><option>Dominican Republic</option><option>East Timor</option><option>Ecuador</option><option>Egypt</option><option>El Salvador</option><option>Equatorial Guinea</option><option>Eritrea</option><option>Estonia</option><option>Ethiopia</option><option>Falkland Islands</option><option>Faroe Islands</option><option>Fiji</option><option>Finland</option><option>France</option><option>French Guiana</option><option>French Polynesia</option><option>French Southern Territories</option><option>Gabon</option><option>Gambia</option><option>Georgia</option><option>Germany</option><option>Ghana</option><option>Gibraltar</option><option>Greece</option><option>Greenland</option>

<option>Grenada</option><option>Guadeloupe</option><option>Guam</option><option>Guatemala</option><option>Guinea</option><option>Guinea-Bissau</option><option>Guyana</option><option>Haiti</option><option>Heard and McDonald Islands</option><option>Honduras</option><option>Hong Kong</option><option >Hungary</option><option>Iceland</option><option>India</option><option>Indonesia</option><!-- copyright Felgall Pty Ltd --><option>Iran</option><option>Iraq</option><option>Ireland</option><option>Israel</option><option>Italy</option><option>Jamaica</option><option>Japan</option><option>Jordan</option><option>Kazakhstan</option><option>Kenya</option><option>Kiribati</option><option>Korea (north)</option><option>Korea (south)</option><option>Kuwait</option><option>Kyrgyzstan</option>

<option>Lao People's Democratic Republic</option><option>Latvia</option><option>Lebanon</option><option>Lesotho</option><option>Liberia</option><option>Libyan Arab Jamahiriya</option><option>Liechtenstein</option><option>Lithuania</option><option>Luxembourg</option><option>Macao</option><option>Macedonia, Former Yugoslav Republic Of</option><option>Madagascar</option><option>Malawi</option><option>Malaysia</option><option>Maldives</option><option>Mali</option><option>Malta</option><option>Marshall Islands</option><option>Martinique</option><option>Mauritania</option><option>Mauritius</option><option>Mayotte</option><option>Mexico</option><option>Micronesia</option><option>Moldova</option><option>Monaco</option><option>Mongolia</option><option>Montserrat</option><option>Morocco</option><option>Mozambique</option><option>Myanmar</option><option>Namibia</option>

<option>Nauru</option><option>Nepal</option><option>Netherlands</option><option>Netherlands Antilles</option><option>New Caledonia</option><option>New Zealand</option><option>Nicaragua</option><option>Niger</option><option>Nigeria</option><option>Niue</option><option>Norfolk Island</option><option>Northern Mariana Islands</option><option>Norway</option><option>Oman</option><option>Pakistan</option><option>Palau</option><option>Palestinian Territories</option><option>Panama</option><option>Papua New Guinea</option><option>Paraguay</option><option>Peru</option><option>Philippines</option><option>Pitcairn</option><option>Poland</option><option>Portugal</option><option>Puerto Rico</option><option>Qatar</option><option>Réunion</option><option>Romania</option><option>Russian Federation</option>

<option>Rwanda</option><option>Saint Helena</option><option>Saint Kitts and Nevis</option><option>Saint Lucia</option><option>Saint Pierre and Miquelon</option><option>Saint Vincent and the Grenadines</option><option>Samoa</option><option>San Marino</option><option>Sao Tome and Principe</option><!-- copyright Felgall Pty Ltd --><option>Saudi Arabia</option><option>Senegal</option><option>Serbia and Montenegro</option><option>Seychelles</option><option>Sierra Leone</option><option>Singapore</option><option>Slovakia</option><option>Slovenia</option><option>Solomon Islands</option><option>Somalia</option><option>South Africa</option><option>South Georgia and the South Sandwich Islands</option><option>Spain</option><option>Sri Lanka</option><option>Sudan</option><option>Suriname</option>

<option>Svalbard and Jan Mayen Islands</option><option>Swaziland</option><option>Sweden</option><option>Switzerland</option><option>Syria</option><option>Taiwan</option><option>Tajikistan</option><option>Tanzania</option><option>Thailand</option><option>Togo</option><option>Tokelau</option><option>Tonga</option><option>Trinidad and Tobago</option><option>Tunisia</option><option>Turkey</option><option>Turkmenistan</option><option>Turks and Caicos Islands</option><option>Tuvalu</option><option>Uganda</option><option>Ukraine</option><option>United Arab Emirates</option><option>United Kingdom</option><option>United States of America</option><option>Uruguay</option><option>Uzbekistan</option><option>Vanuatu</option><option>Vatican City</option>

<option>Venezuela</option><option>Vietnam</option><option>Virgin Islands (British)</option><option>Virgin Islands (US)</option><option>Wallis and Futuna Islands</option><option>Western Sahara</option><option>Yemen</option><option>Zaire</option><option>Zambia</option><option>Zimbabwe</option></select><br><font size="1">

<!-- end of drop down country selection list -->
</font><br />
</td>
</tr>



<td valign="middle">

<b> Are you currently employed?</b><br>
<input name="employed" value="employed" type="radio"> yes<br>
<input name="employed" value="UNemployed" type="radio"> no<br>

<br />
</td>
</tr>


<tr>
<td valign="middle">

<b> What is your occupation:</b> <input name="job" value="" size="20" type="text"><br>
<br />
</td>
</tr>


<tr>
<td valign="middle">

<b> Are you a student?</b><br>
<input name="student" value="student" type="radio"> yes<br>
<input name="student" value="not student" type="radio"> no<br>
<br />
</td>
</tr>

<tr>
<td valign="middle">

<b> Are you :</b><br>
<input name="full" value="full-time" type="radio"> full-time<br>
<input name="full" value="part-time" type="radio"> part-time<br>
<br />
</td>
</tr>




</tbody>

</table> 
 	</form>
 			<span class="chevron">>></span><span style="cursor:pointer;color:black;font-weight:bold" onclick="submitForm();"> Continue</span> 
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
   
</body></html>

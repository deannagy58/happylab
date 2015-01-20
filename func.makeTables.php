<?php

/******************************************************************/
/*
 * 
  * 
 * */
function simpleSurvey( $_tbl_name, $_questions, $_colHeader=NULL, $_class=NULL  )
{
   $th = '<th class=thdr>%s</th>'."\n"; 

  $tr_elem = "<tr id='%s' "; 
  $tr_elem .= " class='%s'";
  $tr_elem .= " onMouseOver=\"mOver('%s')\" ";
  $tr_elem .= " onMouseOut=\"mOut('%s', '%s')\"> ";



   $td_question = '<td class=tdQuestion>%s</td>'."\n";

   $td_elem  = '<td class=tdCell onClick=mClick("%s_%s")>';
   $td_elem .= '<INPUT TYPE=RADIO NAME="q_%s" id="%s_%s" VALUE="%s" ';
   //$td_elem .= ' class=tdCell ';
   $td_elem .= ' onClick=mClick("%s_%s")></td>';
//   $td_elem .= '\n';


	$tr_class = 'trEven';
	
   $table_str = '<table id="'. trim($_tbl_name) .'" border=0 ' . '" class="'.$_class.'">'."\n"; 
      
   $num_rows = sizeof($_questions);
   $num_cols = sizeof($_colHeader); 
    
   //create table header cells
   if ($_colHeader){
      $table_str .= '<tr>';
      for($i=0; $i< sizeof($_colHeader); $i++){
      	$table_str .= sprintf($th,  $_colHeader[$i]);
       /////////////////$table_str .= sprintf($th,  '<img src="img/circles_1.jpg">');
       
         if (( ($i % sizeof($_colHeader)) == 0  )  && ($i != 0)){
           $table_str .= "</tr>\n<tr>";
         }
    	}
   	}

   	$elem_cnt = 0;  
   	for($row=0; $row< $num_rows; $row++){
		$row_id = "t" . strval($row+1);  
		$tr_class = ($tr_class == 'trEven')?"trOdd":"trEven"; 	
  //      $table_str .= "<tr id='" . $row_id . "' class=" . $tr_class ." onMouseOver=callmeII('". $row_id ."')> ";
       	$table_str .= sprintf($tr_elem, $row_id,  
                                         $tr_class,
                                         $row_id,
                                         $row_id, $tr_class  
                                         );    
  
  
  
  
      	$table_str .= sprintf($td_question, $_questions[$row]);
      	for($i=1; ($i< $num_cols ) ; $i++){
        	$table_str .= sprintf($td_elem, $row+1, $i, 
                                         $row+1,
                                         $row+1  , 
                                         $i,
                                         $i,
                                         $row+1, $i  
                                         );                    
        	 $elem_cnt++;
      	}     
      	$table_str .= "</tr>\n";
  	 } 

   	$table_str .= "</table>\n";
  
   	return ($table_str);
  
} // end of simpleSurvey()


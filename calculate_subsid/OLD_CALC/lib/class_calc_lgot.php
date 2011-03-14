<?php
include_once("../classes/database_work.php");

class calc_lgot extends database_work
{
	var $id_home;
	var $id_people;
	var $id_vid_uslug;
	
	var $koef_lgot=0;

	var $count_global_lgot= 0;
	var $percent_global_lgot= 100;
	
	var $count_local_lgot= 0;
	var $percent_local_lgot= 100;
//  SELECT * FROM udostover, lgot, uslug WHERE udostover.id_vid_udostover= lgot. id_sprav_udostover AND  uslug.id_uslug= lgot.id_sprav_uslug  
// SELECT * FROM udostover, lgot, uslug 
//WHERE udostover.id_vid_udostover= lgot. id_sprav_udostover AND  uslug.id_uslug= lgot.id_sprav_uslug 
// AND uslug.id_home='5' AND udostover.id_people= '10' AND uslug.id_vid_uslug= '41'  
  
  var $debug_mode= false;
  
    function calc_lgot_($range, $id_people)
  	{
	    //
	    $this->connect_db();
	    $tables= "udostover, lgot, uslug";
	    $where1= "udostover.id_vid_udostover= lgot.id_sprav_udostover AND  uslug.id_vid_uslug= lgot.id_sprav_uslug ";
	    $where2= " AND uslug.id_home='".$this->id_home."' AND udostover.id_people= '".$id_people."' AND uslug.id_vid_uslug= '".$this->id_vid_uslug."'";
	    $where3= " AND  lgot_range='2' "; //ищем только глобальные льготы//
	    $where4= " AND  lgot_range='1' "; //ищем только локальные льготы//

	    $query= "SELECT * FROM ".$tables. " WHERE ". $where1. $where2;
	    if($range=="GLOBAL")
	    	{
			  $query= $query.$where3;
			}
	    else
	    	{
			  $query= $query.$where4;
			}
	    //echo "<hr>\n";
	    //echo $query;
	    //echo "<hr>\n";
	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
	    	  if($range=="GLOBAL")
	    	  	{
	    	  $this->percent_global_lgot= $row["percent"];
	    	  //echo $this->percent_global_lgot."---<br>\n";
			  $this->count_global_lgot++;
				}
			else
				{
					$this->percent_local_lgot= $row["percent"];
			  		$this->count_local_lgot++;
				}
			}

			  if($range=="GLOBAL")
			  	{
					if($this->count_global_lgot>1)
						{
						  	echo "ќшибка: указано слишком много √ЋќЅјЋ№Ќџ’ Ћ№√ќ“ уберите лишние льготы<br>\n";
			  				$this->percent_global_lgot= 100;
						}
				}
			else
				{
					if($this->count_local_lgot>1)
						{
						  	echo "ќшибка: указано слишком много Ћќ јЋ№Ќџ’ Ћ№√ќ“ у человека ".$id_people." уберите лишние льготы<br>\n";
			  				$this->percent_local_lgot= 100;
						}
				}
			
	} 
  
  
  
  
  function calc_global_lgot()
  	{
	    //
	    $this->connect_db();

	    $query= "SELECT id_people FROM people WHERE id_home='".$this->id_home."' AND to_be= '1'";

	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
	    	  	
				$this->calc_lgot_("GLOBAL",$row["id_people"]);
			}

	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
 function calc_local_lgot()
 	{
	   $this->calc_lgot_("LOCAL", $this->id_people);
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
//   function calc_koef_lgot()
//   	{
// 	    //
// 
//   
// 	}



























}

?>
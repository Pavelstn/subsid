<?php
include_once("class_calc_lgot.php");
include_once("../classes/database_work.php");


function koef_lgot($usluga, $house)
	{
	  //
	  $core_local_lgot=0;
	  $core_global_lgot= 100;
	  $database= new database_work;
	  $calk_people= 0;
	  	$database->connect_db();

	    $query= "SELECT id_people FROM people WHERE id_home='".$house."' AND to_be= '1'";

	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
			  $local_lgot= new calc_lgot;
			  $local_lgot->id_home= $house;
			  $local_lgot->id_people= $row["id_people"];
			  $local_lgot->id_vid_uslug= $usluga;
			  $local_lgot->calc_local_lgot();
			  $core_local_lgot= $core_local_lgot+ $local_lgot->percent_local_lgot; 
			 // echo $local_lgot->percent_local_lgot."<br>\n";
			  unset($local_lgot);
			  $calk_people++;
			}
			
		$global_lgot= new calc_lgot;
		$global_lgot->id_home= $house;
		$global_lgot->id_vid_uslug= $usluga;
		$global_lgot->calc_global_lgot();
		$core_global_lgot= $global_lgot->percent_global_lgot;
		
		unset($global_lgot);
		$database->dis_connect_db();
		unset($database);
		//echo "<hr>\n";
		//echo $core_global_lgot;
		//echo "<hr>\n";
		//return $core_local_lgot;	
		
		//$core_lgot= ($core_local_lgot/100)*($core_global_lgot/100);
		$core_lgot= ($core_local_lgot*$core_global_lgot)/10000;
		return $core_lgot;
	}
















?>
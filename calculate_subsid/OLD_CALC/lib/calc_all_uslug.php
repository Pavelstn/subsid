<?php
include_once("calc_tarif.php");
include_once("get_normativ.php");
include_once("calculate_koef_lgot.php");
include_once("calc_full_tarif.php");
include_once("calc_house_uslug.php");
include_once("../classes/database_work.php");

function calc_house_uslug($id_house, $start_date, $stop_date)
	{
	  //
	  $all_money= 0;
	  $db_load= new db_load("SELECT * FROM soderg_house WHERE id_set= '1'");
	  $kkk= koef_lgot($db_load->row["point_uslug"], $id_house);
	  
	  
	  $fff= scroll_house_uslug($start_date, $stop_date, $db_load->row["point_uslug"], $id_house);
	  $all_money+= $kkk* $fff;
	  return $all_money;
	}



function calc_all_uslug($id_house, $start_date, $stop_date)
	{
	  //
	  
	  $database= new database_work;
	  $database->connect_db();
	  
	  $all_money= 0;
	    $query= "SELECT * FROM uslug WHERE id_home='".$id_house."'";

	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
			  //
			   //id_uslug
			   //id_vid_uslug
			   // value_uslug
			  $name_uslug= $row["id_vid_uslug"];
			   $kkk= koef_lgot($name_uslug, $id_house);
			   $fff= scroll_day($start_date, $stop_date, $name_uslug);
			   $all_money+= $kkk* $fff;
			}
		//$database->dis_connect_db();
		$all_money+= calc_house_uslug($id_house, $start_date, $stop_date);
	  return $all_money;
	}








?>
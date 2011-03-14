<?php
include_once("calc_tarif.php");
include_once("get_normativ.php");
include_once("get_normativ.php");
include_once("class_calc_people.php");
include_once("../classes/db_load.php");

// function next_day($date)
// {
//   $year= $date[0].$date[1].$date[2].$date[3];
//   $month= $date[5].$date[6];
//   $day= $date[8].$date[9];
//   
//   $next_day  = mktime(0,0,0,$month  ,$day+1,$year);
//   $next_day  =date("Y-m-d",$next_day);
//   return $next_day;
// }

////////////////////////////////////
function get_house_normativ($uslug, $id_house)
	{
	  $normativ= 0;
	  
	  $calc_people= new calc_people;
	  $calc_people->id_house= $id_house;
	  $calc_people->calc();
	  //$calc_people->$all_people;
	  $db_load= new db_load("SELECT * FROM soderg_house WHERE id_set= '1'");
	  if($calc_people->all_people==1) $normativ= 1* $db_load->row["one_peole"];
	  if($calc_people->all_people==2) $normativ= 2* $db_load->row["two_people"];
	  if($calc_people->all_people>=3) $normativ= $calc_people->all_people* $db_load->row["three_people"];
	  return $normativ;
	}

function scroll_house_uslug($start_date, $stop_date, $uslug, $id_house)
  {
    //
    
    
    
    $next="";
    $count_money= 0;
    $count_norm= 0;
    $deng= 0;
    for($next= $start_date; $next<=$stop_date;$next= next_day($next))
    	{
  	    //
  	    $year= $next[0].$next[1].$next[2].$next[3];
  	    $month= $next[5].$next[6];
  	    $day= $next[8].$next[9];
  	    
  	    $current_tarif= get_tarif($year."-".$month."-".$day, $uslug);
  	    
  	    $current_norma= get_house_normativ($uslug, $id_house);
  	   
  	    $base_mon_max = date ("t",mktime (0,0,0,$month,$day,$year));
  	    $money= $current_tarif/$base_mon_max;
	    $norm= $current_norma/$base_mon_max;
  	    
	   // echo $next."тариф ".$current_tarif." по ".$money."руб при норме ".$current_norma."| ".$money*$current_norma."  ".$base_mon_max."<br>\n";
	//$deng+= $money*$current_norma;
	//$deng+= $money*$norm;
	$deng+= $current_tarif*$current_norma/$base_mon_max;
  	   // echo "<br>\n";
  	}
  	//echo $count_money* $count_norm;
	//echo $deng;
  	return $deng;
  }







?>
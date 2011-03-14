<?php
include_once("calc_tarif.php");
include_once("get_normativ.php");


function next_day($date)
{
  $year= $date[0].$date[1].$date[2].$date[3];
  $month= $date[5].$date[6];
  $day= $date[8].$date[9];
  
  $next_day  = mktime(0,0,0,$month  ,$day+1,$year);
  $next_day  =date("Y-m-d",$next_day);
  return $next_day;
}
////////////////////////////////////
function scroll_day($start_date, $stop_date, $uslug)
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
  	    $current_norma= get_tnornativ($year."-".$month."-".$day, $uslug);
  	   
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
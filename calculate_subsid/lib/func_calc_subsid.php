<?php
// include_once("calc_all_uslug.php");
// include_once("class_calc_dohod.php");
// include_once("class_calc_prog_min.php");
include_once("calc_prog_min.php");
// include_once("calc_all_uslug.php");
// include_once("class_calc_people.php");
// include_once("class_calc_lgot.php");
// include_once("calculate_koef_lgot.php");
// include_once("calc_full_tarif.php");
 include_once("deng1.php");
// 
// include_once("get_setting.php");
// 
 include_once("calc_dohod.php");
// include_once("class_calc_prog_min.php");


//include_once("func_calc_subsid.php");


function subsid1($OCH, $MDD, $D)
	{
	  $subs= $OCH-($MDD*$D/100);
	  
	  return $subs;
	}
///////////////////////
function subsid2($OCH, $MDD, $D, $K)
	{

	  $subs= $OCH-($MDD*$D /100* $K);
	  return $subs;
	}
///////////////
// $rash= calc_all_uslug($id_home, $start_d, $stop_d);
// $OCH= $rash["NORM"];
// $MDD= 22;

function func_calc_subsid($id_home, $start_d, $stop_d)
	{
	  //$OCH= calc_all_uslug($id_home, $start_d, $stop_d);
	  
	  $rash= calc_all_uslug($id_home, $start_d, $stop_d);
	  $OCH1= $rash["NORM"];  //расчет по норме//
	  $OCH2= $rash["FACT"];  //расчет по факту//
	  if($OCH1<= $OCH2) $OCH= $OCH1;
	  else $OCH= $OCH2;
	  echo "<hr>\nOCH ".$OCH;
	  $MDD= 22;
	  $money= new class_calc_dohod($id_home);
	  //echo "<br>money ".$money;
	  $D= $money->sov_dohod_semi;
	  echo "<br>\n D ".$D;
	  $dg= new class_calc_prog_min($id_home, $start_d);
	  $K= $money->sred_dush_doh /$dg->all_prog_min();
	  echo "<br>K ".$K;
	  echo "<hr>\n";
	  
	  if($money->sred_dush_doh > $dg->all_prog_min())
	  	{
		    $subsid_value= subsid1($OCH, $MDD, $D);
		}
	  else
	  	{
		   $subsid_value= subsid2($OCH, $MDD, $D, $K);
		} 
	  //return $subsid_value;
	  return round($subsid_value, 2);//округление
	}
////////////////////////////////



?>
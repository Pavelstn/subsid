<?php
include_once("rashod_house.php");
include_once("lgota2.php");

include_once("../classes/database_work.php");
include_once("../classes/db_load.php");
include_once("get_house_normativ.php");

//модуль для расчета нестандартных коммунальных услуг//



function calc_hous_uslug($id_h, $n_uslg, $strt, $stp)
	{
	  echo "<hr>\n calc_hous_uslug<p>\n";
	  //$db= new database_work;
	  //$db->connect_db(); 

			   
			   $k= koef_lgot_($n_uslg, $id_h); 

			  $f=  rashod_house($strt, $stp, $n_uslg, $id_h);
			  //$f=  rashod_otopl($strt, $stp, $n_uslg, $id_h);
			 // echo " Тариф-".$f." ";
			  $nor= get_house_normativ($id_h);
			 // echo " Норма на жилье-".$nor." ";
			  $m= $nor* $f;
			  //echo "<br>\n";

			  
			  $n_plo= get_house_normativ_only($id_h);	  
			   
			  $m_lgot= $m- ($n_plo* $f* $k["LOCAL"]);
			  
//			  echo " минус 1 вид льгот ".$m_lgot." ";
			  
			  $m= ($m-$m_lgot)* $k["GLOBAL"];
//			  echo "<br>\n";
//			  echo "По норме со всеми льготами-".$m." "; 
//			  echo "<hr>\n";
///////////////////////////////////////////////////////////////////////////////////////////////////////
			///расчет по факту////
			
////выбираем фактическое значение площади			
$db_load= new db_load("SELECT obsh_ploshad FROM house_env WHERE id_home= '".$id_h."'");
$f_plo= $db_load->row["obsh_ploshad"];
unset($db_load);
$f_m= $f_plo* $f;
//echo " фактическая площадь-".$f_plo."<br>\n";		
//echo " фактические затраты без льгот-".$f_m."<br>\n";						  


$f_m= ($f_m-$m_lgot)* $k["GLOBAL"];
//echo " фактические затраты со льготами-".$f_m."<br>\n";
	$mny["NORM"]= $m;
	$mny["FACT"]= $f_m;
	  return $mny;
	}








?>
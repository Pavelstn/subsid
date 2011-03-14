<?php

include_once("private_uslug.php");
include_once("calc_uslug.php");
include_once("calc_lgot.php");
include_once("private_lgot.php");


	
function calc_deng($id_home, $count_all_people, $strt, $stp , &$price, &$lgot)
{
    $calc_uslug=    new calc_uslug;
    $pulgot=        new calc_lgot;
  	$p_lgot=        new private_lgot($id_home, $count_all_people);
  	$private_uslug= new private_uslug($id_home);
  	
	$calc_uslug->calc($price, $private_uslug, $strt, $stp);
	$all_deng= 0;
	
		while (list ($key, $val) = each ($calc_uslug->all_uslug) ) :
			$pulgot->calc($key,$p_lgot,$lgot);	
			$k_lgot= $pulgot->calc_ordinary_lgot();
			$all_deng+= $val*$k_lgot;
		endwhile;

		unset($calc_uslug);
		unset($pulgot);
		unset($private_uslug);
		unset($k_lgot);
		
	return $all_deng;		
}

?>
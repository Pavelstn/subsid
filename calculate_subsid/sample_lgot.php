<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");

//	include_once("../lib/navigate.php");

include_once("./new_lib/calc_lgot.php");

include_once("./new_lib/private_lgot.php");
include_once("./new_lib/core_lgot.php");


echo "<body bgcolor=\"#FFFFD4\">";


$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
	


$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html();
echo "<br>\n";
$calk->to_html();
echo "<hr>\n";
///////////////////////////////////////////////////////////////
$uslug= 44;
$lgot= new core_lgot;
$lgot->init_lgot(); 
$p_lgot= new private_lgot(3);

$pulgot= new calc_lgot;
$pulgot->calc($uslug,&$p_lgot,&$lgot);
echo "Обычная льгота равна ".$pulgot->calc_ordinary_lgot()."<br>\n";
///////////////////////////////////////////
echo "</form>\n";
?>
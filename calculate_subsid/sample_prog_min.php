<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
////////////////////////////////////////////////////////

include_once("./new_lib/calc_prog_min.php");






echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
///////////////////////////////////////////////////////////////
//$prog_min= new calc_prog_min;
//$prog_min->id_home= 3;
//$prog_min->init_prog_min("2006-01-10");
$prog_min= new calc_prog_min(3, "2006-01-10");
echo "В доме проживает ".$prog_min->all_people." человек<br>\n";
echo "Из них право на субсидии имеет ".$prog_min->subsid_people." человек<br>\n";
echo "Сумма прожиточных минимумов равна ".$prog_min->summ_prog_min." рублей<br>\n";

///////////////////////////////////////////
echo "</form>\n";
?>
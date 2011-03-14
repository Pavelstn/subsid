<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
////////////////////////////////////////////////////////

include_once("./new_lib/private_dohod.php");






echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
///////////////////////////////////////////////////////////////
$dohod= new private_dohod(3);
$dohod->people= 6; //сколько всего человек в семье//
$dohod->subsid_people= 6; //сколько человек имеет право на субсидии//
$dohod->calc_vse();

echo "СРЕДНЕДУШЕВОЙ ДОХОД ".$dohod->sred_dush_doh."<br>\n";
echo "совокупый доход семьи ".$dohod->sov_dohod_semi."<br>\n";
///////////////////////////////////////////
echo "</form>\n";
?>
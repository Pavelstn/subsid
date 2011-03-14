<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");


include_once("./new_lib/price.php");
include_once("./new_lib/core_lgot.php");

include_once("./new_lib/calc_deng.php");





echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
///////////////////////////////////////////////////////////////
$price= new price;
	$price->scroll_day("2006-01-01", "2006-01-31"); //инициируем расчет цен в течении расчетного периода//


$lgot= new core_lgot;
	$lgot->init_lgot();
/////////////////////////////////////////////
	
	$strt= "2006-01-01";
	$stp=  "2006-01-31";
	
for($loop= 0; $loop < 1000; $loop++)
{
  
$all_deng= calc_deng(3, $strt, $stp , $price, $lgot);
echo $loop.". Всего потрачено ".$all_deng." рублей<br>\n";
}

///////////////////////////////////////////
echo "</form>\n";
?>
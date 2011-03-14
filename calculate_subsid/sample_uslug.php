<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");

//	include_once("../lib/navigate.php");

include_once("./new_lib/private_uslug.php");

include_once("./new_lib/price.php");
include_once("./new_lib/calc_uslug.php");


echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
///////////////////////////////////////////////////////////////
$price= new price;
	$price->scroll_day("2006-01-01", "2006-01-31"); //инициируем расчет цен в течении расчетного периода//
$private_uslug= new private_uslug(3);

$deng= $price->calendar["2006-01-10"];

//echo $deng[46]."<br>\n";
/////////////////////////////////////////////////////////////////
$strt= "2006-01-01";
$stp=  "2006-01-31";
//$nxt="";


$calc_uslug= new calc_uslug;
$calc_uslug->calc(&$price, &$private_uslug, $strt, $stp);

	//echo $all_uslug[46]."<br>\n";
		while (list ($key, $val) = each ($calc_uslug->all_uslug) ) :
		echo "услуга ".$key." деньги ".$val."<br>\n";
		endwhile;

///////////////////////////////////////////
echo "</form>\n";
?>
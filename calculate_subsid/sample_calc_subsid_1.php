<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
////////////////////////////////////////////////////////

include_once("./new_lib/calc_prog_min.php");
include_once("./new_lib/price.php");
include_once("./new_lib/core_lgot.php");
include_once("./new_lib/calc_deng.php");
include_once("./new_lib/private_dohod.php");
include_once("./new_lib/calc_subsid.php");



echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","Подсчитать"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
//////////////////   инициируем глобальные данные /////////////////////////////////////////////
$price= new price;
	$price->scroll_day("2006-01-01", "2006-01-31"); //инициируем расчет цен в течении расчетного периода//
	
$lgot= new core_lgot;
	$lgot->init_lgot();
	
	
	
	
$strt= "2006-01-01";
$stp=  "2006-01-31";
//////////////////////////////////////////////////////////////////////////////////////////////
$prog_min= new calc_prog_min(3, $strt);
echo "В доме проживает ".$prog_min->all_people." человек<br>\n";
echo "Из них право на субсидии имеет ".$prog_min->subsid_people." человек<br>\n";
echo "Сумма прожиточных минимумов равна ".$prog_min->summ_prog_min." рублей<br>\n";
//-------------------//
echo "<hr>\n";
$dohod= new private_dohod(3);
$dohod->people= $prog_min->all_people; //сколько всего человек в семье//
$dohod->subsid_people= $prog_min->subsid_people; //сколько человек имеет право на субсидии//
$dohod->calc_vse();
echo "СРЕДНЕДУШЕВОЙ ДОХОД ".$dohod->sred_dush_doh."<br>\n";
echo "совокупый доход семьи ".$dohod->sov_dohod_semi."<br>\n";
//-------------------//
echo "<hr>\n";
$all_deng= calc_deng(3, $strt, $stp , $price, $lgot);
echo " Всего потрачено ".$all_deng." рублей<br>\n";
//-------------------//
//$subsid= calc_subsid($OCH, $MDD, $D, $SDD, $prog_min )
$OCH= $all_deng;  //расходы в рублях//
$MDD= 22;         //коэффициент     //
$D= $dohod->sov_dohod_semi;    //совокупный доход семьи///
$SDD= $dohod->sred_dush_doh;   //среднедушевой доход
$prog_min= $prog_min->summ_prog_min ;//суммарная величина прожиточного минимума//

$subsid= calc_subsid($OCH, $MDD, $D, $SDD, $prog_min);
echo "<hr>\n";
echo $subsid."<br>\n";
///////////////////////////////////////////
echo "</form>\n";
?>
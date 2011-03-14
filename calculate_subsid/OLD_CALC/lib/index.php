<?php
include_once("../classes/submit.php");
include_once("../classes/select_uslug.php");

include_once("../lib/navigate.php");

include_once("class_calc_people.php");
include_once("class_calc_lgot.php");
include_once("calculate_koef_lgot.php");
include_once("calc_full_tarif.php");
include_once("calc_all_uslug.php");

include_once("get_setting.php");

include_once("class_calc_dohod.php");
include_once("class_calc_prog_min.php");

include_once("func_calc_subsid.php");

echo "<body bgcolor=\"#FFFFD4\">";

//администрирование//
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
	
//$slct_uslg= new n_select_uslug();

$calk= new submit("_calk_","Подсчитать"); 



echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "Формирование выплат\n<hr>\n";
//$slct_uslg->to_html();
echo "<br>\n";
$calk->to_html();
echo "<br>\n";
echo "пробный расчет:\n";
echo "<br>\n";

//echo "расчет колличества человек\n";
//echo "<br>\n";
$calc= new calc_people;
$calc->id_house= 5;
//$calc->debug_mode= true;
$calc->calc();


////////////////////////////////////////////////
	if($calk->get_onclick())
		{
			echo calc_all_uslug(5, "2006-03-01", "2006-03-31");
		}

/////////////////////////////////////////////
echo "<br>";
$dfgh= new get_setting;
$dfgh->year= 2006;
$dfgh->month= "04";
$dfgh->day="03";
echo $dfgh->get_data();
echo "<br>";
$dfgh->minus_month(7);
echo $dfgh->get_data();
echo "<br>";

echo "<hr>\n";
echo "расчет от модуля \n";
echo func_calc_subsid(5, "2006-03-01", "2006-03-31");
echo " рублей.<br>\n";
echo "</form>\n";
?>
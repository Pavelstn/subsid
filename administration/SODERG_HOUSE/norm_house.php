<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/select_number.php");
include_once("../../classes/select_uslug.php");

include_once("../../classes/db_load.php");
include_once("../../classes/db_update.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");

/////////////////////////////////////////////////
$db_load_= new db_load("SELECT * FROM soderg_house WHERE id_set='1'");


$one_people= new select_number("_one_ppl_", "1", "40");
	
$two_people= new select_number("_two_ppl_", "1", "50");
		
$three_people= new select_number("_three_ppl_", "1", "40");

$sprav_uslug= new n_select_uslug();
$sprav_uslug->onchange= false;

$sprav_otopl= new n_select_uslug();
$sprav_otopl->onchange= false;
$sprav_otopl->html_name= "_otpl_uslg_";
$sprav_otopl->cath_event();

if($back->get_onclick()) 
	{
	  $db_update_= new db_update("UPDATE soderg_house SET one_peole = '".$one_people->get_default()."', two_people='".$two_people->get_default()."', three_people='".$three_people->get_default()."', point_uslug='".$sprav_uslug->get_value()."', point_otopl= '".$sprav_otopl->get_value()."' WHERE id_set= '1'");
	  link("index.php");
	}
//	echo "<hr>\n";
//echo $sprav_otopl->get_value();
//	echo "<hr>\n";
		
	$one_people->set_default($db_load_->row["one_peole"]);
	$two_people->set_default($db_load_->row["two_people"]);
	$three_people->set_default($db_load_->row["three_people"]);
	$sprav_uslug->set_default($db_load_->row["point_uslug"]);
	$sprav_otopl->set_default($db_load_->row["point_otopl"]);

/////////////////////////////////////////////////
echo "<form method=\"POST\"  action=\"norm_house.php\">\n";
$back->to_html();
echo "администрирование->содержание жилья->Нормы на жилплощадь\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Норма по жилплощади<br>\n";
echo "Если 1 человек \n";
$one_people->to_html();
echo " Кв/м.<br>\n";
echo "Если 2 человека \n";
$two_people->to_html();
echo " Кв/м.<br>\n";
echo "Если 3 и более человека \n";
$three_people->to_html();
echo " Кв/м.<br>\n";
echo "<hr>\n";
echo "Выберите услугу, характеризующую содержание жилья.\n<br>\n";
$sprav_uslug->to_html();
echo "<p>\n";
echo "Выберите услугу, характеризующую отопление.\n<br>\n";
$sprav_otopl->to_html();

echo "</form>\n";
?>
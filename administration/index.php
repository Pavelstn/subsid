<?php
include_once("../classes/submit.php");
include_once("../lib/navigate.php");

echo "<body bgcolor=\"#CC99FF\">";
//администрирование//
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");
	
$uslug_tarif_etc= new submit("uslg_tri_tc","Услуги, тарифы, и.т.д.");
	if($uslug_tarif_etc->get_onclick()) link("./uslug_tarif_etc/index.php");

$udostover_logt= new submit("udstvr_lgt","Удостоверения, льготы");
	if($udostover_logt->get_onclick()) link("./udostover_lgot/index.php");

$prog_min= new submit("_prg_min_","Прожиточный минимум");
	if($prog_min->get_onclick()) link("./prog_min/index.php");

$normativ_uslug= new submit("_nrmtv_uslug_","Нормы потребления услуг");
	if($normativ_uslug->get_onclick()) link("./normativ_uslug/norvativ_uslug.php");

$prog_setting= new submit("_prg_sttng_","Настройка программы");
	if($prog_setting->get_onclick()) link("./prog_setting/index.php");

$soderg_house= new submit("_sdrg_hs_","содержание жилья");
	if($soderg_house->get_onclick()) link("./SODERG_HOUSE/index.php");

$php_my_admin= new submit("_php_my_admn_","php_my_admin");
	if($php_my_admin->get_onclick()) link("./phpmyadmin/index.php");

$clear_base= new submit("_clr_bse_","Очистка базы");
	if($clear_base->get_onclick()) link("./clear_base/index.php");
	
$test_fill_base= new submit("_tst_fll_bs_","Тестовое заполнение базы");
	if($test_fill_base->get_onclick()) link("./test_fill_base/index.php");


echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование\n<hr>\n";
$uslug_tarif_etc->to_html();
$udostover_logt->to_html();
$prog_min->to_html();
$normativ_uslug->to_html();
$prog_setting->to_html();
$soderg_house->to_html();
$php_my_admin->to_html();
$clear_base->to_html();
$test_fill_base->to_html();	



echo "</form>\n";

/*

zayavki
uslug
udostover
udobstv  
	tarif_net
DELETE FROM `people` 
DELETE FROM `house_env` 
DELETE FROM `house` 
DELETE FROM `dohod` 


*/






?>
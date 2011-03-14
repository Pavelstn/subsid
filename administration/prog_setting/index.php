<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/select_number.php");
include_once("../../classes/text.php");

include_once("../../classes/db_load.php");
include_once("../../classes/db_update.php");

//настройка программы//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$db_load_= new db_load("SELECT * FROM prog_set WHERE id_set='1'");






$month_range= new select_number("_mnth_rng_", "1", "12");

	$m_r_change= new submit("_m_r_chng_","Изменить");
	if($m_r_change->get_onclick())
		{
		  //
		   //link("../index.php");
		  $db_update_= new db_update("UPDATE prog_set SET month_range = '".$month_range->get_default()."' WHERE id_set= '1'");
		  unset($db_update_);
		  link("index.php");
		}
		  $month_range->set_default($db_load_->row["month_range"]);

		

$bank_filial= new text("_bnk_fll_");
	$b_f_change= new submit("_b_f_change_","Изменить");
	if($b_f_change->get_onclick())
		{
		  $db_update_= new db_update("UPDATE prog_set SET bank_filial = '".$bank_filial->get_value()."' WHERE id_set= '1'");
		  unset($db_update_);
		  link("index.php");
		}
	$bank_filial->set_value($db_load_->row["bank_filial"]);
	
	
$month_zaprlat= new select_number("_mnth_zrplt_", "1", "12");
	$m_z_change= new submit("_m_z_change_","Изменить");
	if($m_z_change->get_onclick())
		{
		  $db_update_= new db_update("UPDATE prog_set SET month_zaprlat = '".$month_zaprlat->get_default()."' WHERE id_set= '1'");
		  unset($db_update_);
		  link("index.php");
		}
	$month_zaprlat->set_default($db_load_->row["month_zaprlat"]);
	


echo "<form method=\"POST\"  action=\"./index.php\">\n";
$back->to_html();
echo "администрирование->настройка программы\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "на сколько месяцев вперед расчитывать субсидии\n";
$month_range->to_html();
$m_r_change->to_html();
echo "\n<br>\n";
echo "Код филиала банка\n";
$bank_filial->to_html();
$b_f_change->to_html();
echo "\n<br>\n на сколько месяцев назад от подачи\n<br>\n заявления расчитывать доход\n";
$month_zaprlat->to_html();
$m_z_change->to_html();

echo "</form>\n";
?>
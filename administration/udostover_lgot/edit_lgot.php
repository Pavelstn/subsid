<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/db_select.php");
include_once("../../classes/select_uslug.php");
include_once("../../classes/select_number.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");


//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$select_udostover= new db_select("_slct_udstvr_", "sprav_udostover", "id_udostover", "name_ud");
	$select_udostover->set_value("1");
	$select_udostover->cath_event();
	
$sprav_uslug= new n_select_uslug();
$percent_uslug= new select_number("_prcnt_uslg_", "1", "100");
	$percent_uslug->set_default("100");
	$percent_uslug->cath_event();

$raspr_lgot= new db_select("_rspr_lgt_", "lgot_range", "id_lgot_range", "name_lgot_range");

$add_lgot= new submit("_add_lgot_","Добавить льготу");
	if($add_lgot->get_onclick())
		{
		  //
		  $udost_= $select_udostover->get_value();
		  $uslug_= $sprav_uslug->get_value();
		  $percent_= $percent_uslug->get_default();
		  $rspr_lgt_= $raspr_lgot->get_value();
		  $write_to_base= new db_write("lgot", "id_sprav_udostover, id_sprav_uslug, percent, lgot_range", "'$udost_', '$uslug_', '$percent_', '$rspr_lgt_'");
		}

$lgot_table= new db_table;
	$rows= "lgot.id_lgot, sprav_uslug.uslug_name, lgot.percent, lgot_range.name_lgot_range";
	$tables="lgot, sprav_uslug, lgot_range";
	$where="sprav_uslug.id_uslug= lgot.id_sprav_uslug AND lgot_range.id_lgot_range= lgot.lgot_range";
		$udost_= $select_udostover->get_value();
	$where2= " AND lgot.id_sprav_udostover= ".$udost_;
	
	$lgot_table->set_query("SELECT ".$rows." FROM ".$tables." WHERE ".$where. $where2." ORDER BY lgot.id_lgot ASC");
	
	
	$lgot_table->add_visible_row("uslug_name", "Название услуги");
	$lgot_table->add_visible_row("percent", "Процент от тарифа");
	$lgot_table->add_visible_row("name_lgot_range", "На кого распространяется");
	$lgot_table->set_table_for_del("lgot", "id_lgot");
	$lgot_table->cath_event();

//////////////////////////////////////////////////////
echo "<form method=\"POST\"  action=\"edit_lgot.php\">\n";
$back->to_html();
echo "администрирование->удостоверения, льготы->Льготы\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Удостоверение \n";
$select_udostover->to_html();
echo "<br>\n";
echo "Льгота на \n";
$sprav_uslug->to_html();
echo " Оплата \n";
$percent_uslug->to_html();
echo "% От стоимости\n";
echo "<br>\n";
echo "Льгота распространяется \n";
$raspr_lgot->to_html();
$add_lgot->to_html();
echo "\n<br>\n";
echo "<br>\n";
$lgot_table->to_html();


echo "</form>\n";
?>
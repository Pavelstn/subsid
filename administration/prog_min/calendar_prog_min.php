<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/db_select.php");
include_once("../../classes/calendar.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$vid_prog_min= new db_select("_vd_prg_mn_", "prog_min", "id_prog_min", "name_soc_kat");
	$vid_prog_min->set_value("1");
	$vid_prog_min->cath_event();
	
$start_prog_min= new calendar("_strt_prg_mn_");
	$start_prog_min->set_full_data("current");
	$start_prog_min->cath_event();


$stop_prog_min= new calendar("_stop_prg_mn_");
	$stop_prog_min->set_full_data("current");
	$stop_prog_min->cath_event();

$value_prog_min= new text("_val_prg_mn_");
	$value_prog_min->set_size("6");
	
$add_prog_min= new submit("_add_prg_mn_","Добавить");
	if($add_prog_min->get_onclick())
		{
		  $prg_mn_= $vid_prog_min->get_value();
		  $at_= $start_prog_min->get_full_data();
		  $to_= $stop_prog_min->get_full_data();
		  $money_= $value_prog_min->get_value();
		  $write_to_base= new db_write("prog_min_net", "id_prog_min, at_date, to_date, prog_min_value", "'$prg_mn_', '$at_', '$to_', '$money_'");
		  unset($prg_mn_); unset($at_); unset($to_); unset($to_); unset($money_);  unset($write_to_base);
		}
			

$prog_min_table= new db_table;
	$where= $vid_prog_min->get_value();
	
	$prog_min_table->set_query("SELECT id_prog_min_net, at_date, to_date, prog_min_value FROM prog_min_net WHERE id_prog_min=".$where);
	$prog_min_table->set_table_for_del("prog_min_net", "id_prog_min_net");
	$prog_min_table->add_visible_row("at_date", "С");
	$prog_min_table->add_visible_row("to_date", "По");
	$prog_min_table->add_visible_row("prog_min_value", "Прожиточный мин.");
	$prog_min_table->cath_event();
	
/////////////////////////////////////////	
echo "<form method=\"POST\"  action=\"calendar_prog_min.php\">\n";
$back->to_html();

echo "администрирование->прожиточный минимум->Календарь прожиточных минимумов\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Прожиточный минимум \n";
$vid_prog_min->to_html();
echo "<br>\n";

echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С </td>\n";
echo "		<td>\n";
$start_prog_min->to_html();
echo "      </td>\n";
echo "		<td> По </td>\n";
echo "		<td>\n";
$stop_prog_min->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "Величина прожиточного минимума \n";
$value_prog_min->to_html();
echo "Руб.\n";
$add_prog_min->to_html();
echo "<p>\n";
$prog_min_table->to_html();


echo "</form>\n";
?>
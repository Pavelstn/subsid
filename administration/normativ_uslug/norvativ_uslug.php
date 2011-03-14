<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/select_uslug.php");
include_once("../../classes/calendar.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$sprav_uslug= new n_select_uslug();

$start_date_norm= new calendar("_strt_dte_nrm_");
	$start_date_norm->set_full_data("current");
	$start_date_norm->cath_event();
	
$stop_date_norm= new calendar("_stop_dt_nrm=_");
	$stop_date_norm->set_full_data("current");
	$stop_date_norm->cath_event();
	
$norm_value= new text("_nrm_val_");
	$norm_value->set_size("6");
	
$add_norm= new submit("_add_nrm_","Добавить");
	if($add_norm->get_onclick())
		{
		  $id_sprv_uslg_= $sprav_uslug->get_value();
		  $start_= $start_date_norm->get_full_data();
		  $stop_= $stop_date_norm->get_full_data();
		  $vlu_nrm_= $norm_value->get_value();
		  $write_to_base= new db_write("norm_uslug", "id_sprav_uslug, start, stop, value_norm", "'".$id_sprv_uslg_."', '".$start_."', '".$stop_."', '".$vlu_nrm_."'");
		}
$norm_table= new db_table;
	//$norm_table->set_query("SELECT * FROM norm_uslug");
	$norm_table->set_query("SELECT norm_uslug.id_norm, sprav_uslug.uslug_name, norm_uslug.start, norm_uslug.stop, norm_uslug.value_norm FROM norm_uslug, sprav_uslug WHERE sprav_uslug.id_uslug= norm_uslug.id_sprav_uslug ");
	$norm_table->set_table_for_del("norm_uslug", "id_norm");
	$norm_table->cath_event();
	
//////////////////////////////////////////////////
echo "<form method=\"POST\"  action=\"norvativ_uslug.php\">\n";
$back->to_html();
echo "администрирование->Нормы потребления услуг\n<hr>\n";
//////////////////////////////////////////////////////////////////

echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С</td>\n";
echo "		<td>\n";
$start_date_norm->to_html();
echo "      </td>\n";
echo "		<td>По</td>\n";
echo "		<td>\n";
$stop_date_norm->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "</table>\n";

$sprav_uslug->to_html();
echo "Норма \n";
$norm_value->to_html();

$add_norm->to_html();
echo "<p>\n";
$norm_table->to_html();

echo "</form>\n";
?>
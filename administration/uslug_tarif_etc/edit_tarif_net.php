<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/select_number.php");
include_once("../../classes/calendar.php");
include_once("../../classes/select_uslug.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");
include_once("local_class.php");

//тарифная сетка//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$sezon_year= new select_number("_szn_year_", "1999", "2010");
$sezon_year->on_change= true;
$sezon_year->set_default(date("Y"));
$sezon_year->cath_event();
/////////
$slct_sezon= new select_sezon();
$slct_sezon->year= $sezon_year->get_default();


$start_tarif_uslug= new calendar("_strt_trf_slg_");
		$start_tarif_uslug->set_date_range_start($sezon_year->get_default());
		$start_tarif_uslug->set_date_range_stop($sezon_year->get_default());

$stop_tarif_uslug= new calendar("_stp_trf_slg_");
		$stop_tarif_uslug->set_date_range_start($sezon_year->get_default());
		$stop_tarif_uslug->set_date_range_stop($sezon_year->get_default());

$money_rubl= new text("_mny_rbl_");
	$money_rubl->set_size("10");

//$money_kop= new text("_mny_kop_");
//	$money_kop->set_size("3");
	
$sprav_uslug= new n_select_uslug();

$add_tarif= new submit("_add_trf_","Добавить тариф");
	if($add_tarif->get_onclick())
		{
			$szn_= $slct_sezon->get_value();
			$spr_uslg_= $sprav_uslug->get_value();	
			$start_date_= $start_tarif_uslug->get_full_data();
			$stop_date_= $stop_tarif_uslug->get_full_data();
			$money_value_= $money_rubl->get_value();
		  $write_to_base= new db_write("tarif_net", "id_sezon, id_uslug, start_date, stop_date, money_value", "'$szn_','$spr_uslg_', '$start_date_', '$stop_date_', '$money_value_' ");
		}

$tarif_net_table= new db_table;

$_sezon_= $slct_sezon->get_value();
$uslug_= $sprav_uslug->get_value();

$query="SELECT tarif_net.id_tarif_net, sprav_uslug.uslug_name, tarif_net.start_date, tarif_net.stop_date, tarif_net.money_value FROM tarif_net, sprav_uslug WHERE tarif_net.id_uslug = sprav_uslug.id_uslug AND tarif_net.id_sezon =  '$_sezon_' AND tarif_net.id_uslug =  '$uslug_'";
 	//$tarif_net_table->set_query("SELECT * FROM tarif_net");
	$tarif_net_table->set_query($query);
 	$tarif_net_table->set_table_for_del("tarif_net", "id_tarif_net");
 	$tarif_net_table->cath_event();


/////////////////////////////////////////////////////////////////////////////////////////
echo "<form method=\"POST\"  action=\"edit_tarif_net.php\">\n";
$back->to_html();
echo "администрирование->услуги тарифы итд->тарифная сетка\n<hr>\n";
//////////////////////////////////////////////////////////////////
$sezon_year->to_html();
echo "год. Сезон\n";
$slct_sezon->to_html();




echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С</td>\n";
echo "		<td>\n";
$start_tarif_uslug->to_html();
echo "      </td>\n";
echo "		<td>По</td>\n";
echo "		<td>\n";
$stop_tarif_uslug->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "</table>\n";
$sprav_uslug->to_html();
echo "<br>\n";


$money_rubl->to_html();
echo "Рублей\n";
//$money_kop->to_html();
//echo "Копеек\n";
$add_tarif->to_html();
echo "<hr>\n";
$tarif_net_table->to_html();

echo "</form>\n";
?>
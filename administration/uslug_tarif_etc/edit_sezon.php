<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/select_number.php");
include_once("../../classes/calendar.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");


//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$sezon_year= new select_number("_szn_year_", "1999", "2010");
$sezon_year->on_change= true;
$sezon_year->set_default(date("Y"));
$sezon_year->cath_event();

$name_sezon= new text("_nm_szn_");

$start_sezon= new calendar("_strt_szn_");
		$start_sezon->set_date_range_start($sezon_year->get_default());
		$start_sezon->set_date_range_stop($sezon_year->get_default());
		$start_sezon->set_year($sezon_year->get_default());

$stop_sezon= new calendar("_stp_szn_");
		$stop_sezon->set_date_range_start($sezon_year->get_default());
		$stop_sezon->set_date_range_stop($sezon_year->get_default());
		
$add_sezon= new submit("_add_szn_","Добавить сезон");

if($add_sezon->get_onclick())
	{
	  $sez_name= $name_sezon->get_value();
	  $sr= $start_sezon->get_full_data();
	  $stp= $stop_sezon->get_full_data();
	  $write_to_base= new db_write("sezon", "sezon_name, start_sezon, stop_sezon", "'$sez_name','$sr','$stp'");
	}

 $sezon_table= new db_table;
 $aaa= $sezon_year->get_default();
 $query= "SELECT * FROM sezon WHERE start_sezon >= '".$aaa."-01-01' AND stop_sezon <= '".$aaa."-12-31'";
 $sezon_table->set_query($query);
 $sezon_table->set_table_for_del("sezon", "id_sezon");
 $sezon_table->cath_event();



echo "<form method=\"POST\"  action=\"edit_sezon.php\">\n";
$back->to_html();
echo "администрирование->услуги тарифы, итд -> Сезоны\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Редактирование сезонов за \n";
$sezon_year->to_html();
echo "Год.\n";
echo "<br>\n";
echo "Название сезона\n";
$name_sezon->to_html();

echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С</td>\n";
echo "		<td>\n";
			$start_sezon->to_html();
echo "		</td>\n";
echo "		<td>По</td>\n";
echo "		<td>\n";
			$stop_sezon->to_html();
echo "      </td>\n";
echo "		<td>\n";
			$add_sezon->to_html();
echo "		</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "<hr>\n";
$sezon_table->to_html();


echo "</form>\n";
?>
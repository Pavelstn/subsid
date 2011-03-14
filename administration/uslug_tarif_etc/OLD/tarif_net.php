<?php
include_once("local_lib.php");
include_once("../../lib/function_define.php");
include_once("../../lib/money_manange.php");

include_once("local_class.php");
show_head("Редактирование тарифной сетки");

start_form("tarif_net.php");
/////////////////////////////////////////////////////////////////////////
if(!isset($sezon_year))
{
  $_slct_year= new adv_select_year("sezon_year", "current", "onchange= this.form.submit()");
  $sezon_year="2006";
}
else
{
  $_slct_year= new adv_select_year("sezon_year", $sezon_year, "onchange= this.form.submit()");
}
echo " год.\n";
echo "Сезон \n";
if(!isset($sezon)) $sezon="0"; 
select_sezon($sezon_year, $sezon, "onchange= this.form.submit()");


echo "<br>\n";
/////////////////////////////////////////////////////////////////////////////////////////////////
echo "<hr>\n";

$cal_start= new calendar2;
$cal_start->set_name("cal_start_");

$cal_start->set_full_data("current");
$cal_start->set_date_range_start($sezon_year);
$cal_start->set_date_range_stop($sezon_year);


$cal_start->cath_event();
//$cal_start->to_html();
//-----------------------------//
$cal_stop= new calendar2;
$cal_stop->set_name("cal_stop_");
$cal_stop->set_date_range_start($sezon_year);
$cal_stop->set_date_range_stop($sezon_year);
$cal_stop->set_full_data("current");
$cal_stop->cath_event();
//$cal_stop->to_html();
///////////////
echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С</td>\n";
echo "		<td>\n"; $cal_start->to_html(); echo"</td>\n";
echo "		<td>По</td>\n";
echo "		<td>\n"; $cal_stop->to_html(); echo"</td>\n";
echo "	</tr>\n";
echo "</table>\n";

$uslg= new n_select_uslug;
if(isset($uslug)) { $uslg->n_select_group_uslug($uslug); }
else 
	{
	  $uslg->n_select_group_uslug(0);
	  $uslug= "0";
	}
/////////////////////////////////////////
echo "	<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "		<tr>\n";
echo "			<td><input type=\"text\" name=\"rub\" size=\"6\"></td>\n";
echo "			<td>рублей</td>\n";
echo "			<td><input type=\"text\" name=\"kop\" size=\"4\"></td>\n";
echo "			<td>копеек.</td>\n";
echo "          <td><input type=\"submit\" value=\"Добавить\" name=\"add_tarif\"></td>\n";

echo "		</tr>\n";
echo "	</table>\n";

echo "<hr>\n";

//////////////////////////обработка /////////////////////////////////////
if(isset($add_tarif) AND isset($rub) AND isset($kop))
	{
	  //записываем данные в базу//

	  
	  $at= $cal_start->get_full_data();
	  $to= $cal_stop->get_full_data();
	  $mon= merge_rub_and_kop($rub, $kop);
	  
	  $query="INSERT INTO tarif_net (
	                                 id_sezon,
	                                 id_uslug,
	                                 start_date,
	                                 stop_date,
	                                 money_value
	                                 )
							VALUES (
							        '$sezon',
							        '$uslug',
							        '$at',
							        '$to',
							        '$mon'
							        
							        )";
		unset($at);
		unset($to);
		unset($mon);
		connect_to_my_db();
		$result= mysql_query($query) or die (mysql_error());
	}

////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////////////////////////////
if(!isset($sezon_net)) { $sezon_net= new net; }
//$query="SELECT id_tarif_net, id_uslug, start_date, stop_date, money_value FROM tarif_net";
//$query="SELECT * FROM tarif_net";
//$query="SELECT id_tarif_net, id_uslug, start_date, stop_date, money_value FROM tarif_net WHERE id_sezon= '$sezon' AND id_uslug= '$uslug'";
$query="SELECT tarif_net.id_tarif_net, sprav_uslug.uslug_name, tarif_net.start_date, tarif_net.stop_date, tarif_net.money_value FROM tarif_net, sprav_uslug WHERE tarif_net.id_uslug = sprav_uslug.id_uslug AND tarif_net.id_sezon =  '$sezon' AND tarif_net.id_uslug =  '$uslug'";
$sezon_net->set_query($query);

//$sezon_net->add_visible_row("id_sezon", "Сезон");
$sezon_net->add_visible_row("uslug_name", "Услуга");
$sezon_net->add_visible_row("start_date", "Дата начала");
$sezon_net->add_visible_row("stop_date", "Дата окончания");
$sezon_net->add_visible_row("money_value", "Стоимость");


$sezon_net->set_table_for_del("tarif_net", "id_tarif_net");
$sezon_net->cath_event();
$sezon_net->to_html_test2();
///////////////////////////////////////////////////////////////////////////
end_form();
//echo date_to_str("2006-05-31")."<br>\n";
// $aa= merge_rub_and_kop(20, 111);
// $bb= merge_rub_and_kop(10, 889);
// echo $aa."<br>\n";
// echo $bb."<br>\n";
// echo $aa+$bb;


?>
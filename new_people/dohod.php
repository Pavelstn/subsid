<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
//echo $session_id;
//echo "<br>\n";

echo "<body bgcolor=\"#6699FF\">\n";

include_once("../classes/submit.php");
include_once("../lib/navigate.php");
include_once("../classes/db_select.php");
include_once("../classes/calendar.php");
include_once("../classes/text.php");
include_once("../classes/db_table.php");
include_once("local_class.php");


$people_fio= new submit("ppl_fio","Ф.И.О.");
$people_udostover= new submit("ppl_udstvr","Удостоверения");
$people_dohod= new submit("ppl_dhd","Доходы");
$people_dohod->set_disabled(true);


$people_write= new submit("wrt_all","Записать");
$people_del= new submit("dl_all","&nbspУдалить");

$people_del->set_alert(true);
$people_del->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
////////////////////////////////////////////////////////////////////////////////
$sprav_dohod= new db_select("sprv_dhd", "sprav_dohod", "id_dohod", "dohod_name");
$dohod_start= new calendar("dhd_strt");
	$dohod_start->set_full_data("current");
	$dohod_start->cath_event();
$dohod_stop= new calendar("dhd_stp");
	$dohod_stop->set_full_data("current");
	$dohod_stop->cath_event();

$dohod_rubli= new text("dhd_rbl_");
	$dohod_rubli->set_size("6");
$dohod_kopeek= new text("dhd_kpk_");
	$dohod_kopeek->set_size("3");
$add_dohod= new submit("add_dhd","Добавить");

$dohod_table= new db_table;
$id_people= $_SESSION['_id_people'];
$rows= "dohod.id_dohod, sprav_dohod.dohod_name, dohod.at_date, dohod.to_date, dohod.value_money, dohod.value_money2";
$where= "dohod.id_people='$id_people' AND sprav_dohod.id_dohod= dohod.id_vid_dohod";


$dohod_table->set_query("SELECT ".$rows." FROM dohod, sprav_dohod WHERE ".$where." ORDER BY dohod.id_dohod ASC");
$dohod_table->set_table_for_del("dohod", "id_dohod");

$dohod_table->add_visible_row("dohod_name", "Вид дохода");
$dohod_table->add_visible_row("at_date", "С");
$dohod_table->add_visible_row("to_date", "По");
$dohod_table->add_visible_row("value_money", "Рублей");
$dohod_table->add_visible_row("value_money2", "Копеек");


$dohod_table->cath_event();

///////////////////////////////////////////////////////////////////////////////
if($people_fio->get_onclick()) 		  	link("../new_people/fio.php");
if($people_udostover->get_onclick())  	link("../new_people/udostover.php");
if($people_dohod->get_onclick())      	link("../new_people/dohod.php");

if($people_write->get_onclick())    	link("../new_people/write_all.php");
if($people_del->get_onclick())      	link("../new_people/del_all.php");

if($add_dohod->get_onclick())
	{
	  $wrt_dhd= new write_dohod;
	  
	    $wrt_dhd->id_people= $id_people;
	    
   		$wrt_dhd->id_vid_dohod= $sprav_dohod->get_value();
   		$wrt_dhd->at_date= 		$dohod_start->get_full_data();
   		$wrt_dhd->to_date= 		$dohod_stop->get_full_data();
   		$wrt_dhd->value_money= 	$dohod_rubli->get_value();
   		$wrt_dhd->value_money2= $dohod_kopeek->get_value();
   		$wrt_dhd->write();
	}




echo "<form method=\"POST\"  action=\"dohod.php\">\n";
echo "	<table border=\"0\" id=\"table1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\">\n";
//	<table border="0" id="table1" style="border-collapse: collapse">
echo "		<tr>\n";
echo "			<td>\n";
				$people_fio->to_html();
echo "          </td>\n";
echo "			<td>\n";
				$people_udostover->to_html();
echo "          </td>\n";
echo "			<td>\n";
                $people_dohod->to_html();
echo "          </td>\n";
echo "			<td bgcolor=\"#00FF00\">&nbsp;";
				$people_write->to_html();
echo "          &nbsp;</td>\n";
echo "			<td bgcolor=\"#FF0066\">&nbsp;";
				$people_del->to_html();
echo "          &nbsp;</td>\n";
echo "		</tr>\n";
echo "	</table>\n";
/////////////////////////////////////////////////////////
$sprav_dohod->to_html();
echo "<br>\n";
echo "<table border=\"0\"  style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>С</td>\n";
echo "		<td>\n";
$dohod_start->to_html();
echo "     </td>\n";
echo "		<td>ПО</td>\n";
echo "		<td>\n";
$dohod_stop->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "</table>\n";

echo "размер дохода \n";
$dohod_rubli->to_html();
echo " рублей  \n";
$dohod_kopeek->to_html();
echo " копеек\n";
$add_dohod->to_html();
echo "<br>\n";
echo "<br>\n";

$dohod_table->to_html();
////////////////////////////////////////////////
echo "</form>\n";
echo "</body>\n";
?>
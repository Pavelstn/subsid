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
include_once("../classes/text.php");
include_once("../classes/calendar.php");
include_once("../classes/db_table.php");

include_once("local_class.php");

$people_fio= new submit("ppl_fio","Ф.И.О.");
$people_udostover= new submit("ppl_udstvr","Удостоверения");
$people_udostover->set_disabled(true);
$people_dohod= new submit("ppl_dhd","Доходы");


$people_write= new submit("wrt_all","Записать");
$people_del= new submit("dl_all","&nbspУдалить");

$people_del->set_alert(true);
$people_del->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
////////////////////////////////////////////////////////////////////////////////
$sprav_udostover= new db_select("sprv_udstvr", "sprav_udostover", "id_udostover", "name_ud");
$udostover_seria= new text("udstvr_sr_");
	$udostover_seria->set_size("10");
$udostover_nomer= new text("udstvr_nmr_");
	$udostover_nomer->set_size("10");
$udostover_kem_vid= new text("udstvr_km_vd_");
	$udostover_kem_vid->set_size("50");
$udostover_kogda_vidan= new calendar("udstve_kgd_vdn");
$udostover_kogda_vidan->set_full_data("current");
$udostover_kogda_vidan->cath_event();

$add_udostover= new submit("add_udstvr","Добавить");

$udostover_table= new db_table;
$id_people= $_SESSION['_id_people'];
$rows= "udostover.id_udostover, sprav_udostover.name_ud, udostover.serial, udostover.nomer, udostover.who, udostover.date";
$where= "udostover.id_people='$id_people' AND sprav_udostover.id_udostover= udostover.id_vid_udostover";
$udostover_table->set_query("SELECT ".$rows." FROM udostover, sprav_udostover WHERE ".$where." ORDER BY udostover.id_udostover ASC");
$udostover_table->set_table_for_del("udostover", "id_udostover");

$udostover_table->add_visible_row("name_ud", "Вид удостоверения");
$udostover_table->add_visible_row("serial", "Серия");
$udostover_table->add_visible_row("nomer", "Номер");
$udostover_table->add_visible_row("who", "Кто выдал");
$udostover_table->add_visible_row("date", "Дата выдачи");


$udostover_table->cath_event();
///////////////////////////////////////////////////////////////////////////////
if($people_fio->get_onclick()) 		  link("../new_people/fio.php");
if($people_udostover->get_onclick())  link("../new_people/udostover.php");
if($people_dohod->get_onclick())      link("../new_people/dohod.php");

if($people_write->get_onclick())    link("../new_people/write_all.php");
if($people_del->get_onclick())      link("../new_people/del_all.php");


if($add_udostover->get_onclick())
	{
	  //
	  $wrt_udstvr= new write_udostover;
	  	
	  	$wrt_udstvr->id_people= $id_people;
	  	
	  	$wrt_udstvr->id_vid_udostover= $sprav_udostover->get_value();
  		$wrt_udstvr->serial= $udostover_seria->get_value();
  		$wrt_udstvr->nomer= $udostover_nomer->get_value();
  		$wrt_udstvr->who= $udostover_kem_vid->get_value();
  		$wrt_udstvr->date=$udostover_kogda_vidan->get_full_data();
  		
		$wrt_udstvr->data_add_new_udostover();
	}


echo "<form method=\"POST\"  action=\"udostover.php\">\n";
echo "	<table border=\"0\" id=\"table1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\">\n";
//	<table border="0" id="table1" style="border-collapse: collapse">
echo "		<tr>";
echo "			<td>\n";
				$people_fio->to_html();
echo "          </td>";
echo "			<td>";
				$people_udostover->to_html();
echo "          </td>";
echo "			<td>";
                $people_dohod->to_html();
echo "          </td>";
echo "			<td bgcolor=\"#00FF00\">&nbsp;";
				$people_write->to_html();
echo "          &nbsp;</td>";
echo "			<td bgcolor=\"#FF0066\">&nbsp;";
				$people_del->to_html();
echo "          &nbsp;</td>";
echo "		</tr>";
echo "	</table>";
/////////////////////////////////////////////////////////
$sprav_udostover->to_html();
echo "серия: \n";
$udostover_seria->to_html();
echo " номер:\n";
$udostover_nomer->to_html();
echo "<br>\n";
echo "кем выдан: \n";
$udostover_kem_vid->to_html();
echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td>\n";
$udostover_kogda_vidan->to_html();
echo "      </td>\n";
echo "		<td>\n";
$add_udostover->to_html();
echo "       </td>";
echo "	</tr>";
echo "</table>";
echo "<br>\n";
$udostover_table->to_html();
////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>
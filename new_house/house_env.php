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
include_once("../classes/select_number.php");


$zayav= new submit("zyv","Заявка");
$people= new submit("ppl","Жильцы дома");
$adres= new submit("adrs","Адрес домовладения");
$house_env= new submit("env","Жилищные условия");
$house_env->set_disabled(true);
$uslug= new submit("uslg","Услуги");

$write_all= new submit("wrt_all","Записать");
$del_all= new submit("dl_all","&nbspУдалить");

$del_all->set_alert(true);
$del_all->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
/////////////////////////////////////////////////////////////////////////////////////////////

$vladelec= new db_select("vldlc", "people", "id_people", "imya");
$id_home= $_SESSION['_id_house'];
$vladelec->set_query("SELECT id_people, imya FROM people WHERE id_home= $id_home");

$vid_sobstv= new db_select("vid_sbstv", "sprav_vd_sbsv", "id_vid", "name");
$obsh_ploshad= new text("obsh_plshd");
$obsh_ploshad->set_size("5");
$otapl_ploshad= new text("otpl_plshd");
$otapl_ploshad->set_size("5");

$kolvo_komnat= new select_number("klv_kmnt", "1", "20");
$vid_otopl= new db_select("vid_otpl", "sprav_vid_otopl", "id_vid_otopl", "name_vid_otopl");

////////////////////////////////////////////////////////////////////////////////////////////
if($zayav->get_onclick()) link("../new_house/zayav.php");
if($people->get_onclick()) link("../new_house/people.php");
if($adres->get_onclick()) link("../new_house/adres.php");
if($house_env->get_onclick()) link("../new_house/house_env.php");
if($uslug->get_onclick()) link("../new_house/uslug.php");

if($write_all->get_onclick()) link("../new_house/write_all_house.php");
if($del_all->get_onclick()) link("../new_house/del_all.php");
//////////////////////////////////////////////////////////////////////////////////
$_house_env= $_SESSION['_house_env'];

$vladelec->set_value($_house_env['vladelec']);
	$vladelec->cath_event();

$vid_sobstv->set_value($_house_env['vid_sobstv']);
	$vid_sobstv->cath_event();

$obsh_ploshad->set_value($_house_env['obsh_ploshad']);
	$obsh_ploshad->cath_event();
	
$otapl_ploshad->set_value($_house_env['otapl_ploshad']);	
	$otapl_ploshad->cath_event();
	
$kolvo_komnat->set_default($_house_env['kolvo_komnat']);	
	$kolvo_komnat->cath_event();
	
$vid_otopl->set_value($_house_env['vid_otopl']);	
	$vid_otopl->cath_event();
////////////////////////////////
$_house_env['vladelec']= $vladelec->get_value();
$_house_env['vid_sobstv']= $vid_sobstv->get_value();
$_house_env['obsh_ploshad']= $obsh_ploshad->get_value();
$_house_env['otapl_ploshad']= $otapl_ploshad->get_value();
$_house_env['kolvo_komnat']= $kolvo_komnat->get_default();
$_house_env['vid_otopl']= $vid_otopl->get_value(); 	
$_SESSION['_house_env']= $_house_env;
		
echo "<form method=\"POST\"  action=\"house_env.php\">\n";
echo "	<table border=\"0\" id=\"table1\" bgcolor=\"#C0C0C0\" style=\"border-collapse: collapse\">\n";
echo "		<tr>\n";
echo "			<td>\n";
				$zayav->to_html();
echo"           </td>\n";
echo "			<td>\n";
				$people->to_html();
echo "          </td>";
echo "			<td>\n";
				$adres->to_html();
echo "          </td>\n";
echo "			<td>\n";
				$house_env->to_html();
echo "          </td>\n";
echo "			<td>\n";
				$uslug->to_html();
echo "          </td>\n";
echo "			<td width=\"10\">&nbsp;</td>\n";
echo "			<td>\n";
echo "			<table border=\"2\" width=\"100%\" style=\"border-collapse: collapse\">\n";
echo "				<tr>\n";
echo "					<td bgcolor=\"#00FF00\">\n";
						$write_all->to_html();
echo "                  </td>\n";
echo "				</tr>\n";
echo "				<tr>\n";
echo "					<td bgcolor=\"#FF0000\">\n";
                         $del_all->to_html();
echo "                  </td>\n";
echo "				</tr>\n";
echo "			</table>\n";
echo "			</td>\n";
echo "		</tr>\n";
echo "	</table>\n";
///////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////
echo "	<table border=\"0\" style=\"border-collapse: collapse\">\n";
echo "		<tr>\n";
echo "			<td bgcolor=\"#00FFFF\">Владелец</td>\n";
echo "			<td bgcolor=\"#00FFFF\">\n";
$vladelec->to_html();
//<select size="1" name="D1"></select>
echo "           </td>\n";
echo "			<td bgcolor=\"#00FFFF\">Вид собственности</td>\n";
echo "			<td bgcolor=\"#00FFFF\">\n";
$vid_sobstv->to_html();
//<select size="1" name="D2"></select>
echo "          </td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td bgcolor=\"#9933FF\">Общая площадь</td>\n";
echo "			<td bgcolor=\"#9933FF\">\n";
$obsh_ploshad->to_html();
//<input type="text" name="T1" size="11">
echo "          m<sup>2</sup></td>\n";
echo "			<td bgcolor=\"#9933FF\">Отапливаемая площадь</td>\n";
echo "			<td bgcolor=\"#9933FF\">\n";
$otapl_ploshad->to_html();
//<input type="text" name="T2" size="11">
echo "          m<sup>2</sup></td>\n";
echo "		</tr>\n";
echo "		<tr>\n";
echo "			<td bgcolor=\"#9933FF\">Количество комнат</td>\n";
echo "			<td bgcolor=\"#9933FF\">\n";
$kolvo_komnat->to_html();
echo "          </select></td>\n";
echo "			<td bgcolor=\"#9933FF\">Вид отопления </td>\n";
echo "			<td bgcolor=\"#9933FF\">\n";
$vid_otopl->to_html();
//<select size="1" name="D4"></select>
echo "          </td>\n";
echo "		</tr>\n";
echo "	</table>\n";

////////////////////////////////////////////////
echo "</form>\n";
echo "</body>\n";
?>
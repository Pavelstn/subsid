<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
//echo $session_id;
//echo "<br>\n";
///////////////установка переменных//////////////////////


////////////////////////////////////////////////////////

echo "<body bgcolor=\"#6699FF\">\n";

include_once("../classes/submit.php");
include_once("../lib/navigate.php");
include_once("../classes/calendar.php");
include_once("../classes/text.php");
include_once("../classes/db_select.php");

$zayav= new submit("zyv","Заявка");
$zayav->set_disabled(true);
$people= new submit("ppl","Жильцы дома");
$adres= new submit("adrs","Адрес домовладения");
$house_env= new submit("env","Жилищные условия");
$uslug= new submit("uslg","Услуги");

$write_all= new submit("wrt_all","Записать");
$del_all= new submit("dl_all","&nbspУдалить");
/////////////////////////////////////////////////////////

$data_zayav= new calendar("dt_zyv");
$rasch_period= new calendar("rsch_prd");
$base_sheet= new text("bs_sht");
$sost_vipl= new db_select("sst_vpl", "select_sost_vipl", "id_vid_sost", "name_sost");
////////////////////////////////////////////////
$del_all->set_alert(true);
$del_all->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");

if($zayav->get_onclick()) link("../new_house/zayav.php");
if($people->get_onclick()) link("../new_house/people.php");
if($adres->get_onclick()) link("../new_house/adres.php");
if($house_env->get_onclick()) link("../new_house/house_env.php");
if($uslug->get_onclick()) link("../new_house/uslug.php");

if($write_all->get_onclick()) link("../new_house/write_all_house.php");
if($del_all->get_onclick()) link("../new_house/del_all.php");
///////////////////////////////////////////////////////////////////////////
////////////////////запись данных из сесси в форму/////////////////////////
//echo "<hr>\n";
$all_zayav= $_SESSION['_all_zayav'];
//echo $data_zayav;
//echo "<hr>\n";
//echo $all_zayav['set_date'];
$data_zayav->set_full_data($all_zayav['set_date']);
$data_zayav->cath_event();

$rasch_period->set_full_data($all_zayav['rasch_period']);
$rasch_period->cath_event();

$base_sheet->set_value($all_zayav['base_sheet']);
$base_sheet->cath_event();

$sost_vipl->set_value($all_zayav['sost_vipl']);
$sost_vipl->cath_event();
/////////////////зпись данных из формы в сессию///////////////////////////
$all_zayav['set_date']= $data_zayav->get_full_data();
$all_zayav['rasch_period']= $rasch_period->get_full_data();
$all_zayav['base_sheet']= $base_sheet->get_value();
$all_zayav['sost_vipl']= $sost_vipl->get_value();

$_SESSION['_all_zayav']= $all_zayav;
////////////////////////////////////////////////////////////////////////
echo "<form method=\"POST\"  action=\"zayav.php\">\n";
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
/////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////
echo "	<table border=\"0\" id=\"table1\" style=\"border-collapse: collapse\">\n";
echo "	<tr>";
echo " 		<td>Дата предоставления заявки</td>\n";
echo "		<td>\n";
			$data_zayav->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>Начало расчетного периода</td>\n";
echo "		<td>\n";
			$rasch_period->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>Номер базового счета</td>\n";
echo "		<td>\n";
			$base_sheet->to_html();
echo "      </td>";
echo "	</tr>\n";
echo "	<tr>\n";
echo "		<td>Состояние выплаты</td>\n";
echo "		<td>\n";
			$sost_vipl->to_html();
echo "      </td>\n";
echo "	</tr>\n";
echo "</table>\n";


////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>
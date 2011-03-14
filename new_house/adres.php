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
include_once("../classes/kladr.php");

$zayav= new submit("zyv","Заявка");
$people= new submit("ppl","Жильцы дома");
$adres= new submit("adrs","Адрес домовладения");
$adres->set_disabled(true);
$house_env= new submit("env","Жилищные условия");
$uslug= new submit("uslg","Услуги");

$write_all= new submit("wrt_all","Записать");
$del_all= new submit("dl_all","&nbspУдалить");

$del_all->set_alert(true);
$del_all->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
////////////////////////////////////////////////////////////////////////////////
$house_adres= new kladr("hus_adr");

///////////////////////////////////////////////////////////////////////////////
if($zayav->get_onclick()) link("../new_house/zayav.php");
if($people->get_onclick()) link("../new_house/people.php");
if($adres->get_onclick()) link("../new_house/adres.php");
if($house_env->get_onclick()) link("../new_house/house_env.php");
if($uslug->get_onclick()) link("../new_house/uslug.php");

if($write_all->get_onclick()) link("../new_house/write_all_house.php");
if($del_all->get_onclick()) link("../new_house/del_all.php");
//////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
$adrs_hs= $_SESSION['_adres_house'];

$house_adres->set_village($adrs_hs['code_cladr']);
$house_adres->set_street($adrs_hs['code_street']);
$house_adres->set_house($adrs_hs['nomer_doma']);
$house_adres->set_korp($adrs_hs['nomer_korpusa']);
$house_adres->set_kvart($adrs_hs['nomer_kvartiri']);
$house_adres->cath_event();


///////////////
$adrs_hs['code_cladr']= $house_adres->get_village();
$adrs_hs['code_street']= $house_adres->get_street();
$adrs_hs['nomer_doma']= $house_adres->get_house(); 
$adrs_hs['nomer_korpusa']= $house_adres->get_korp();
$adrs_hs['nomer_kvartiri']= $house_adres->get_kvart();
$_SESSION['_adres_house']= $adrs_hs;



echo "<form method=\"POST\"  action=\"adres.php\">\n";
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
/////////////////////////////////////////////////////////
$house_adres->to_html();
////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>
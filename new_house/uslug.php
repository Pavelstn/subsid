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
include_once("../classes/select_uslug.php");
include_once("../classes/text.php");
include_once("../classes/db_table.php");
include_once("local_class.php");

$zayav= new submit("zyv","Заявка");
$people= new submit("ppl","Жильцы дома");
$adres= new submit("adrs","Адрес домовладения");
$house_env= new submit("env","Жилищные условия");
$uslug= new submit("uslg","Услуги");
$uslug->set_disabled(true);

$write_all= new submit("wrt_all","Записать");
$del_all= new submit("dl_all","&nbspУдалить");

$del_all->set_alert(true);
$del_all->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
/////////////////////////////////////////////////////////////////////////////////////////////////
$sprav_uslug= new n_select_uslug();
$ed_uslug= new text("ed_uslg_");
$ed_uslug->set_size("5");
$add_new_uslug= new submit("nw_uslg","Добавить услугу");
/////////////////////////////////
$id_home= $_SESSION['_id_house'];

$uslug_table= new db_table;

//$tables= "uslug.id_uslug, sprav_uslug.uslug_name, uslug.value_uslug";
$tables= "uslug.id_uslug, sprav_uslug.uslug_name";
$uslug_table->set_query("SELECT ".$tables." FROM uslug, sprav_uslug WHERE  id_home= $id_home AND uslug.id_vid_uslug= sprav_uslug.id_uslug"  );
$uslug_table->set_table_for_del("uslug", "id_uslug");
//$uslug_table->set_edit_row(true);
$uslug_table->add_visible_row("uslug_name", "Название услуги");
$uslug_table->add_visible_row("value_uslug", "Величина");
$uslug_table->cath_event();

///////////////////////////////////////////////////////////////////////////////////////////////
if($zayav->get_onclick()) link("../new_house/zayav.php");
if($people->get_onclick()) link("../new_house/people.php");
if($adres->get_onclick()) link("../new_house/adres.php");
if($house_env->get_onclick()) link("../new_house/house_env.php");
if($uslug->get_onclick()) link("../new_house/uslug.php");

if($write_all->get_onclick()) link("../new_house/write_all_house.php");
if($del_all->get_onclick()) link("../new_house/del_all.php");
////////////////////////////////////////////////////////////////////////////////
//echo $sprav_uslug->get_value();
if($add_new_uslug->get_onclick())
{
 //echo $sprav_uslug->get_value()."<br>\n";
 //echo $ed_uslug->get_value();
  $wrt_uslg= new write_uslug($id_home, $sprav_uslug->get_value(), $ed_uslug->get_value());
}



////////////////////////////////////////////////////////////////////////////////

echo "<form method=\"POST\"  action=\"uslug.php\">\n";
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
///////////////////////////////////////////////////////////////////////////
$sprav_uslug->to_html();
//$ed_uslug->to_html();
$add_new_uslug->to_html();
echo "<br>\n";
$uslug_table->to_html();

////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>
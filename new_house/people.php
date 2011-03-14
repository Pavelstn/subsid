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
include_once("../classes/db_table2.php");

$zayav= 	new submit("zyv","Заявка");
$people= 	new submit("ppl","Жильцы дома");
				$people->set_disabled(true);
$adres= 	new submit("adrs","Адрес домовладения");
$house_env= new submit("env","Жилищные условия");
$uslug= 	new submit("uslg","Услуги");

$write_all= new submit("wrt_all","Записать");
$del_all= 	new submit("dl_all","&nbspУдалить");

$del_all->set_alert(true);
$del_all->set_alert_text("Вы действительно хотите удалить эту запись? ВНИМАНИЕ данные невозможно будет восстановить.");
///////////////////////////////////////////////////////////////////
$new_people= 	new submit("nw_ppl","Добавить жильца");
$people_table= 	new db_table2;

$id_home= $_SESSION['_id_house'];

$rows="people.id_people, people.familia, people.imya, people.otchestvo, people.date, sprav_subsid_pravo.name_pravo";

$tables= "people, sprav_subsid_pravo";
$where= "people.id_home= '$id_home' AND sprav_subsid_pravo.id_pravo= people.to_be";
$query_people= "SELECT ".$rows." FROM ".$tables." WHERE ".$where." ORDER BY people.id_people ASC";

//$query_people= "SELECT * FROM people WHERE id_home= $id_home";
//$people_table->button_flag= false;
$people_table->set_query($query_people);

//echo $query_people;

$people_table->set_table_for_del("people", "id_people");
$people_table->set_edit_row(true);
$people_table->set_edit_path("../new_people/edit_people.php");
$people_table->cath_event();
$people_table->add_visible_row("id_people", "№ В базе");
$people_table->add_visible_row("familia", "Фамилия");
$people_table->add_visible_row("imya", "Имя");
$people_table->add_visible_row("otchestvo", "Отчество");
$people_table->add_visible_row("date", "День рожд.");
$people_table->add_visible_row("name_pravo", "Право на субсидию");

//////////////////////////////////////////////////////////////////
if($zayav->get_onclick()) link("../new_house/zayav.php");
if($people->get_onclick()) link("../new_house/people.php");
if($adres->get_onclick()) link("../new_house/adres.php");
if($house_env->get_onclick()) link("../new_house/house_env.php");
if($uslug->get_onclick()) link("../new_house/uslug.php");

if($write_all->get_onclick()) link("../new_house/write_all_house.php");
if($del_all->get_onclick()) link("../new_house/del_all.php");


if($new_people->get_onclick()) link("../new_people/add_new_people.php");




echo "<form method=\"POST\"  action=\"people.php\">\n";
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
//////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
//echo "	<table border=\"0\"  style=\"border-collapse: collapse\">";
//echo "		<tr>";
//echo "			<td>\n";
			$new_people->to_html();
//echo "          </td>";
//echo "		</tr>";
//echo "		<tr>";
//echo "			<td>\n";
echo "<br>\n";
echo "<br>\n";
		$people_table->to_html();
//echo "          </td>";
//echo "		</tr>";
//echo "	</table>";
////////////////////////////////////////////////
echo "</form>";
echo "</body>\n";
?>
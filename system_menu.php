<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();

echo "<body bgcolor=\"#00CCFF\">\n";

include_once("classes/submit.php");
include_once("lib/navigate.php");

$exit= new submit("ext","Выход");
$admin= new submit("admin_sys","Администрирование_системы");
$list_people= new submit("lst_ppl","Просмотр записей");
$form_money= new submit("form_mny","Формирование выплат");

if($exit->get_onclick()) link("index.html");
if($admin->get_onclick()) link("administration/index.php");
if($list_people->get_onclick()) link("list_people/index.php");

if($form_money->get_onclick()) link("calculate_subsid/index.php");


////////////////////////////////////////////////////////////////////////////////////////////
echo "<form method=\"POST\" action=\"system_menu.php\">\n";

echo "<table border=\"0\" width=\"100%\" id=\"table1\" style=\"border-collapse: collapse\">\n";
echo "	<tr>\n";
echo "		<td width=\"30%\">\n";

	$exit->to_html();

echo "		<td><center>\n";
echo "</center></td>\n";
echo "		<td width=\"30%\">&nbsp;</td>\n";
echo "	</tr>\n";
echo "</table>\n";
echo "<hr>\n";





///////////////////////////////////////////////////////////////////////////////////////////////
if($_SESSION['id_group']== 1)
  {
       echo "<center>\n";
       $admin->to_html();
	   echo "</center>\n";
  }
  echo "<br>\n";
///////////////////////////////////////////////////////////////////////////////////
       echo "<center>\n";
       $list_people->to_html();
	   echo "</center>\n";
	   echo "<br>\n";
// ///////////////////////////////////////////////////////////////////////////////////
       echo "<center>\n";
       $form_money->to_html();
	   echo "</center>\n";
	   echo "<br>\n";

echo "</form>\n";

?>

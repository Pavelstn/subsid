<?php
include_once("submit.php");
include_once("text.php");
include_once("password.php");
include_once("hidden.php");
include_once("table.php");
include_once("message.php");

include_once("webpage.php");
echo "<form method=\"POST\" action=\"index.php\">";

$msg= new message;

$aa= new submit;
$aa->set_name("qaz");
$aa->set_value("test");
//$aa->set_disabled(true);
$aa->set_alert(true);
$aa->set_alert_text('Вы действительно хотите сохранить эту запись?');
$aa->to_html();
//$aa->help();

//////////////////////////////////////////////////////
$pr= new submit;
$pr->set_name("press_link");
$pr->set_value("переход");
//$aa->set_disabled(true);
//$pr->set_alert(true);
//$pr->set_alert_text('Вы действительно хотите сохранить эту запись?');

if(isset($press_link))
	{
	  //
	  echo "press_link";
	  echo "<script language=JavaScript>";
	  echo "location.href=\"help2.htm\"";
	  echo "</script>";
	}


$pr->to_html();

echo "<hr>\n";


//function alert()
//{
//  echo "<script language=JavaScript>";
//  echo "window.alert(\"Пароль не верен.\")";
//  echo "</script>";
//}

$bb= new text;
$bb->set_name("txt");
$bb->set_size(40);
$bb->set_maxlength(99);
$bb->set_value("здесь должен быть текст");
$bb->cath_event();
$bb->to_html();

$msg->add_alert("хуй.");

$cc= new password;
$cc->set_name("pss");
$cc->cath_event();
$cc->to_html();

if($cc->get_value()!="хуй") $msg->add_alert("Пароль не верен.");
echo "<br>\n";
$dd= new hidden;
$dd->set_name("hddn");
$dd->set_value("hidden_value_text");
$dd->to_html();

$msg->to_html();

$table_udostover= new table; 
		  $query="SELECT id_udostover, name_ud FROM sprav_udostover ORDER BY id_udostover ASC";
		  $table_udostover->add_visible_row("name_ud", "Вид удостоверения");
		  $table_udostover->set_query($query);
		  $table_udostover->set_edit_row(true);
		  $table_udostover->set_table_for_del("sprav_udostover", "id_udostover");
		  $table_udostover->cath_event();
		  $table_udostover->to_html_test2();


// $page= new webpage;
// $page->add_object($aa);
// $page->add_object($bb);
// $page->add_object($cc);
// $page->add_object($dd);
// $page->add_object($table_udostover);


//$page->to_html();

echo "</form>";
?>
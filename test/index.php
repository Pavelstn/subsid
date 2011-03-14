<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
include_once("../classes/text.php");
include_once("../classes/db_write.php");
include_once("../classes/database_work.php");


////////////////////////////////////////////////////////


echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("../system_menu.php");


echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; 
///////////////////////////////////////////////////////////////////
class data_struct
	{
	  var $val1="0";
	  var $val2="0";
	  var $val3="0";
	}


echo "<br>\n";

  	$calk= new submit("_calk_","Добавить"); 
	$calk->to_html(); echo "<hr>\n";
if($calk->get_onclick())
{


	$val1= new text("text1");
	$val1->to_html();
	echo "<br>\n";
	$val2= new text("text2");
	$val2->to_html();
	echo "<br>\n";

	$val3= new text("text3");
	$val3->to_html();
	
	$strkt= new data_struct;

$strkt->val1= $val1->get_value();
$strkt->val2= $val2->get_value();
$strkt->val3= $val3->get_value();

$aaa= serialize($strkt);

$dbwrt= new db_write("test", "id_test, name_1", " '', '".$aaa."'");
}





echo "<hr>\n";
$list= new submit("_list_","вывести"); 
$list->to_html();
if($list->get_onclick())
{
  echo "<br>\n";

$load= new database_work;
//db_load("SELECT * FROM test");
$load->connect_db();
$result= mysql_query("SELECT * FROM test") or die (mysql_error());
	  	while($row= mysql_fetch_array($result))
	  		{
			  //echo $row["name_1"]."<br>\n";
			  $unser_obj= unserialize($row["name_1"]);
			  echo $unser_obj->val1;
			  echo " ";
			  echo $unser_obj->val2;
			  echo " ";
			  echo $unser_obj->val3;
			  echo "<br>\n";
			}
}
///////////////////////////////////////////
echo "</form>\n";
?>
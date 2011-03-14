<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$new_group= new text("_new_grup_");

$add_new_group= new submit("_add_new_grup_","Добавить группу");
	if($add_new_group->get_onclick())
		{
		  //
		  $values= $new_group->get_value();
		  $write_to_base= new db_write("group_uslug", "group_name", "'$values'");
		}

$group_uslug_table= new db_table;
$group_uslug_table->set_query("SELECT * FROM group_uslug");
$group_uslug_table->set_table_for_del("group_uslug", "id_group_uslug");
$group_uslug_table->add_visible_row("group_name", "Название группы");
$group_uslug_table->cath_event();

echo "<form method=\"POST\"  action=\"edit_group_uslug.php\">\n";
$back->to_html();
echo "администрирование->услуги тарифы->группы услуг\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Название группы услуг\n";
$new_group->to_html();
$add_new_group->to_html();
echo "<br>\n";
echo "<br>\n";
$group_uslug_table->to_html();

echo "</form>\n";
?>
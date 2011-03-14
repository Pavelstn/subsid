<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");


//виды удостоверений//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////
$new_udostover= new text("_new_udstvr_");
	$new_udostover->set_size(50);	
$add_udostover= new submit("_add_udstvr_","Добавить");
	if($add_udostover->get_onclick())
		{
		  $values= $new_udostover->get_value();
		  $write_to_base= new db_write("sprav_udostover", "name_ud", "'$values'");
		}


$udostover_table= new db_table;
	$udostover_table->set_query("SELECT id_udostover, name_ud FROM sprav_udostover ORDER BY id_udostover ASC");
	$udostover_table->add_visible_row("name_ud", "Удостоверение");
	$udostover_table->set_table_for_del("sprav_udostover", "id_udostover");
	$udostover_table->cath_event();

echo "<form method=\"POST\"  action=\"edit_vid_udostover.php\">\n";
$back->to_html();
echo "администрирование->удостоверения, льготы->редактирование видов удостоверений\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Название удостоверения \n";
$new_udostover->to_html();
$add_udostover->to_html();
echo "<br>\n";
$udostover_table->to_html();

 

echo "</form>\n";
?>
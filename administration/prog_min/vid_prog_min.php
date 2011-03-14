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
$new_vid_prog_min= new text("_nw_vd_prg_mn_");

$add_new_prog_min= new submit("_add_new_prog_min_","Добавить вид");
	if($add_new_prog_min->get_onclick())
		{
		  //
		  $values= $new_vid_prog_min->get_value();
		  $write_to_base= new db_write("prog_min", "name_soc_kat", "'$values'");
		}

$prog_min_table= new db_table;
	$prog_min_table->set_query("SELECT * FROM prog_min");
	$prog_min_table->set_table_for_del("prog_min", "id_prog_min");
	$prog_min_table->add_visible_row("name_soc_kat", "Название прожиточного минимума");
	$prog_min_table->cath_event();


echo "<form method=\"POST\"  action=\"vid_prog_min.php\">\n";
$back->to_html();
echo "администрирование->прожиточный минимум->Виды прожиточного минимума\n<hr>\n";
//////////////////////////////////////////////////////////////////
echo "Название прожиточного минимума \n";
$new_vid_prog_min->to_html();
$add_new_prog_min->to_html();
echo "<br>\n";
echo "<br>\n";
$prog_min_table->to_html();




echo "</form>\n";
?>
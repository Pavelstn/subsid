<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/db_select.php");
include_once("../../classes/db_table.php");
include_once("../../classes/db_write.php");
include_once("../../classes/db_load.php");
include_once("../../classes/database_work.php");
include_once("../../classes/hidden.php");

//виды услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
	
echo "<form method=\"POST\"  action=\"edit_vid_uslug.php\">\n";
$back->to_html();
echo "администрирование->услуги тарифы->виды услуг\n<hr>\n";
/////////////////////////////////////////////////



$group_uslug= new db_select("_grup_uslg_", "group_uslug", "id_group_uslug", "group_name");
$group_uslug->submit= false;

$id_rw= new hidden("_hireen_");


$new_uslug= new text("_new_uslg_");
	$new_uslug->set_size("40");

$ed_izm_uslug= new text("_ed_izm_uslg_");
	$ed_izm_uslug->set_size("10");

$update_vid_uslug= new submit("_updt_vid_uslg_","Обновить");
	if($update_vid_uslug->get_onclick())
		{
		  $dtbs_wrk= new database_work;
		  $dtbs_wrk->connect_db();
		  $aaa= $group_uslug->get_value();
		  $bbb= $new_uslug->get_value();
		  $ccc= $ed_izm_uslug->get_value();
		  $ddd= $id_rw->get_value();
		  $query= "UPDATE sprav_uslug SET id_group_uslug='$aaa', uslug_name= '$bbb', ed_izm= '$ccc' WHERE id_uslug= '$ddd'";
		  $result= mysql_query($query) or die (mysql_error());
		  $dtbs_wrk->dis_connect_db();
		}
//////////////////////////////////////////////
$add_vid_uslug= new submit("_add_vid_uslg_","Добавить");
	if($add_vid_uslug->get_onclick())
		{
		   $aaa= $group_uslug->get_value();
		   $bbb= $new_uslug->get_value();
		   $ccc= $ed_izm_uslug->get_value();
		  //$values= $new_group->get_value();
		  $write_to_base= new db_write("sprav_uslug", "id_group_uslug, uslug_name, ed_izm", "'$aaa','$bbb','$ccc'");
		}

if(isset($edit) AND isset($id_row))
	{
	  
	  
	  $db_lad= new db_load("SELECT * FROM sprav_uslug WHERE  id_uslug= '$id_row'");
	  		$id_rw->set_value($id_row);
	  		$group_uslug->set_value($db_lad->row["id_group_uslug"]);
	  		$new_uslug->set_value($db_lad->row["uslug_name"]);
	  		$ed_izm_uslug->set_value($db_lad->row["ed_izm"]);
	}	
else
	{
	  $new_uslug->set_value("");
	  $ed_izm_uslug->set_value("");
	  
	  

	  $vid_uslug_table= new db_table;
		
	  $vid_uslug_table->set_query("SELECT sprav_uslug.id_uslug, group_uslug.group_name, sprav_uslug.uslug_name, sprav_uslug.ed_izm FROM sprav_uslug, group_uslug WHERE group_uslug.id_group_uslug= sprav_uslug.id_group_uslug ORDER BY group_uslug.id_group_uslug ASC");
	  $vid_uslug_table->set_table_for_del("sprav_uslug", "id_uslug");
	  $vid_uslug_table->set_edit_row(true);

      $vid_uslug_table->add_visible_row("group_name", "Название группы");
      $vid_uslug_table->add_visible_row("uslug_name", "Название услуги");
      $vid_uslug_table->add_visible_row("ed_izm", "Единица измерения");
      $vid_uslug_table->cath_event();
	}
	
//////////////////////////////////////////////////////////////	

//////////////////////////////////////////////////////////////////
$id_rw->to_html();
echo "Название группы услуг\n";
$group_uslug->to_html();
echo "<br>\n";
echo "Название услуги\n";
$new_uslug->to_html();
echo "\n Единица измерения \n";
$ed_izm_uslug->to_html();
if(isset($edit))
	{
	  $update_vid_uslug->to_html();
	}
else
	{
	  $add_vid_uslug->to_html();
	  $vid_uslug_table->to_html();
	}





echo "</form>\n";
?>
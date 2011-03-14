<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");

//услуги тарифы итд//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$edit_group_uslug= new submit("edt_grp_uslg","Редактирование групп услуг");
	if($edit_group_uslug->get_onclick()) link("edit_group_uslug.php");
	
$edit_vid_uslug= new submit("edt_vid_uslg","Редактирование видов услуг");
   if($edit_vid_uslug->get_onclick()) link("edit_vid_uslug.php");

$edit_sezon= new submit("edt_sezn","Редактирование сезонов");
	if($edit_sezon->get_onclick()) link("edit_sezon.php");
	
$edit_tarif_net= new submit("edt_tarif_net","Редактирование тарифной сетки");
	if($edit_tarif_net->get_onclick()) link("edit_tarif_net.php");
	
$test= new submit("_tst_","test");
	if($test->get_onclick()) link("test.php");

echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование->услуги тарифы итд\n<hr>\n";
//////////////////////////////////////////////////////////////////
$edit_group_uslug->to_html();
$edit_vid_uslug->to_html();
$edit_sezon->to_html();
$edit_tarif_net->to_html();
echo "<hr>\n";
$test->to_html();


echo "</form>\n";
?>
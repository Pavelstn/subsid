<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");

//�������������, ������//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ �����");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$edit_vid_udostover= new submit("edt_grp_uslg","�������������� ����� �������������");
	if($edit_vid_udostover->get_onclick()) link("edit_vid_udostover.php");
	
$edit_lgot= new submit("edt_lgt","�������������� �����");
   if($edit_lgot->get_onclick()) link("edit_lgot.php");

// $edit_sezon= new submit("edt_sezn","�������������� �������");
// 	if($edit_sezon->get_onclick()) link("edit_sezon.php");
 	
// $edit_tarif_net= new submit("edt_tarif_net","�������������� �������� �����");
// 	if($edit_tarif_net->get_onclick()) link("edit_tarif_net.php");
 	
// $test= new submit("_tst_","test");
//	if($test->get_onclick()) link("test.php");


echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "�����������������->�������������, ������\n<hr>\n";
//////////////////////////////////////////////////////////////////
$edit_vid_udostover->to_html();
$edit_lgot->to_html();
// $edit_sezon->to_html();
// $edit_tarif_net->to_html();
// echo "<hr>\n";
// $test->to_html();



echo "</form>\n";
?>
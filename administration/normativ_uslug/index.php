<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");


echo "<body bgcolor=\"#CC99FF\">";
//����������� �������//
$back= new submit("bck","^ �����"); 
	if($back->get_onclick()) link("../index.php");
	
 $vid_prog_min= new submit("_vid_prg_min_","���� ������������ ��������");
 	if($vid_prog_min->get_onclick()) link("vid_prog_min.php");
 
 $calendar_prog_min= new submit("_clndr_prg_mn_","��������� ����������� ���������");
 	if($calendar_prog_min->get_onclick()) link("calendar_prog_min.php");







echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "�����������������->����������� �������\n<hr>\n";
$vid_prog_min->to_html();
$calendar_prog_min->to_html();









echo "</form>\n";
?>
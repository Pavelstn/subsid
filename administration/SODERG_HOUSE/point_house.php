<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");
include_once("../../classes/select_uslug.php");

//������ �����//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ �����");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////
$sprav_uslug= new n_select_uslug();





echo "<form method=\"POST\"  action=\"point_house.php\">\n";
$back->to_html();
echo "�����������������->���������� �����->��������� �� ������ \"���������� �����\"\n<hr>\n";
//////////////////////////////////////////////////////////////////
$sprav_uslug->to_html();





echo "</form>\n";
?>
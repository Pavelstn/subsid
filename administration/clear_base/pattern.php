<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");

//������ �����//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ �����");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////






echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "�����������������->xxxxxxxxxxxxxxx\n<hr>\n";
//////////////////////////////////////////////////////////////////






echo "</form>\n";
?>
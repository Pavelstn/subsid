<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("../../classes/text.php");

//группы услуг//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("index.php");
/////////////////////////////////////////////////






echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование->xxxxxxxxxxxxxxx\n<hr>\n";
//////////////////////////////////////////////////////////////////






echo "</form>\n";
?>
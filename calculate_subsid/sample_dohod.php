<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
////////////////////////////////////////////////////////

include_once("./new_lib/private_dohod.php");






echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ �����"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","����������"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
///////////////////////////////////////////////////////////////
$dohod= new private_dohod(3);
$dohod->people= 6; //������� ����� ������� � �����//
$dohod->subsid_people= 6; //������� ������� ����� ����� �� ��������//
$dohod->calc_vse();

echo "������������� ����� ".$dohod->sred_dush_doh."<br>\n";
echo "��������� ����� ����� ".$dohod->sov_dohod_semi."<br>\n";
///////////////////////////////////////////
echo "</form>\n";
?>
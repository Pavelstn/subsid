<?php
 include_once("../classes/submit.php");
 include_once("../lib/navigate.php");
////////////////////////////////////////////////////////

include_once("./new_lib/calc_prog_min.php");
include_once("./new_lib/price.php");
include_once("./new_lib/core_lgot.php");
include_once("./new_lib/calc_deng.php");
include_once("./new_lib/private_dohod.php");
include_once("./new_lib/calc_subsid.php");



echo "<body bgcolor=\"#FFFFD4\">";
$back= new submit("bck","^ �����"); 
	if($back->get_onclick()) link("../system_menu.php");
$calk= new submit("_calk_","����������"); 

echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html(); echo "<br>\n"; $calk->to_html(); echo "<hr>\n";
//////////////////   ���������� ���������� ������ /////////////////////////////////////////////
$price= new price;
	$price->scroll_day("2006-01-01", "2006-01-31"); //���������� ������ ��� � ������� ���������� �������//
	
$lgot= new core_lgot;
	$lgot->init_lgot();
	
	
	
	
$strt= "2006-01-01";
$stp=  "2006-01-31";
//////////////////////////////////////////////////////////////////////////////////////////////
$prog_min= new calc_prog_min(3, $strt);
echo "� ���� ��������� ".$prog_min->all_people." �������<br>\n";
echo "�� ��� ����� �� �������� ����� ".$prog_min->subsid_people." �������<br>\n";
echo "����� ����������� ��������� ����� ".$prog_min->summ_prog_min." ������<br>\n";
//-------------------//
echo "<hr>\n";
$dohod= new private_dohod(3);
$dohod->people= $prog_min->all_people; //������� ����� ������� � �����//
$dohod->subsid_people= $prog_min->subsid_people; //������� ������� ����� ����� �� ��������//
$dohod->calc_vse();
echo "������������� ����� ".$dohod->sred_dush_doh."<br>\n";
echo "��������� ����� ����� ".$dohod->sov_dohod_semi."<br>\n";
//-------------------//
echo "<hr>\n";
$all_deng= calc_deng(3, $strt, $stp , $price, $lgot);
echo " ����� ��������� ".$all_deng." ������<br>\n";
//-------------------//
//$subsid= calc_subsid($OCH, $MDD, $D, $SDD, $prog_min )
$OCH= $all_deng;  //������� � ������//
$MDD= 22;         //�����������     //
$D= $dohod->sov_dohod_semi;    //���������� ����� �����///
$SDD= $dohod->sred_dush_doh;   //������������� �����
$prog_min= $prog_min->summ_prog_min ;//��������� �������� ������������ ��������//

$subsid= calc_subsid($OCH, $MDD, $D, $SDD, $prog_min);
echo "<hr>\n";
echo $subsid."<br>\n";
///////////////////////////////////////////
echo "</form>\n";
?>
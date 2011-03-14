<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");

//содержание жилья//
echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$norm_house= new submit("_nrm_hus_","Нормы на жилплощадь");
	if($norm_house->get_onclick()) link("norm_house.php");
	
$point_house= new submit("_point_house_","Указатель на услугу  содержание жилья");
   if($point_house->get_onclick()) link("point_house.php");




echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование->содержание жилья\n<hr>\n";
//////////////////////////////////////////////////////////////////
$norm_house->to_html();
//$point_house->to_html();



echo "</form>\n";
?>
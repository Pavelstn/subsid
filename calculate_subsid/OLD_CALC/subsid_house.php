<?php
 include_once("../classes/submit.php");

 include_once("../lib/navigate.php");


include_once("./lib/func_calc_subsid.php");

echo "<body bgcolor=\"#FFFFD4\">";

if(isset($id_row) and isset($edit))
	{
	  //echo $id_row;
	  $id_house= $id_row;
	}
	




$back= new submit("bck","^ �����"); 
	if($back->get_onclick()) link("index.php");
	


$calk= new submit("_calk_","����������"); 



echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html();


echo "<hr>\n";
echo "������ �������� ���������� \n";
echo func_calc_subsid($id_house, "2006-03-01", "2006-03-31");
echo " ������.<br>\n";

echo "</form>\n";
?>
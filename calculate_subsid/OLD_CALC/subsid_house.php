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
	




$back= new submit("bck","^ Назад"); 
	if($back->get_onclick()) link("index.php");
	


$calk= new submit("_calk_","Подсчитать"); 



echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html();


echo "<hr>\n";
echo "размер субсидии составляет \n";
echo func_calc_subsid($id_house, "2006-03-01", "2006-03-31");
echo " рублей.<br>\n";

echo "</form>\n";
?>
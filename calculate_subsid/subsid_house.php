<?php
 include_once("../classes/submit.php");

 include_once("../lib/navigate.php");


//include_once("./lib/func_calc_subsid.php");
include_once("./lib/func_calc_subsid.php");


echo "<body bgcolor=\"#FFFFD4\">";

if(isset($id_row) and isset($edit))
	{
	  //echo $id_row;
	  $id_house= $id_row;
	}
	




$back= new submit("bck","^ Ќазад"); 
	if($back->get_onclick()) link("index.php");
	


$calk= new submit("_calk_","ѕодсчитать"); 



echo "<form method=\"POST\"  action=\"index.php\">\n";
 $back->to_html();


echo "<hr>\n";
//echo "размер расхода составл€ет \n";
//echo func_calc_subsid($id_house, "2006-03-01", "2006-03-31");
// $deng= calc_all_uslug($id_house, "2006-01-01", "2006-01-31");
// echo "<hr>\n";
// echo " по норме=".$deng["NORM"]."<br>\n";
// echo " по факту=".$deng["FACT"]."<br>\n";
echo "размер субсидии=".func_calc_subsid($id_house, "2006-01-01", "2006-01-31")." <br>\n";


//echo " рублей.<br>\n";

echo "</form>\n";
?>
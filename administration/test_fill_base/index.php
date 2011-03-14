<?php
include_once("../../classes/submit.php");
include_once("../../lib/navigate.php");
include_once("function.php");


echo "<body bgcolor=\"#CC99FF\">";
$back= new submit("bck","^ Назад");
	if($back->get_onclick()) link("../index.php");
/////////////////////////////////////////////////
$start_test= new submit("_strt_tst_","Начало заполнения");





echo "<form method=\"POST\"  action=\"index.php\">\n";
$back->to_html();
echo "администрирование->тестовое заполнение базы\n<hr>\n";
//////////////////////////////////////////////////////////////////
$start_test->to_html();
/////////////////////////////////////////////////////////////////
if($start_test->get_onclick()) 
{
  $pointer_kladr = array();
  init_kladr(&$pointer_kladr);
}
echo "<br>закончено заполнение массива<br>\n";
//print_r($pointer_kladr);

/*
srand((float) microtime() * 10000000);
$input = array("Neo", "Morpheus", "Trinity", "Cypher", "Tank");
$rand_keys = array_rand($input, 2);
echo $input[$rand_keys[0]] . "\n";
echo $input[$rand_keys[1]] . "\n";
echo "<hr>\n";
echo mt_rand() . "\n";
echo mt_rand() . "\n";

echo mt_rand(5, 15);

*/
srand((float) microtime() * 10000000);
for($i=0; $i<1000; $i++)
	{
	  //
	  $rand_keys = array_rand($pointer_kladr, 2);
	  //echo $pointer_kladr[$rand_keys[0]] . "\n";
	  new_house($pointer_kladr[$rand_keys[0]]);
	 // new_house(34534545);
	  echo "<br>\n";
	}


echo "</form>\n";
?>
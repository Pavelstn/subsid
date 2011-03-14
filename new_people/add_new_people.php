<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
include_once("local_class.php");
//include_once
////////////////// записывем нового человека в базу////////////////////////////
//echo "HOUSE ".$_SESSION['_id_house']."<br>\n";

$wrt_ppl= new write_people($_SESSION['_id_house']);
//$wrt_ppl->init_people($_SESSION['_id_house']);
//echo "<hr>\n";
//echo $wrt_ppl->get_id_people();
//echo "PEOPLE<hr>\n";
$_SESSION['_id_people']= $wrt_ppl->get_id_people();


///////////////////////////////////////////
$all_people['familia']= 			"";
$all_people['imya']= 				"";
$all_people['otchestvo']= 			"";
$all_people['sex']= 				"1";
$all_people['birth_day']= 			"current";
$all_people['prog_min']= 			"2";
$all_people['vid_passport']= 		"";
$all_people['passport_serial']= 	"";
$all_people['passport_nomer']= 		"";
$all_people['passport_data_vid']= 	"current";
$all_people['passport_kto_vid']= 	"";
$all_people['bank_sheet']= 			"";
$all_people['bank_filial']= 		"";
$all_people['subsid_pravo']= 		"";
$all_people['subsid_osnovanie']= 	"";
        $_SESSION['_all_people_']= 	$all_people;


//wite_people


////////////////////////////////////////

include_once("fio.php");





?>
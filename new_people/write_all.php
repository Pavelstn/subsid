<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
echo $session_id;
echo "<br>\n";

include_once("../lib/navigate.php");
include_once("local_class.php");

echo "<body bgcolor=\"#6699FF\">\n";

$write_people= new update_people;

$write_people->id_home=   $_SESSION['_id_house'];
$write_people->id_people= $_SESSION['_id_people'];

$all_people= $_SESSION['_all_people_'];
$write_people->familia= 	$all_people['familia'];
$write_people->imya= 		$all_people['imya'];
$write_people->otchestvo= 	$all_people['otchestvo'];
$write_people->sex= 		$all_people['sex'];
$write_people->date= 		$all_people['birth_day'];
$write_people->soc_kat= 	$all_people['prog_min'];
$write_people->vid_doc= 	$all_people['vid_passport'];
$write_people->serial= 		$all_people['passport_serial'];
$write_people->nomer= 		$all_people['passport_nomer'];
$write_people->data_vid= 	$all_people['passport_data_vid'];
$write_people->who= 		$all_people['passport_kto_vid'];
$write_people->bank_schet= 	$all_people['bank_sheet'];
$write_people->bank_filial= $all_people['bank_filial'];
$write_people->to_be= 		$all_people['subsid_pravo'];
$write_people->to_be_osnov= $all_people['subsid_osnovanie'];
	$write_people->data_update_people();


link("../new_house/people.php");






?>
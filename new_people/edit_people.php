<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
include_once("local_class.php");

//echo "Редактирование";

if(isset($id_row) and isset($edit))
	{
	  //echo $id_row;
	  $_SESSION['_id_people']= $id_row;
	}

$prld_dt_ppl= new preload_data_people();
$prld_dt_ppl->id_people= $id_row;
$prld_dt_ppl->load_from_base();


$all_people['familia']= 			$prld_dt_ppl->familia;
$all_people['imya']= 				$prld_dt_ppl->imya;
$all_people['otchestvo']= 			$prld_dt_ppl->otchestvo;
$all_people['sex']= 				$prld_dt_ppl->sex;
$all_people['birth_day']= 			$prld_dt_ppl->birth_day;
$all_people['prog_min']= 			$prld_dt_ppl->prog_min;
$all_people['vid_passport']= 		$prld_dt_ppl->vid_passport;
$all_people['passport_serial']= 	$prld_dt_ppl->passport_serial;
$all_people['passport_nomer']= 		$prld_dt_ppl->passport_nomer;
$all_people['passport_data_vid']= 	$prld_dt_ppl->passport_data_vid;
$all_people['passport_kto_vid']= 	$prld_dt_ppl->passport_kto_vid;
$all_people['bank_sheet']= 			$prld_dt_ppl->bank_sheet;
$all_people['bank_filial']= 		$prld_dt_ppl->bank_filial;
$all_people['subsid_pravo']= 		$prld_dt_ppl->subsid_pravo;
$all_people['subsid_osnovanie']=	$prld_dt_ppl->subsid_osnovanie;
        $_SESSION['_all_people_']= 	$all_people;

////////////////////////////////////////

include_once("fio.php");





?>
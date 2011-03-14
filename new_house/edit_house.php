<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();

include_once("local_class.php");
/////////////////////////////////////////////////////
//$wrt_house= new write_house(); ///новое домовладение  код//
//		$_SESSION['_id_house']= $wrt_house->get_id_house();
//$wrt_hs_nv= new  write_house_env($wrt_house->get_id_house()); //параметры домовладения//
//$wrt_zyv= new write_zayav; 
//$wrt_zyv->id_home= $wrt_house->get_id_house();
//$wrt_zyv->data_add_new_zayavki();

if(isset($id_row) and isset($edit))
	{
	  //echo $id_row;
	  $_SESSION['_id_house']= $id_row;
	}
	

///////////////////////
$prld_zyv= new preload_zayav;
$prld_zyv->id_home= $id_row;
$prld_zyv->load_zayav();


        $all_zayav['set_date']= $prld_zyv->set_date;
        $all_zayav['rasch_period']= $prld_zyv->rasch_period;
        $all_zayav['base_sheet']= $prld_zyv->base_sheet;
        $all_zayav['sost_vipl']= $prld_zyv->sost_vipl;
        	$_SESSION['_all_zayav']= $all_zayav;
        //////////////////////////////////////
        
$prld_adrs_hus= new preload_adres_house;
$prld_adrs_hus->id_home= $id_row;
$prld_adrs_hus->load_adres();


    $adres_house["code_cladr"]= 	$prld_adrs_hus->code_cladr;
    $adres_house["code_street"]= 	$prld_adrs_hus->code_street;
    $adres_house["nomer_doma"]= 	$prld_adrs_hus->nomer_doma;
    $adres_house["nomer_korpusa"]= 	$prld_adrs_hus->nomer_korpusa;
    $adres_house["nomer_kvartiri"]= $prld_adrs_hus->nomer_kvartiri;
    $_SESSION['_adres_house']= $adres_house;
    ////////////////////////////////////////
    
$prld_house_env= new preload_house_env;
$prld_house_env->id_home= $id_row;
$prld_house_env->load_house_env();
  
    
    //$_house_env["id_home"]= "";
    $_house_env["vid_sobstv"]= 	   $prld_house_env->vid_sobstv;
    $_house_env["obsh_ploshad"]=   $prld_house_env->obsh_ploshad;
    $_house_env["otapl_ploshad"]=  $prld_house_env->otapl_ploshad;
    $_house_env["kolvo_komnat"]=   $prld_house_env->kolvo_komnat;
    $_house_env["vid_otopl"]= 	   $prld_house_env->vid_otopl;
    $_house_env["vladelec"]= 	   $prld_house_env->vladelec;
    $_SESSION['_house_env']= 	   $_house_env;
    
/////////////////////////////////////////    
/////////////////////////////////////////    
///////////////////////////////////////// 
//     $adres_house["code_cladr"]= "";
//     $adres_house["code_street"]= "";
//     $adres_house["nomer_doma"]= "";
//     $adres_house["nomer_korpusa"]= "";
//     $adres_house["nomer_kvartiri"]= "";
//     $_SESSION['_adres_house']= $adres_house;
//    


//echo "INIT!!";
include("zayav.php");


?>
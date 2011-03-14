<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();

include_once("local_class.php");
/////////////////////////////////////////////////////
$wrt_house= new write_house(); ///новое домовладение  код//
		$_SESSION['_id_house']= $wrt_house->get_id_house();
$wrt_hs_nv= new  write_house_env($wrt_house->get_id_house()); //параметры домовладения//
$wrt_zyv= new write_zayav; 
$wrt_zyv->id_home= $wrt_house->get_id_house();
$wrt_zyv->data_add_new_zayavki();

///////////////////////

        $all_zayav['set_date']= "current";
        $all_zayav['rasch_period']= "current";
       // $all_zayav["set_to_date"]= "current";
        $all_zayav['base_sheet']= "";
        $all_zayav['sost_vipl']= "";
        $_SESSION['_all_zayav']= $all_zayav;
        //////////////////////////////////////
    $adres_house["code_cladr"]= "0100400000100";
    $adres_house["code_street"]= "01004000001005600";
    $adres_house["nomer_doma"]= "";
    $adres_house["nomer_korpusa"]= "";
    $adres_house["nomer_kvartiri"]= "";
    $_SESSION['_adres_house']= $adres_house;
    ////////////////////////////////////////
    //$_house_env["id_home"]= "";
    $_house_env["vid_sobstv"]= "";
    $_house_env["obsh_ploshad"]= "";
    $_house_env["otapl_ploshad"]= "";
    $_house_env["kolvo_komnat"]= "";
    $_house_env["vid_otopl"]= "";
    $_house_env["vladelec"]= "";
    $_SESSION['_house_env']= $_house_env;
    
/////////////////////////////////////////    
/////////////////////////////////////////    
///////////////////////////////////////// 
//     $adres_house["code_cladr"]= "";
//     $adres_house["code_street"]= "";
//     $adres_house["nomer_doma"]= "";
//     $adres_house["nomer_korpusa"]= "";
//     $adres_house["nomer_kvartiri"]= "";
//     $_SESSION['_adres_house']= $adres_house;

   

//echo "INIT!!";
include("zayav.php");


?>
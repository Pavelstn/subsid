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
$id_home= $_SESSION['_id_house']; 

/////////////обновляем данные о домовладении////
$updt_hus_nv= new update_house_env;  //параметры домовладения/////

$_house_env= $_SESSION['_house_env'];
$updt_hus_nv->vid_sobstv= $_house_env['vid_sobstv'];
$updt_hus_nv->vladelec= $_house_env['vladelec'];
$updt_hus_nv->obsh_ploshad= $_house_env['obsh_ploshad'];
$updt_hus_nv->otapl_ploshad= $_house_env['otapl_ploshad'];
$updt_hus_nv->kolvo_komnat= $_house_env['kolvo_komnat'];
$updt_hus_nv->vid_otopl= $_house_env['vid_otopl'];
$updt_hus_nv->id_home= $id_home;
$updt_hus_nv->data_update_house_env();

$updte_house= new update_house;   ///Адрес домовладения//
	$adres_house= $_SESSION['_adres_house'];
  $updte_house->id_home=        $id_home;
  $updte_house->code_street=    $adres_house["code_street"];
  $updte_house->nomer_doma=    	$adres_house["nomer_doma"];
  $updte_house->nomer_korpusa=  $adres_house["nomer_korpusa"];
  $updte_house->nomer_kvartiri= $adres_house["nomer_kvartiri"];
  $updte_house->data_update_house();
 
 
   
$updt_zyv= new update_zayav;
$updt_zyv->id_home= $id_home;
	$all_zayav= $_SESSION['_all_zayav'];     	

$updt_zyv->date= $all_zayav['set_date'];
$updt_zyv->start_date= $all_zayav['rasch_period'];
$updt_zyv->bank= $all_zayav['base_sheet'];
$updt_zyv->sost_vipl= $all_zayav['sost_vipl'];
	$updt_zyv->data_update_zayavki();


link("../list_people/index.php");






?>
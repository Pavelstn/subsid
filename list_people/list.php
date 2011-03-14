<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();



include_once("../classes/db_table3.php");
include_once("../classes/db_table_plungin.php");


if(!isset($_SESSION['_query'])) { die ("системная ошибка"); }
$query= $_SESSION['_query']; 
//echo $query;

$tble= new db_table3;
//$tble->set_query("SELECT * FROM house WHERE code_street= '01004000001005600' AND nomer_doma= '456' AND nomer_korpusa= '45' AND nomer_kvartiri= '45454'");
$tble->set_query($query);
//$tble->add_filter(new sample_filter1);
$tble->add_filter(new kladr_filter);
$tble->add_filter(new calendar_filter);
$tble->add_filter(new edit_filter);
$tble->add_filter(new get_people_filter);

//$tble->set_edit_row(true);
//$tble->set_edit_path("../new_house/edit_house.php");
//$tble->add_visible_row("id_home", " № ");
//$tble->add_visible_row("nomer_doma", "Номер Дома");
//$tble->add_visible_row("nomer_korpusa", "Корпус");
//$tble->add_visible_row("nomer_kvartiri", "Квартира");
//$tble->add_visible_row("name", "Улица"); 	
//$tble->target_top= true;
$tble->to_html();


?>
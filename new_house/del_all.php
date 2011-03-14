<?php
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();
echo $session_id;
echo "<br>\n";

include_once("../lib/navigate.php");
include_once("../classes/delete_all.php");

echo "<body bgcolor=\"#6699FF\">\n";


$dell_all= new del_house($_SESSION['_id_house']);

unset($_SESSION['_all_people_']);
unset($_SESSION['_id_people']);
unset($_SESSION['_id_house']);
unset($dell_all);

link("../list_people/index.php");






?>
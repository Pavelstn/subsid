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


$dell_all= new dell_all($_SESSION['_id_people']);
unset($_SESSION['_all_people_']);
unset($_SESSION['_id_people']);
unset($dell_all);

link("../new_house/people.php");






?>
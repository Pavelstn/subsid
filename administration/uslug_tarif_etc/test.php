<?php
include_once("../../classes/db_load.php");

$db_lad= new db_load("SELECT * FROM sprav_uslug WHERE  id_uslug= '23'");
echo $db_lad->row["id_uslug"];
echo "<br>\n";
echo $db_lad->row["id_group_uslug"];
echo "<br>\n";
echo $db_lad->row["uslug_name"];
echo "<br>\n";







?>
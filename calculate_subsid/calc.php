<?php

include_once("./new_lib/private_lgot.php");
include_once("./new_lib/core_lgot.php");


$lgot= new core_lgot;
$lgot->init_lgot();
//////////////////////////////////////

$p_lgot= new private_lgot(3);
$uslug= 44;

//echo "����� ��������� �����".$p_lgot->count."<br>\n";
//$all_people
$global_lgot_count= 0;

//for ($i=0 ;$i< 1000; $i++)
//	{
//	  $people_flag[$i]= false;
//	}

for ($i=0 ;$i< $p_lgot->count; $i++)
	{
	 $id_people= $p_lgot->id_people[$i];
	 echo "������� ".$id_people."<br>\n";
	  $udostover= $p_lgot->id_vid_udostover[$i];
	  $value= $lgot->get_lgot($udostover, $uslug);
	 $people_count= 0;
	  if($value["range"]==1) //������� ��������� ������//
	  	{
		    if(isset($people_flag[$id_people]) AND $people_flag[$id_people] ) 
		    	{
				  echo "<h1>������: ������� ����� ��������� ����� � �������� </h1>\n";
				  $people[$id_people]= 100;
				}
		    else
		    	{
				  $people[$id_people]= $value["percent"];
				  $people_flag[$id_people]= true;
				  echo "��������� ������ ".$people[$id_people]."% �� ������������� ".$udostover."<br>\n";
				}
		}
	  if($value["range"]==2) //������� ���������� ������//
	  	{
		    $udostover= $p_lgot->id_vid_udostover[$i];
		    $global_lgot_count++;
		    if($global_lgot_count> 1)
		    	{
				   echo "<h1>������: ������� ����� ���������� ����� � ����� </h1>\n";
				   $global_lgot= 100;
				}
		    else $global_lgot= $value["percent"];
		    echo "���������� ������=".$global_lgot."%<br>\n";
		}					  
	}
////////////////////////������������ ��� ��������� ������///////////
//$all_lgt=  array_values($people);
//echo $all_lgt[1]."<br>\n";
$all_local_lgot= 0;
echo "<hr>\n";
while (list ($key, $val) = each ($people) ) :
print "$val <br>";
$all_local_lgot+= $val;
endwhile;
echo "<br>".$all_local_lgot."<br>\n";
echo "<hr>\n";
function calc_ordinary_lgot($all_local_lgot, $global_lgot)
	{
	  return ($all_local_lgot*$global_lgot)/10000;
	}
echo "������ �� ������ ".$uslug." ����� ".calc_ordinary_lgot($all_local_lgot, $global_lgot)."<br>\n";
?>
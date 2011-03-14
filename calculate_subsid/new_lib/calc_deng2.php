<?php

include_once("private_uslug.php");
include_once("calc_uslug.php");
include_once("calc_lgot.php");
include_once("private_lgot.php");

include_once("core_tarif.php");



function minus_local_lgot($norm, $tarif, $local_lgot)
	{
	  $m_l_lgot= $norm* $tarif* $local_lgot;
	  return $m_l_lgot;
	}

	
function calc_deng($id_home, $count_all_people, $strt, $stp , &$price, &$lgot, &$nastr)
{
    $calc_uslug=    new calc_uslug;
    $pulgot=        new calc_lgot;
  	$p_lgot=        new private_lgot($id_home, $count_all_people);
  	$private_uslug= new private_uslug($id_home);
  	
	$calc_uslug->calc($price, $private_uslug, $strt, $stp);
	$all_deng= 0;
	
		while (list ($key, $val) = each ($calc_uslug->all_uslug) ) :
			if($key== $nastr->point_uslug OR $key== $nastr->point_otopl)
				{
				 // echo "<hr>\n";
				//  echo "������ ".$key."<br>\n";
				//  echo "������� � ���� ".$count_all_people."<br>\n";
				//  echo "��������� ����� ".($pulgot->all_local_lgot/100 )."<br>\n";
				//  echo "���������� ����� ".($pulgot->global_lgot/100)."<br>\n";
				  $nrm=  $nastr->get_horm_house($count_all_people);
				//  echo "����� �����������".$nrm."<br>\n";
				  $normativ= $nrm/ $count_all_people;
			//	  echo "�������� ����������� ".$normativ."<br>\n";
				  
				  //$as= $calc_uslug->calc2(&$price, $private_uslug, $key, $strt, $stp);
				        $core_tarif= new core_tarif;
    					$core_tarif->init_tarif($strt, $stp);
				  
				  $tarif= $calc_uslug->calc2(&$core_tarif, $key, $strt, $stp);
			//	  echo "����� �� ������ ".$tarif."<br>\n";
				  
				  //$deng= $nrm* $tarif;
				  
				  //$local_l= $count_all_people- ($pulgot->all_local_lgot/100);
				  
				  //$local_l= $pulgot->all_local_lgot/ $count_all_people;
///////////////////////////////////////////////////////////////////////				  
 

//			  echo " ����� �� �����-".$normativ." ";
			  $m= $nrm* $tarif;
//			  echo "<br>\n";
//			  echo "����� ��� ����� ".$m."\n";
			  
			 	  
			   
			  $m_lgot= $m- ($normativ* $tarif* ($pulgot->all_local_lgot/100 ));
			  
//			  echo " ����� 1 ��� ����� ".$m_lgot." ";
			  
			  $m= ($m-$m_lgot)* ($pulgot->global_lgot/100);
//			  echo "<br>\n";
//			  echo "�� ����� �� ����� ��������-".$m." "; 

				  
				
//////////////////////////////////////////////////////////////////////				  
				 // echo $m;
				  //$deng= $deng-($normativ* $tarif+ ();
					$all_deng+= $m;
				// echo "<hr>\n";
				}

			else
				{
				  	$pulgot->calc($key,$p_lgot,$lgot);	
					$k_lgot= $pulgot->calc_ordinary_lgot();
					$all_deng+= $val*$k_lgot;
				}

		endwhile;

		unset($calc_uslug);
		unset($pulgot);
		unset($private_uslug);
		unset($k_lgot);
		
	return $all_deng;		
}

?>
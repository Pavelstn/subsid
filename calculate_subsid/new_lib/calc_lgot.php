<?php

//include_once("private_lgot.php");
//include_once("core_lgot.php");
//include_once("../classes/database_work.php");


/////////////////////////////////////////////////////////////////////////////

//class calc_lgot extends database_work
class calc_lgot
{

  	  var  $all_local_lgot= 0;
	  var  $global_lgot_count= 0;
	  var  $global_lgot= 100;
	  
  //function calc()
  function calc($uslug,&$p_lgot,&$lgot)
  	{
	    //
  //------------------------------------//
  		//$lgot= new core_lgot;           //
		//$lgot->init_lgot();             //
		//$p_lgot= new private_lgot(3);   //
		//$uslug= 44;                     //
  //------------------------------------//
	    
	    
	    $this->all_local_lgot= 0;
	    $this->global_lgot_count= 0;
	    //-----------------------------------------//
	    for ($i=0 ;$i< $p_lgot->count; $i++)
			{
	 			$id_people= $p_lgot->id_people[$i];
	 		//	echo "������� ".$id_people."<br>\n";
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
				  			//	echo "��������� ������ ".$people[$id_people]."% �� ������������� ".$udostover."<br>\n";
							}
						}
	  		if($value["range"]==2) //������� ���������� ������//
	  			{
		    		$udostover= $p_lgot->id_vid_udostover[$i];
		    		$this->global_lgot_count++;
		    		if($this->global_lgot_count> 1)
		    			{
				   			echo "<h1>������: ������� ����� ���������� ����� � ����� </h1>\n";
				   			$global_lgot= 100;
						}
		    		else $this->global_lgot= $value["percent"];
		    		//echo "���������� ������=".$this->global_lgot."%<br>\n";
				}					  
			}
	    /////////////////////////////////////////////////////////
	    
	//	echo "<hr>\n";
	    $c= 0;
		while (list ($key, $val) = each ($people) ) :
	//		print "$val <br>";
			$this->all_local_lgot+= $val;
			
			$c++;
		endwhile;
		
		///echo "����������� ����� �����".$p_lgot->count_all_people."<br>\n";
		//echo "����������� ����� �� �������� ".$c."<br>\n";
		//$add_percent= ($p_lgot->count_all_people- $c)*100;
		//echo "�� ������ ��������� ����������� ".$this->all_local_lgot."<br>\n";
		$this->all_local_lgot+= ($p_lgot->count_all_people- $c)*100;
		
		//echo "������ ��������� ����������� ".$this->all_local_lgot."<br>\n";
		
		//echo "<br>".$this->all_local_lgot."<br>\n";
	//	echo "<hr>\n";
	}
/////////////////////////////////////////////////////

  function calc_ordinary_lgot()
	{
	  //$xui= ($this->all_local_lgot* $this->global_lgot)/10000;
	  //echo "����������� ������ ".$xui."<br>\n";
	  return ($this->all_local_lgot*$this->global_lgot)/10000;
	}
}


?>
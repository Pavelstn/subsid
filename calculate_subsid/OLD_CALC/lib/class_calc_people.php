<?php
include_once("../classes/database_work.php");

class calc_people extends database_work
{
  var $all_people= 0; //����������� �������, ����������� � ������������//
  var $subsid_people= 0; //����������� �������, ����������� � ������������ � ������� ����� �� ��������//
  var $id_house; //��� ������������//
  
  var $debug_mode= false;
  
  function calc()
  	{
	    //
	    $this->connect_db();
	    $query= "SELECT * FROM people WHERE id_home=".$this->id_house;
	    $result= mysql_query($query) or die( mysql_eror());
	    while($row= mysql_fetch_array($result))
	    	{
			  //
			  if($row["to_be"]=="1") $this->subsid_people++;
			  if($this->debug_mode) 
			  	{
					echo $row["familia"]." ".$row["imya"]." ".$row["otchestvo"]."<br>\n";
					echo "<hr>\n";
				}
			  $this->all_people++;
			}
	}
  
  
}





























?>
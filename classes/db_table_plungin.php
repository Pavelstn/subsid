<?php
include_once("database_work.php");

class sample_filter1
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if($this->alien_name== "nomer_doma") return true;
	    else false;
	}
  
  function show_filter()      //������� ��� ���������� �������//
  	{
	    echo $this->alien_value."|".$this->alien_type;
	}
}
/////////////////////////////////////////////////////////////////////
class edit_filter
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  var $edit_path="../new_house/edit_house.php";
  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if($this->alien_name== "id_home") return true;
	    else false;
	}
  
  function show_filter()      //������� ��� ���������� �������//
  	{
	    //echo $this->alien_value."|".$this->alien_type;
	    $target="TARGET=\"_top\"";
	    echo "<a href=\"".$this->edit_path."?id_row=".$this->alien_value."&edit\" ".$target.">�������������</a>";
	}
}
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
class kladr_filter extends database_work
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  ////////////////////////////////////////
  //var $code_street;
  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if($this->alien_name== "code_street") return true;
	    else false;
	}
  ///////////////////////////////////////////////////////////////////
	function convert()
		{
		   $code_street= $this->alien_value;
		   
		    $this->connect_db();
  			if($code_street== "" OR $code_street== "0" )
  				{
				    echo "<font color=\"#FF0000\"> ����� �� ���������</font>\n";
				    return ;
				}
  			$code_kladr= $code_street[0].$code_street[1].$code_street[2].$code_street[3].$code_street[4].$code_street[5].$code_street[6].$code_street[7].$code_street[8].$code_street[9].$code_street[10].$code_street[11].$code_street[12];
  			$query= "SELECT * from kladr WHERE code= '$code_kladr'";
  			$result= mysql_query($query) or die (mysql_error());
  			while($row= mysql_fetch_array($result))
  				{
				    //
				    echo $row["socr"]." ".$row["name"].", ";
				}
			
			$query= "SELECT * from street WHERE code= '$code_street'";
			$result= mysql_query($query) or die (mysql_error());
			while($row= mysql_fetch_array($result))
				{
				  echo $row["socr"]." ".$row["name"];
				}
			$this->dis_connect_db();
		}
  
  
  
  
  /////////////////////////////////////////////////////////////////
  function show_filter()      //������� ��� ���������� �������//
  	{
	    $this->convert();
	}
}
/////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////
class get_people_filter extends database_work
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  ////////////////////////////////////////
  //var $code_street;
  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if(($this->alien_name== "vladelec") AND ($this->alien_value!="")) return true;
	    else false;
	}
  ///////////////////////////////////////////////////////////////////
	function get_people()
		{
		   //$code_street= $this->alien_value;
		   
		    $this->connect_db();


  			$query= "SELECT familia, imya, otchestvo FROM people WHERE id_people= '$this->alien_value'";
  			//echo $query;
  			$result= mysql_query($query) or die (mysql_error());
  			while($row= mysql_fetch_array($result))
  				{
				    //
				    echo $row["familia"]." ".$row["imya"]." ".$row["otchestvo"];
				}
			
			$this->dis_connect_db();
		}
  
  
  
  
  /////////////////////////////////////////////////////////////////
  function show_filter()      //������� ��� ���������� �������//
  	{
	    $this->get_people();
	    //echo "dgg";
	}
}
/////////////////////////////////////////////////////////////////////



class calendar_filter
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  //////////////////////////////////////////////////////////////////////////////
  function get_year($date)
        {
          $year= $date[0].$date[1].$date[2].$date[3];
          return $year;
        }
/////////////////////////////////////////////////////
function get_month($date)
         {
           return $date[5].$date[6];
         }
/////////////////////////////////////////////////////
function get_day($date)
         {
           return $date[8].$date[9];
         }
/////////////////////////////////////////////////////////////////////////////////
	function date_to_str($date)
	{
	  
	   
	  
		    $year= $this->get_year($date);
		    $month= $this->get_month($date);
		    $day= $this->get_day($date);
		    
		    
					  $month_list["01"]="���";
					  $month_list["02"]="���";
					  $month_list["03"]="���";
					  $month_list["04"]="���";
					  $month_list["05"]="���";
					  $month_list["06"]="����";
					  $month_list["07"]="����";
					  $month_list["08"]="���";
					  $month_list["09"]="���";
					  $month_list["10"]="���";
					  $month_list["11"]="����";
					  $month_list["12"]="���";
					  
					  $strok= $day.".".$month_list[$month].".".$year;
					  return $strok;		
		 	
	}
/////////////////////////////////////////////////////////////////////////////////  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if($this->alien_type== "date") return true;
	    else false;
	}
  
  function show_filter()      //������� ��� ���������� �������//
  	{
	    echo $this->date_to_str($this->alien_value);
	}
}
/////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////
class edit_filter2
{
  var $name_filter;   //������� ����������
  var $alien_value;   //������� ����������
  var $alien_name;    //������� ����������
  var $alien_type;    //������� ����������
  var $edit_path="subsid_house.php";
  
  function is_accept_filter()  //������� ������������� ��� �������� ������������� ������������� ����� �������;
  	{
	    //return true;
	    if($this->alien_name== "id_home") return true;
	    else false;
	}
  
  function show_filter()      //������� ��� ���������� �������//
  	{
	    //echo $this->alien_value."|".$this->alien_type;
	    $target="TARGET=\"_top\"";
	    echo "<a href=\"".$this->edit_path."?id_row=".$this->alien_value."&edit\" ".$target.">�����������</a>";
	}
}
/////////////////////////////////////////////////////////////////////























?>
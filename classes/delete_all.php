<?php
include_once("database_work.php");

class dell_all extends database_work
{
  var $id_people;
  
  function del()
  	{
	    //
	    $this->connect_db();
	    $query="DELETE FROM udostover WHERE  id_people= '$this->id_people'";
	    	$result= mysql_query($query) or die (mysql_error());
	    		echo "удалили из таблицы удостоверений<br>\n";
	    $query="DELETE FROM dohod WHERE id_people= '$this->id_people'";
	    	$result= mysql_query($query) or die (mysql_error());
	    		echo "удалили из таблицы доходов<br>\n";
	    $query="DELETE FROM people WHERE id_people= '$this->id_people'";
	    	$result= mysql_query($query) or die (mysql_error());
	    		echo "удалили из таблицы жильцов<br>\n";
	    $this->dis_connect_db();  
	}
  function dell_all($id_people)
  	{
	    $this->id_people= $id_people;
	    $this->del();
	}
}


class del_house extends database_work
{
  var $id_house;
  
	function del_people()///удаляем записи о жильцах вместе с удостоверениями и доходами//
		{
		    $query= "SELECT id_people FROM people WHERE id_home= $this->id_house";
  			$this->connect_db();
  			$result= mysql_query($query) or die (mysql_error());
  			while($row= mysql_fetch_array($result))
 				{
		   			//
		   			$people_delete= new dell_all($row["id_people"]);
		   			unset($people_delete);
				}
			$this->dis_connect_db();
		}
	///////////
	function del_other()
		{
		  	$this->connect_db();
		    $query= "DELETE FROM zayavki WHERE id_home= '$this->id_house'";
            $result= mysql_query($query) or die (mysql_error());
            ///////
            $query= "DELETE FROM uslug WHERE id_home= '$this->id_house'";
            $result= mysql_query($query) or die (mysql_error());
            ///////
            $query= "DELETE FROM house WHERE id_home= '$this->id_house'";
            $result= mysql_query($query) or die (mysql_error());
            $this->dis_connect_db();
		}
  
  function del_house($id_house)
  	{
	    $this->id_house= $id_house;
	    $this->del_people();
	    $this->del_other();
	}
}




?>
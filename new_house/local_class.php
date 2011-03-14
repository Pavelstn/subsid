<?php

include_once("../classes/database_work.php");

class write_house extends database_work
{
  //
  var $id_house;
  //function set_id_house($new_id_home)
  //	{
//	    $this->id_house= $new_id_home;
//	}
  
  function init_house()
  	{
 
              $query= " INSERT INTO house (
                                            code_street,
                                            nomer_doma,
                                            nomer_korpusa,
                                            nomer_kvartiri
                                           )
                                    VALUES ('','','','')";



        $this->connect_db();
         
         $lock="LOCK TABLES house WRITE";
         $result= mysql_query($lock) or die( mysql_eror());
         $result= mysql_query($query) or die( mysql_eror());
         //  return mysql_insert_id();  //можно и так  если это заработает- оставить этот вариант//
        // $query= "SELECT LAST_INSERT_ID()";
        // $result= mysql_query($query) or die( mysql_eror());
         
        // while($row= mysql_fetch_array($result))
        // 	{
		//	   $this->id_house= (int)$row["last_insert_id()"];
		//	}
			$this->id_house= mysql_insert_id();
			
		$unlock="UNLOCK TABLES";	
		$result= mysql_query($query) or die( mysql_eror());
		
		$this->dis_connect_db();
		//echo "<hr>\n";
		//echo $this->id_people;
		//echo "<hr>\n";
         
	}
	function get_id_house()
		{
			return $this->id_house;		  
		}
		
	function write_house()
		{
		  //
		  $this->init_house();
		}
}
///////////////////////////////////////////////////////////////////////////////////
class update_house extends database_work
 {
	var $id_home;
	var $code_street;
	var $nomer_doma;
	var $nomer_korpusa;
	var $nomer_kvartiri;
	
	function data_update_house()
            {
              $query= "UPDATE house
                                SET
                                    code_street= '$this->code_street',
                                    nomer_doma= '$this->nomer_doma',
                                    nomer_korpusa= '$this->nomer_korpusa',
                                    nomer_kvartiri= '$this->nomer_kvartiri'
                             WHERE
                                    id_home= '$this->id_home'";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
 }
//////////////////////////////////////////////////////////////////////////////////////
class preload_adres_house extends database_work
{
  var $id_home;
  var $nomer_doma;
  var $nomer_korpusa;
  var $nomer_kvartiri;
  var $code_cladr;
  var $code_street;
  
  
  
  function load_adres()
  	{
	      $query= "SELECT * FROM  house WHERE id_home= '$this->id_home' ";
        $this->connect_db();
        $result= mysql_query($query) or die (mysql_error());
        while($row= mysql_fetch_array($result))
            {
              $__code_street= $row["code_street"];
              $this->nomer_doma= $row["nomer_doma"];
              $this->nomer_korpusa= $row["nomer_korpusa"];
              $this->nomer_kvartiri= $row["nomer_kvartiri"];
              
              if($__code_street=="") { $__code_street="01004000001005600"; }
              
              $this->code_cladr= $__code_street[0].$__code_street[1].$__code_street[2].$__code_street[3].$__code_street[4].$__code_street[5].$__code_street[6].$__code_street[7].$__code_street[8].$__code_street[9].$__code_street[10].$__code_street[11].$__code_street[12];
              $this->code_street= $__code_street;
              
            }
          $this->dis_connect_db();
	}
}


//////////////////////////////////////////////////////////////////////////////////////

class write_uslug extends database_work
{
  //
  var $id_house;
  var $id_sprav_uslug;
  var $value_uslug;
  
  function write()
  	{
	   
	            $query= " INSERT INTO uslug (
                                    id_home,
                                    id_vid_uslug,
                                    value_uslug
                                    )
                            VALUES (
                                    '$this->id_house',
                                	'$this->id_sprav_uslug',
                                    '$this->value_uslug'
                                    )";
             $this->connect_db();
             $result= mysql_query($query) or die (mysql_error());
             $this->dis_connect_db();
	    
	}
	function write_uslug($id_house, $id_sprav_uslug, $value_uslug)
		{
		  //
		    $this->id_house= $id_house;
  			$this->id_sprav_uslug= $id_sprav_uslug;
  			$this->value_uslug= $value_uslug;
  			
  			$this->write();
		} 
}

class update_house_env extends database_work
{
	var $vid_sobstv;
    var $bank="";
    var $obsh_ploshad;
    var $otapl_ploshad;
    var $kolvo_komnat;
    var $vid_otopl;
    var $vladelec;
    var $id_home;


  function data_update_house_env()
            {
              $query= "UPDATE house_env
                                    SET
                                        vid_sobstv= '$this->vid_sobstv',
                                        bank= '$this->bank',
                                        obsh_ploshad= '$this->obsh_ploshad',
                                        otapl_ploshad= '$this->otapl_ploshad',
                                        kolvo_komnat= '$this->kolvo_komnat',
                                        vid_otopl= '$this->vid_otopl',
                                        vladelec= '$this->vladelec'
                                  WHERE
                                        id_home= '$this->id_home'";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
}
////////////////////////////////////////////////////////////////////////////////////////////////
class write_house_env extends database_work
{
  //
  var $id_house;
 // var $id_sprav_uslug;
//  var $value_uslug;
  
  function write()
  	{
	   
	            $query= " INSERT INTO house_env (
                                    id_home
                                    )
                            VALUES (
                                    '$this->id_house'
                                    )";
             $this->connect_db();
             $result= mysql_query($query) or die (mysql_error());
             $this->dis_connect_db();
	    
	}
	function write_house_env($id_house)
		{
		  //
		    $this->id_house= $id_house;
  			//$this->id_sprav_uslug= $id_sprav_uslug;
  			//$this->value_uslug= $value_uslug;
  			
  			$this->write();
		} 
}
///////////////////////////////////////////////////
class preload_house_env extends database_work 
{
  //
  var $id_home;
  var $vid_sobstv;
  var $obsh_ploshad;
  var $otapl_ploshad;
  var $kolvo_komnat;
  var $vid_otopl;
  var $vladelec;
  
  function load_house_env()
  	{
	            $query= "SELECT * FROM house_env WHERE id_home= '$this->id_home'";
        $this->connect_db();
        $result= mysql_query($query) or die (mysql_error());
        while($row= mysql_fetch_array($result))
            {
              $this->vid_sobstv= $row["vid_sobstv"];
              //$bank=  $row["bank"];
              $this->obsh_ploshad= $row["obsh_ploshad"];
              $this->otapl_ploshad= $row["otapl_ploshad"];
              $this->kolvo_komnat= $row["kolvo_komnat"];
              $this->vid_otopl= $row["vid_otopl"];
              $this->vladelec=$row["vladelec"];
            }
        $this->dis_connect_db();
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////
class write_zayav extends database_work 
{
  var $id_home;
  function data_add_new_zayavki()
            {
              $query= " INSERT INTO zayavki (
                                            id_home,
                                            date,
                                            start_date,
                                            bank,
                                            sost_vipl
                                          )
                                   VALUES ('$this->id_home','','','','')";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
}
//////////////////////////////////////////////////////////////////////////////////////
class preload_zayav extends database_work 
{   
    var $id_home;
	  
  	var $set_date;
	var $rasch_period;
	var $base_sheet;
	var $sost_vipl;

  
 function load_zayav()
 	{
	     $query= "SELECT * FROM zayavki WHERE id_home= '$this->id_home' ";
        $this->connect_db();
        $result= mysql_query($query) or die (mysql_error());
        while($row= mysql_fetch_array($result))
            {
              
              $this->set_date= $row["date"];
              $this->rasch_period= $row["start_date"];
              $this->base_sheet= $row["bank"];
              $this->sost_vipl= $row["sost_vipl"];
            }
        $this->dis_connect_db();
	}
}
/////////////////////////////////////////////////////////////
class update_zayav extends database_work 
{
  var $id_home;
  
  var $date;
  var $start_date;
  var $bank;
  var $sost_vipl;
  
  function data_update_zayavki()
            {
              echo "обновление данных";
              $query= "UPDATE zayavki
                                    SET
                                        date= '$this->date',
                                        start_date= '$this->start_date',
                                        bank= '$this->bank',
                                        sost_vipl= '$this->sost_vipl'
                                   WHERE
                                        id_home= '$this->id_home' ";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
}
////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////










?>
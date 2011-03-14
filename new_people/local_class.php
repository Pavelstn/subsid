<?php

include_once("../classes/database_work.php");

class write_people extends database_work
{
  //
  var $id_people;
  function set_id_people($new_id_home)
  	{
	    $this->id_people= $new_id_home;
	}
  
  function init_people($id_home)
  	{
		 $query= "INSERT INTO people (
                                    id_home,
                                    familia,
                                    imya,
                                    otchestvo,
                                    date,
                                    sex,
                                    vid_doc,
                                    serial,
                                    nomer,
                                    who,
                                    data_vid,
                                    bank_schet,
                                    bank_filial,
                                    to_be,
                                    to_be_osnov,
                                    social_kat
                                    
                                  )
                          VALUES ('$id_home','','','','','','','','','','','','','','','')";
         $this->connect_db();
         
         $lock="LOCK TABLES people WRITE";
         $result= mysql_query($lock) or die( mysql_eror());
         $result= mysql_query($query) or die( mysql_eror());
         $query= "SELECT LAST_INSERT_ID()";
         $result= mysql_query($query) or die( mysql_eror());
         
         while($row= mysql_fetch_array($result))
         	{
			   $this->id_people= (int)$row["last_insert_id()"];
			}
			
		$unlock="UNLOCK TABLES";	
		$result= mysql_query($query) or die( mysql_eror());
		
		$this->dis_connect_db();
		//echo "<hr>\n";
		//echo $this->id_people;
		//echo "<hr>\n";
         
	}
	function get_id_people()
		{
			return $this->id_people;		  
		}
		
	function write_people($id_home)
		{
		  //
		  $this->init_people($id_home);
		}
}

class update_people extends database_work
{
  // 
  var $id_people;
  var $id_home;
  var $familia;
  var $imya;
  var $otchestvo;
  var $date;
  var $sex;
  var $vid_doc;
  var $serial;
  var $nomer;
  var $who;
  var $data_vid;
  var $bank_schet;
  var $bank_filial;
  var $to_be;
  var $to_be_osnov;
  var $soc_kat;
  
  function data_update_people()
            {
               $query= "UPDATE people
                                 SET
                                    familia= '$this->familia',
                                    imya= '$this->imya',
                                    otchestvo= '$this->otchestvo',
                                    date= '$this->date',
                                    sex= '$this->sex',
                                    vid_doc= '$this->vid_doc',
                                    serial= '$this->serial',
                                    nomer= '$this->nomer',
                                    who= '$this->who',
                                    data_vid= '$this->data_vid',
                                    bank_schet= '$this->bank_schet',
                                    bank_filial= '$this->bank_filial',
                                    to_be= '$this->to_be',
                                    to_be_osnov= '$this->to_be_osnov',
                                    social_kat='$this->soc_kat'
                                WHERE
                                    id_people= '$this->id_people'
								 AND
								    id_home= '$this->id_home'";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
}

class write_udostover extends database_work
{
  var $id_vid_udostover;
  var $id_people;
  var $serial;
  var $nomer;
  var $who;
  var $date;
  
  function data_add_new_udostover()
            {
              $query= " INSERT INTO udostover (
                                                id_vid_udostover,
                                                id_people,
                                                serial,
                                                nomer,
                                                who,
                                                date
                                              )
                                       VALUES (
                                                '$this->id_vid_udostover',
                                                '$this->id_people',
                                                '$this->serial',
                                                '$this->nomer',
                                                '$this->who',
                                                '$this->date'
                                                )";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }

}
///////////////////////////////////////////////////////////////////////////////
class write_dohod extends database_work
{
   var $id_people;
   var $id_vid_dohod;
   var $at_date;
   var $to_date;
   var $value_money= "0";
   var $value_money2= "0";
   
  function data_add_new_dohod()
            {
              $query= "INSERT INTO dohod (
                                            id_vid_dohod,
                                            id_people,
                                            at_date,
                                            to_date,
                                            value_money,
                                            value_money2
                                          )
                                  VALUES (
                                           '$this->id_vid_dohod',
                                           '$this->id_people',
                                           '$this->at_date',
                                           '$this->to_date',
                                           '$this->value_money',
                                           '$this->value_money2'
                                         )";
                $this->connect_db();
                $result= mysql_query($query) or die (mysql_error());
                $this->dis_connect_db();
            }
    function validate()
    	{
		  if(!$this->value_money) $this->value_money= "0";
		  if(!$this->value_money2) $this->value_money2= "0";
		}
    function calc_money()
    	{
		  //
		  $raw_kop= $this->value_money2;
		  if($raw_kop<100)
		  	{
			    return;
			}
			$kop= $raw_kop % 100;
			$add_rub_= $raw_kop- $kop;
			$add_rub= $add_rub_/100;
			
			$this->value_money= $this->value_money+$add_rub;
			$this->value_money2= $kop;
		}
	function write()
		{
		  //
		  $this->validate();
		  $this->calc_money();
		  $this->data_add_new_dohod();
		}
}


////////////////////////////////////////////////////////////////////////////////
class preload_data_people extends database_work
{
  //
  	var $id_people;
  
  	var $familia;
	var $imya;
	var $otchestvo;
	var $sex;
	var $birth_day;
	var $prog_min;
	var $vid_passport;
	var $passport_serial;
	var $passport_nomer;
	var $passport_data_vid;
	var $passport_kto_vid;
	var $bank_sheet;
	var $bank_filial;
	var $subsid_pravo;
	var $subsid_osnovanie;
  
  function load_from_base()
  	{
	    $query= "SELECT * FROM people  WHERE id_people= '$this->id_people'";
      $this->connect_db();
      $result= mysql_query($query) or die (mysql_error());
      while($row= mysql_fetch_array($result))
        {
          //$row["id_home"];
          $this->familia= $row["familia"];
          $this->imya= $row["imya"];
          $this->otchestvo= $row["otchestvo"];
          $this->birth_day= $row["date"];
          $this->sex= $row["sex"];
          $this->vid_passport= $row["vid_doc"];
          $this->passport_serial= $row["serial"];
          $this->passport_nomer= $row["nomer"];
          $this->passport_kto_vid= $row["who"];
          $this->passport_data_vid= $row["data_vid"];
          $this->bank_sheet= $row["bank_schet"];
          $this->bank_filial= $row["bank_filial"];
          $this->subsid_pravo= $row["to_be"];
          $this->subsid_osnovanie= $row["to_be_osnov"];
          $this->prog_min= $row["social_kat"];
          
        }
        $this->dis_connect_db(); 
	}
}









?>
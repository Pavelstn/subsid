<?
class data_zayav
        {
          var $id_zayav= 0;
          var $id_home= "";
          var $date= "";
          var $at_date= "";
          var $to_date= "";
          var $bank= "";
          
          function new_zayav()
                    {
                       $query= " INSERT INTO zayavki (
                                            id_home,
                                            date,
                                            at_date,
                                            to_date,
                                            bank
                                          )
                                   VALUES (
                                            '$this->id_home',
                                            '$this->date',
                                            '$this->at_date',
                                            '$this->to_date',
                                            '$this->bank'
                                            )";
                        connect_to_my_db();
                        $result= mysql_query($query) or die (mysql_error());
                    }
                    
          function get_zayav_from_base($new_id_home)
                    {
                      $this->id_home= $new_id_home;
                      $query= "SELECT * FROM zayavki WHERE id_home= '$id_home' ";
                      connect_to_my_db();
                      $result= mysql_query($query) or die (mysql_error());
                      while($row= mysql_fetch_array($result))
                            {
                             $this->date= $row["date"];
                             $this->at_date= $row["at_date"];
                             $this->to_date= $row["to_date"];
                             $this->bank= $row["bank"];
                            }

                    }
                    
            function save_zayav_to_base()
                        {
                          $query= "UPDATE zayavki
                                            SET
                                                date= '$this->date',
                                                at_date= '$this->at_date',
                                                to_date= '$this->to_date'
                                                bank= '$this->bank'
                                            WHERE
                                                id_home= '$this->id_home' ";
                          connect_to_my_db();
                          $result= mysql_query($query) or die (mysql_error());
                        }
                        
            function set_id_home($new_id_home)
                        {
                          $this->id_home= $new_id_home;
                        }

            function set_date($new_date)
                        {
                          $this->date= $new_date;
                        }
                        
            function set_at_date($new_at_date)
                        {
                          $this->at_date= $new_at_date;
                        }
                        
            function set_to_date($new_to_date)
                        {
                          $this->to_date= $new_to_date;
                        }
                        
            function set_bank($new_bank)
                        {
                          $this->bank= $new_bank;
                        }
            ////////////////////////////////////////////////////
            function get_date()
                        {
                          return $this->date;
                        }
                        
            function get_at_date()
                        {
                          return $this->at_date;
                        }
                        
            function get_to_date()
                        {
                          return $this->to_date;
                        }
                        
            function get_bank()
                        {
                          return $this->bank;
                        }
        }




?>

<?
if(!isset($session_id))
   {
    session_start();
   }
$session_id= session_id();






include_once("../classes/text.php");

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
class find_by_people extends input
 {

   
   var $familia;
   var $imya;
   var $otchestvo;

  function cath_event()
  	{
	    $familia_event= $this->popPostVar("fml");
	    $imya_event= $this->popPostVar("ima");
	    $otchestvo_event= $this->popPostVar("otchstv");
	    
	    if($familia_event)   { $this->familia= $familia_event; }
	    if($imya_event)      { $this->imya= $imya_event; }
	    if($otchestvo_event) { $this->otchestvo= $otchestvo_event; }
	}
	
	function get_familia()
		{ return $this->familia; }
	function get_imya()
		{return $this->imya; }
	function get_otchestvo()
		{return $this->otchestvo; }
	            
function to_html()
	{
	 echo "<table border=\"0\" style=\"border-collapse: collapse\">\n";
	echo "	<tr>\n";
	echo "		<td>Фамилия \n";
	echo "			<input type=\"text\" name=\"fml\" size=\"50\" value=\"".$this->familia."\">\n";
	echo "      </td>\n";
	echo "	</tr>\n";
	echo "	<tr>\n";
	echo "		<td>\n";
	echo "		<table border=\"0\"  style=\"border-collapse: collapse\">\n";
	echo "			<tr>\n";
	echo "				<td>Имя\n";
	echo "			<input type=\"text\" name=\"ima\" size=\"20\" value=\"".$this->imya."\">\n";
	echo "              </td>\n";
	echo "				<td>Отчество\n";
	echo "			<input type=\"text\" name=\"otchstv\" size=\"20\" value=\"".$this->otchestvo."\">\n";
	echo "              </td>\n";
	echo "			</tr>\n";
	echo "		</table>\n";
	echo "		</td>\n";
	echo "	</tr>\n";
	echo "</table>\n";
	}
      
	function find_by_people()
		{
		  $this->cath_event();
		}         

}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function b_find_by_adres($code_street, $nomer_doma, $nomer_korpusa, $nomer_kvartiri)
            {
              if($code_street AND !$nomer_doma AND !$nomer_korpusa AND !$nomer_kvartiri)
                {$query= "SELECT * FROM house WHERE code_street= '$code_street'"; return $query;}
               //-----------------------------------------------------------//
              if($code_street AND $nomer_doma AND !$nomer_korpusa AND !$nomer_kvartiri)
                {$query= "SELECT * FROM house\
                                    \WHERE code_street= '$code_street'\
                                    \AND nomer_doma= '$nomer_doma'"; return $query;}
               //-----------------------------------------------------------//
              if($code_street AND $nomer_doma AND $nomer_korpusa AND !$nomer_kvartiri)
                {$query= "SELECT * FROM house WHERE code_street= '$code_street' AND nomer_doma= '$nomer_doma' AND nomer_korpusa= '$nomer_korpusa'"; return $query;}
              //-----------------------------------------------------------//
              if($code_street AND $nomer_doma AND $nomer_korpusa AND $nomer_kvartiri)
                {$query= "SELECT * FROM house WHERE code_street= '$code_street' AND nomer_doma= '$nomer_doma' AND nomer_korpusa= '$nomer_korpusa' AND nomer_kvartiri= '$nomer_kvartiri'"; return $query;}
              //---------------------други варианты-----------------------//
              if($code_street AND $nomer_doma AND !$nomer_korpusa AND $nomer_kvartiri)
                {$query= "SELECT * FROM house WHERE code_street= '$code_street' AND nomer_doma= '$nomer_doma' AND nomer_kvartiri= '$nomer_kvartiri'"; return $query;}
              /////////в остальных случаях/////////////////////////////////
              $query= "SELECT * FROM house ";
               return $query;
            }
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function b_find_by_people($familia, $imya, $otchestvo)
            {
             if($familia AND !$imya AND !$otchestvo)
                {$query= "SELECT * FROM people
                                    WHERE familia= '$familia'"; return $query;}
              //-----------------------------------------------------------//
             if($familia AND $imya AND !$otchestvo)
                {$query= "SELECT * FROM people
                                    WHERE familia= '$familia'
                                    AND imya= '$imya'"; return $query;}
              //-----------------------------------------------------------//
             if($familia AND $imya AND $otchestvo)
                {$query= "SELECT * FROM people
                                    WHERE familia= '$familia'
                                    AND imya= '$imya'
                                    AND otchestvo= '$otchestvo'"; return $query;}
              /////////в остальных случаях/////////////////////////////////
              $query= "SELECT * FROM people ";
               return $query;
            }

?>

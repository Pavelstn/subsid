<?php
///������� ����� input
class input
{
  //
  var $name; // ��� ������
  var $value=""; //�������� ������//
  var $init_method; //����� ���������, ���� ����������� ����� ���������//
  
  function set_name($new_name)
  	{
	    $this->name= $new_name;
	}
  function get_name()
  	{
	    return $this->name;
	}
	
  function set_value($new_value)
  	{
	    $this->value= $new_value;
	}
  function get_value()
  	{
	    return $this->value;
	}
	
  function set_init_method($new_init_method)
  	{
	    $this->init_method= $new_init_method;
	}
  function get_init_method()
  	{
	    return $this->init_method;
	}
	
  function popPostVar($varName)
	{
		//�� ���� ��� ������� �������� �������� ������� ���� �������� �����//
		$result=false;
		if (!empty($_POST[$varName]))
		//	$result=(get_magic_quotes_gpc()?$_POST[$varName]:addslashes($_POST[$varName]));
		$result= $_POST[$varName];
		return $result;
	}
}

?>
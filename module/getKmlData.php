<?php

$flagA = 0;
$flagB = 0;
$parser=xml_parser_create();
//Function to use at the start of an element
function start($parser,$element_name,$element_attrs)
  {
	  
	if ($_GET["type"]==="coord")
	{
		switch($element_name)
			{
			case "GX:TRACK":
			$GLOBALS['flagA'] = 1;
			break; 
			case "WHEN":
			$GLOBALS['flagB'] = 1;
			break; 
			case "GX:COORD":
			$GLOBALS['flagB'] = 1;
			break; 
			}
	}
	else if ($_GET["type"]==="speed")
	{
		switch($element_name)
			{
			case "GX:SIMPLEARRAYDATA":
				if ($element_attrs["NAME"]==="speed")	{$GLOBALS['flagA'] = 1;}
			break; 
			case "GX:VALUE":
			$GLOBALS['flagB'] = 1;
			break; 
			}
	}
	
  }

//Function to use at the end of an element
function stop($parser,$element_name)
  {
	if ($_GET["type"]==="coord")
	{
		switch($element_name)
		{
		case "GX:TRACK":
		$GLOBALS['flagA'] = 0;
		break; 
		case "WHEN":
		if (($GLOBALS['flagA']==1)&&($GLOBALS['flagB']==1))
		echo " ";
		$GLOBALS['flagB'] = 0;
		break; 
		case "GX:COORD":
		if (($GLOBALS['flagA']==1)&&($GLOBALS['flagB']==1))
		echo "<br>";
		$GLOBALS['flagB'] = 0;
		break; 
		}
	}
	else if ($_GET["type"]==="speed")
	{
		switch($element_name)
			{
			case "GX:SIMPLEARRAYDATA":
			$GLOBALS['flagA'] = 0;
			break; 
			case "GX:VALUE":
			if (($GLOBALS['flagA']==1)&&($GLOBALS['flagB']==1))
			echo "<br>";
			$GLOBALS['flagB'] = 0;
			break; 
			}
	}
  }

//Function to use when finding character data
function char($parser,$data)
  {
	  if (($GLOBALS['flagA']==1)&&($GLOBALS['flagB']==1))
	  {
		  echo $data;
	  }
  }
  
  

//Specify element handler
xml_set_element_handler($parser,"start","stop");

//Specify data handler
xml_set_character_data_handler($parser,"char");

$fileName =  glob("../data/".$_GET["folder"]."/".$_GET["file"]);
//Open XML file
$fp = fopen($fileName[0],"r");

//Read data
while ($data=fread($fp,4096))
  {
  xml_parse($parser,$data,feof($fp)) or 
  die (sprintf("XML Error: %s at line %d", 
  xml_error_string(xml_get_error_code($parser)),
  xml_get_current_line_number($parser)));
  }

//Free the XML parser
xml_parser_free($parser);

fclose($fp);
?>
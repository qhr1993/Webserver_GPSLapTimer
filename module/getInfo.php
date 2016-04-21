<?php
$fileName =  glob("../data/".$_GET["folder"]."/*.txt");
$file = fopen($fileName[0],"r");
$content = fread($file,filesize($fileName[0]));
fclose($file);
$array = explode("_",$content);
echo str_ireplace("\n","<br/>",$array[$_GET["seq"]]);
?>
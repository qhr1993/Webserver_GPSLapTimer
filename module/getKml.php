<?php
$array =  glob("../data/".$_GET["folder"]."/*.kml");
foreach ($array as $folder)
{
	echo basename($folder),"_";
}
?>
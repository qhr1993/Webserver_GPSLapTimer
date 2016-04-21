<?php
$array =  glob("../data/*",GLOB_ONLYDIR);
foreach ($array as $folder)
{
	echo basename($folder),"_";
}
?>
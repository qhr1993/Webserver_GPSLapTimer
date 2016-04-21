<?php
// THIS IS ONLY A SAMPLE SCRIPT. PLEASE TWEAK IT TO YOUR NEEDS.
// IT COMES WITH NO WARRANTY WHATSOEVER. 
$file = "tmp/gps-position.txt"; // you might save in a database instead...
if ($_GET["mode"]==="coord") {
    $fh = fopen($file, "w");
    if (!$fh) {
        header("HTTP/1.0 500 Internal Server Error");
        exit(print_r(error_get_last(), true));
    }
    fwrite($fh, "coord"."_".$_GET["lon1"]."_".$_GET["lat1"]."_".$_GET["spd1"]."_".$_GET["alt1"].
							"_".$_GET["lon2"]."_".$_GET["lat2"]."_".$_GET["spd2"]."_".$_GET["alt2"].
							"_".$_GET["lon3"]."_".$_GET["lat3"]."_".$_GET["spd3"]."_".$_GET["alt3"].
							"_".$_GET["lon4"]."_".$_GET["lat4"]."_".$_GET["spd4"]."_".$_GET["alt4"].
							"_".$_GET["lon5"]."_".$_GET["lat5"]."_".$_GET["spd5"]."_".$_GET["alt5"]."_");
        fwrite($fh, mt_rand()); 
    fclose($fh);
    // you should obviously do your own checks before this...
    echo "coord OK";
	} 
elseif ($_GET["mode"]==="waypt") {
    $fh = fopen($file, "w");
    if (!$fh) {
        header("HTTP/1.0 500 Internal Server Error");
        exit(print_r(error_get_last(), true));
    }
    fwrite($fh, "waypt"."_".$_GET["no"]."_".$_GET["time"]."_".$_GET["dev"]."_");
        fwrite($fh, mt_rand());
    fclose($fh);
    // you should obviously do your own checks before this...
    echo "waypt OK";
	}
elseif ($_GET["mode"]==="finish") {
	$info="";
    $fh = fopen($file, "w");
    if (!$fh) {
        header("HTTP/1.0 500 Internal Server Error");
        exit(print_r(error_get_last(), true));
    }
    fwrite($fh, "finish"."_".$_GET["count"]."_".$_GET["time"]."_".$_GET["dev"]."_".$info."_");
        fwrite($fh, mt_rand());
    fclose($fh);
    // you should obviously do your own checks before this...
    echo "finish OK";
	}
elseif ($_GET["mode"]==="init") {
    $fh = fopen($file, "w");
    if (!$fh) {
        header("HTTP/1.0 500 Internal Server Error");
        exit(print_r(error_get_last(), true));
    }
    fwrite($fh, "init"."_");
        fwrite($fh, mt_rand());
    fclose($fh);
    // you should obviously do your own checks before this...
    echo "init OK";
	}
elseif ($_GET["mode"]==="quit") {
    $fh = fopen($file, "w");
    if (!$fh) {
        header("HTTP/1.0 500 Internal Server Error");
        exit(print_r(error_get_last(), true));
    }
    fwrite($fh, "quit"."_");
        fwrite($fh, mt_rand());
    fclose($fh);
    // you should obviously do your own checks before this...
    echo "quit OK";
	}
 else {
    header('HTTP/1.0 400 Bad Request');
    echo 'ERROR. Please check GET parameters.';
}
?>
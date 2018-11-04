<?php

header('Content-Type: text/event-stream');
header('Cache-Control: no-cache'); // recommended to prevent caching of event data.

/**
 * Constructs the SSE data format and flushes that data to the client.
 *
 * 
 * @param string $msg Line of text that should be transmitted.
 */
function sendMsg($msg) {
    echo "data: $msg" . PHP_EOL;
    echo PHP_EOL;
    ob_flush();
    flush();
    sleep(20);
}

$serverTime = time();

$valuep = "All life is an experiment. The more experiments you make the better.";

$choose = 1;
$linecount = 0;
$paas = true;
$texts = array();

function typeR($file) {
    //
    //$file = "adviceA.txt";
    global $texts;
    $linecount = 0;
    if (($handle = fopen("$file", "r")) !== FALSE) {

        while (!feof($handle)) {
            $line = fgets($handle);
            $linecount++;
        }

        fclose($handle);
        $texts = file($file);
        return $linecount;
    }
    
}

function typeS($file) {

    //echo $linecount;
    global $linecount, $paas;
    //firstrun
    if ($paas == true) {
        $linecount = typeR($file);
        $paas = false;
    }




    if ($linecount == 0) {
        $valuep = "Find ecstasy in life; the mere sense of living is joy enough.";
    } else {
        //read line choosen from file

        global $valuep;
        global $choose;
        global $texts;
        $choose = rand(1, $linecount);
        $cntrp = 1;
        $linecount = 0;

        

        if (texts == NULL) {
            $valuep = "However difficult life may seem, there is always something you can do and succeed at.";
        } else {
            $valuep = $texts[$choose];
        }
    }

    return $valuep;
}

if (isset($_COOKIE["st"])) {
//check if is type A or Type B patient
    if ($_COOKIE["st"] == "A") {
        $valuep = typeS("adviceA.txt");
    } elseif ($_COOKIE["st"] == "B") {
        $valuep = typeS("adviceB.txt");
    } else {
        $valuep = " ";
    }
} else {

    $valuep = " ";
}

sendMsg($valuep);
?>
<?php
if (!isset($_GET['q'])) {
	echo 'N/A';
	return;
}

$q = $_GET['q'].' movie';
$a = file_get_contents("https://www.google.co.in/search?start=0&gws_rd=cr&gbv=1&lr=en&ei=x&q=".urlencode($q));
$classname = "_B5d";

$internalErrors = libxml_use_internal_errors(true);
    $domdocument = new DOMDocument();
    $domdocument->loadHTML($a);
    $a = new DOMXPath($domdocument);
    $spans = $a->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

    for ($i = $spans->length - 1; $i > -1; $i--) {
        $result[] = $spans->item($i)->firstChild->nodeValue;
    }
    if (!isset($result)) {
    	$result = ['N/A'];
    }
    $res = [];
    $res[] = $result[0];
    $resarr['movie'] = $res;
    //echo $resarr;
    print_r(json_encode($resarr));
?>

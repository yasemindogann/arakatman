
<?php

//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');

$xml_link = 'http://localhost/arakatman/obs_xml.php';

$xml = simplexml_load_file($xml_link);
$array = json_decode(json_encode(array($xml)), TRUE);
$sys->pre($array);

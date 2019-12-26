<?php
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');



$data = array(
    'xml' => isset($_SESSION['xml']) ? $_SESSION['xml'] : 'http://localhost/arakatman/default.xml',
    'xml_id' => isset($_SESSION['xml_id']) ? $_SESSION['xml_id'] : 1
);

$mesaj = 'Dikkat! Önce Bu dersin gönderileceği bir Moodle kategorisi seçiniz';

if(isset($_POST['xml'])){
    $_SESSION['xml'] = $_POST['xml'];
    $_SESSION['xml_id'] = $_POST['xml_id'];
    header("Location: xml_tanimla.php");
    exit();
} 



//$sys->pre($_SESSION['xml']);


$data['mesaj'] = $mesaj;



//HTML KODLARI
include ('view/header.php');
include ('view/xml_tanimla.php');
include ('view/footer.php');
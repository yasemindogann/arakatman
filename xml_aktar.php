<?php
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');

$xml_link = isset($_SESSION['xml']) ? $_SESSION['xml'] : 'http://localhost/arakatman/default.xml';
$xml_id = isset($_SESSION['xml_id']) ? $_SESSION['xml_id'] : 1;


if(isset($_GET['ders_temizle'])){
    $sys->aktarim_sistemini_temizle_ders($xml_id);
    header("Location: index.php");
    exit();
}

if(isset($_GET['ogrenci_temizle'])){
    $sys->aktarim_sistemini_temizle_ogrenci($xml_id);
    header("Location: index.php");
    exit();
}


$mesaj = 'Dikkat! Önce Bu dersin gönderileceği bir Moodle kategorisi seçiniz';

if(isset($_POST['xml'])){
    $_SESSION['xml'] = $_POST['xml'];
    header("Location: xml_tanimla.php");
    exit();
} 


$xml = simplexml_load_file($xml_link);
$array = json_decode(json_encode(array($xml)), TRUE);

$mesaj = 'Aktarım işlemi başladı<br>';

if(isset($array[0]['LESSON'])){ foreach($array[0]['LESSON'] as $veri){


    $mesaj .= $sys->obs_ders_ekle($veri['NAME'],$veri['SHORTNAME'],'',$xml_id);
    if($veri['STUDENTS']){ foreach($veri['STUDENTS'] as $ogr){
        if(isset($ogr['EMAIL'])){
            $mesaj .= $sys->obs_ogrenci_ekle($ogr['USERNAME'],$ogr['NAME'],$ogr['LASTNAME'],$ogr['EMAIL'],$veri['SHORTNAME'],$xml_id);
        }
        if(isset($veri['STUDENTS']['STUDENT'])){ foreach($veri['STUDENTS']['STUDENT'] as $ogr2){
            
            if(isset($ogr2['EMAIL'])){
                $mesaj .= $sys->obs_ogrenci_ekle($ogr2['USERNAME'],$ogr2['NAME'],$ogr2['LASTNAME'],$ogr2['EMAIL'],$veri['SHORTNAME'],$xml_id);
            }
        }}
        
    }}
    $mesaj .='<hr>';
}}



$data['mesaj'] = $mesaj;



//HTML KODLARI
include ('view/header.php');
include ('view/xml_aktar.php');
include ('view/footer.php');
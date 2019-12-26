<?php
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');

#EĞER FORM POST EDILMIŞSE
if(isset($_POST['moodle_kisa_ad'])){ 
    $son_ders = $sys->arakatman_karsilik_guncelle(strtoupper($_POST['obs_kisa_ad']),strtoupper($_POST['moodle_kisa_ad']),$_POST['obs_ad']);//Moodle karşılığını arakatmandaki tabloya yaz
}

//EĞER DERS ID GONDERİLDİ İSE Alır
$obs_ders_id = false;//hata vermemesi için tanımlandı
$son_ders = array(NULL);//hata vermemesi için tanımlandı

if(isset($_GET['obs_ders_id'])){ 
    $obs_ders_id = $_GET['obs_ders_id'];//gelen ders ıd sını alır
    $son_ders = $sys->obs_dersler($obs_ders_id);//İlişki tanımlanacak ders dersin id parametresi ile çekilir.  
}

if(isset($_GET['duzenle_id'])){ 
    $duzenle_id = $_GET['duzenle_id'];//gelen ders ıd sını alır
    $son_ders = $sys->obs_dersler($duzenle_id);//İlişki tanımlanacak ders dersin id parametresi ile çekilir.  
}

$data = array(
    'obs_ders' => $son_ders[0], //Gelen tek obs dersnini viewe gönderir
    'moodle_dersler' => $sys->moodle_dersler(),//Moodle'daki dersleri çeker
    'obs_ders_id' => $obs_ders_id,
);

//$sys->pre($data);


//HTML KODLARI
include ('view/header.php');
include ('view/iliski.php');
include ('view/footer.php');
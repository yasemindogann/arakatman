<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');

#EĞER FORM POST EDILMIŞSE
if(isset($_POST['moodle_kisa_ad'])){ 
    $son_ders = $sys->arakatman_karsilik_guncelle($_POST['obs_kisa_ad'],$_POST['moodle_kisa_ad']);//Moodle karşılığını arakatmandaki tabloya yaz
}


//EĞER DERS ID GONDERİLDİ İSE AL
$obs_ders_id = false;//hata vermemesi için tanımlandı
$son_ders = array(NULL);//hata vermemesi için tanımlandı
if(isset($_GET['obs_ders_id'])){ 
    $obs_ders_id = $_GET['obs_ders_id'];//gelen ders ıd sını aldık
    $son_ders = $sys->obs_dersler($obs_ders_id);//Id gondererek çektik tek ders ilişki tanımalamak için  
}

$data = array(
    'obs_ders' => $son_ders[0], //Gelen tek obs dersnini viewe gönderdik
    'moodle_dersler' => $sys->moodle_dersler(),//Moodle'daki dersleri çektik5
);

//$sys->pre($_POST);


//HTML KODLARI
include('view/header.php');
include('view/iliski.php');
include('view/footer.php');
<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');


//EĞER DERS ID GONDERİLDİ İSE Al
$obs_ders_id = false;
$son_ders = array(NULL);// get parametresi yok ise hata almamak için

if(isset($_GET['obs_ders_id'])){ 
    $obs_ders_id = $_GET['obs_ders_id'];//ders id parametresini alıyoruz
    $son_ders = $sys->obs_dersler($obs_ders_id); //obs de ıd gönderdiğim dersi getir
}

$data = array(
    'obs_ders' => $son_ders[0],
);


$mesaj = $sys->moodle_ders_ekle($data['obs_ders']); //Moodle a ekleme fonksiyonu

$data['mesaj'] = $mesaj;



//HTML KODLARI
include('view/header.php');
include('view/senkron.php');
include('view/footer.php');
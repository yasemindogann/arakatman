<?php
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');


//EĞER DERS ID GONDERİLDİ İSE Al
$obs_ders_id = false;
$son_ders = array(NULL);// get parametresi yok ise hata almamak için

if(isset($_GET['obs_ders_id'])){ 
    $obs_ders_id = $_GET['obs_ders_id'];//ders id parametresini alıyoruz
    $son_ders = $sys->obs_dersler($obs_ders_id); //obs de ıd gönderdiğim dersi getir
}

#EÇKTİĞİMİZ DERSTEN OGRENCİ SENKRON SAYFASINA KISA ADI AKTARMAK İÇİN KONTROL
if($son_ders[0]['moodle_karsiligi']){
    $son_kisa_ad = $son_ders[0]['moodle_karsiligi'];
} else {
    $son_kisa_ad = $son_ders[0]['kisa_adi'];
}

$data = array(
    'obs_ders' => $son_ders[0],
    'obs_ders_id' => $obs_ders_id,
    'son_kisa_ad' =>$son_kisa_ad,
    'moodle_kategoriler' => $sys->moodle_kategoriler(),
    'moodle_ders_id' => false,
    'mesaj' => 'Dikkat! Önce Bu dersin gönderileceği bir Moodle kategorisi seçiniz',
);

if(isset($_POST['kategori_id'])){
    $gelendata = $sys->moodle_ders_ekle($data['obs_ders'],$_POST['kategori_id']); //Moodle a ekleme fonksiyonu
    $data['mesaj'] = $gelendata['mesaj'];
    $data['moodle_ders_id'] = $gelendata['moodle_ders_id'];
}

//$sys->pre($data);


//HTML KODLARI
include ('view/header.php');
include ('view/senkron.php');
include ('view/footer.php');
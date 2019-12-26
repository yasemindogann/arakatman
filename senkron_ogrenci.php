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
    'moodle_ornek_ders' => $sys->moodle_ornek_ders_cek(), // Hangi derse kaydedilmiş öğrenciler gibi kaydedilsin
    'moodle_ders_id' => isset($_GET['moodle_ders_id']) ?  $_GET['moodle_ders_id'] : false,//öğrenciler hangi derse kayıt olsuı
);

$mesaj = 'Öğrencileri aktarmak için gerekli seçimleri yapınız!'; 
if(isset($_POST['kisa_ad'])){
    $mesaj = $sys->moodle_ogrenci_ekle_baslat($_POST); //Moodle a ekleme fonksiyonu
}

$data['mesaj'] = $mesaj;

//$sys->pre($data);


//HTML KODLARI
include ('view/header.php');
include ('view/senkron_ogrenci.php');
include ('view/footer.php');
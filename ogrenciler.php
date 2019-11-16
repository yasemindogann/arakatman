<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');


#$dersler = $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri değişkene aktarır
#echo $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri ekrana yazdırır
#echo "<pre>";//arrayları anlaşılır şekilde yazmak için
#print_r($sys->obs_dersler());//arrayları yazdırmak için

$data = array(

    'mdl_user' => $sys->moodle_ogrenciler(),
    'obs_user' => $sys->obs_ogrenciler(),
);

//$sys->pre($data);


//HTML KODLARI
include('view/header.php');
include('view/ogrenciler.php');
include('view/footer.php');
<?php
//CONFIG
include ('config.php');
//MODELS
include ('model/System.php');


#$dersler = $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri değişkene aktarır
#echo $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri ekrana yazdırır
#echo "<pre>";//arrayları anlaşılır şekilde yazmak için
#print_r($sys->obs_dersler());//arrayları yazdırmak için

$data = array(

    'moodle_dersler' => $sys->moodle_dersler_say(),
    'moodle_ogrenciler' => $sys->moodle_ogrenciler_say(),
);

//$sys->pre($data);


//HTML KODLARI
include ('view/header.php');
include ('view/index.php');
include ('view/footer.php');
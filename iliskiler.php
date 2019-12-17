<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');


#$dersler = $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri değişkene aktarır
#echo $sys->obs_dersler(); //Class içinde fonksiyondan dönen değeri ekrana yazdırır
#echo "<pre>";//arrayları anlaşılır şekilde yazmak için
#print_r($sys->obs_dersler());//arrayları yazdırmak için

$ara = false;
if(isset($_GET['ara'])){
    $ara = $_GET['ara'];
}

$data = array(

    'iliskiler' => $sys->ders_iliskileri($ara), 
    'ara_value' => $ara,  
);

//$sys->pre($data);

//HTML KODLARI
include('view/header.php');
include('view/iliskiler.php');
include('view/footer.php');
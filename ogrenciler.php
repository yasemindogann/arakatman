<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');


$data = array(

    'mdl_user' => $sys->moodle_ogrenciler(),//Moodle veritabanında bulunan dersleri çeker
    'obs_user' => $sys->obs_ogrenciler(),//OBS veritabanında bulunan dersleri çeker
);

//$sys->pre($data);


//HTML KODLARI
include('view/header.php');
include('view/ogrenciler.php');
include('view/footer.php');
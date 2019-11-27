<?php
//CONFIG
require_once ('config.php');
//MODELS
include ('model/System.php');


$data = array(

    'obs_dersler'    => $sys->obs_dersler(),//obs_dersler veritabanından dersler çeker
    'moodle_dersler' => $sys->moodle_dersler(),//moodle veritabanından dersler çeker
    'mdl_user'       => $sys->moodle_ogrenciler(),//moodle veritabanından ögrencileri çeker

);


//$sys->pre($data);

//HTML KODLARI
include ('view/header.php');
include ('view/dersler.php');
include ('view/footer.php');
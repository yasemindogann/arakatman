<?php
//CONFIG
require_once ('config.php');
//MODELS
include('model/System.php');

$data = array(
    'obs_dersler' => $sys->obs_dersler(),
);

echo json_encode($data['obs_dersler']); //veya XML - Cron Job


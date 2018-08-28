<?php 

include 'config.php';
date_default_timezone_set('Asia/Kolkata');

$ppm = $_GET['ppm'];
$msg = "";

$ppm += 300;

if ($ppm > 0 and $ppm < 450){
    $msg = "air is good";
    break;
}else if ($ppm > 400 and $ppm < 600){
    $msg = "air is slightly Concentrated";
}else if ($ppm > 600 and $ppm < 1000){
    $msg = "air is  Highly Concentrated";
}
else{
    $msg = "air is  Higly Concentrated";
} 

$live = R::dispense('histrory');
$live->ppm=$ppm;
    $live->message=$msg;
    $live->status='Pollution';
    $live->date=date('d-m-Y H:i');
    $liveid=R::store($live);
    
?>
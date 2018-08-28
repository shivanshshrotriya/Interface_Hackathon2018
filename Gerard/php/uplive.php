<?php 

include 'config.php';
date_default_timezone_set('Asia/Kolkata');

$ppm = $_GET['ppm'];
$msg = "";

$ppm += 300; 

function notify(){
    $nofity = array(
        "en" => "" . $msg
    );

    $fields = array(
        'app_id' => "67f07798-346e-40a0-8c60-9fa023242fd8",
        'included_segments' => array('All'),
        'data' => array("foo" => "bar"),
        'contents' => $nofity,
        'smail_icon'=> 'icon'
        );

    $fields = json_encode($fields);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MmEyMmViMTYtMjVlMi00ZDIxLWJlNDYtNjM3MzQ3MDIxM2Fl'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
}

if ($ppm > 0 and $ppm < 450){
    $msg = "CO2 is good";
}else if ($ppm > 400 and $ppm < 600){
    $msg = "CO2 is slightly Concentrated";
    $nofity = array(
        "en" => "" . $msg

    );

    $fields = array(
        'app_id' => "67f07798-346e-40a0-8c60-9fa023242fd8",
        'included_segments' => array('All'),
        'data' => array("foo" => "bar"),
        'contents' => $nofity,
        'smail_icon'=> 'icon'
        );

    $fields = json_encode($fields);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MmEyMmViMTYtMjVlMi00ZDIxLWJlNDYtNjM3MzQ3MDIxM2Fl'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
}else if ($ppm > 600 and $ppm < 1000){
    $msg = "CO2 is Highly Concentrated";
    $nofity = array(
        "en" => "" . $msg

    );

    $fields = array(
        'app_id' => "67f07798-346e-40a0-8c60-9fa023242fd8",
        'included_segments' => array('All'),
        'data' => array("foo" => "bar"),
        'contents' => $nofity,
        'smail_icon'=> 'icon'
        );

    $fields = json_encode($fields);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MmEyMmViMTYtMjVlMi00ZDIxLWJlNDYtNjM3MzQ3MDIxM2Fl'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
}
else{
    $msg = "CO2 is Highly Polluted";
    $nofity = array(
        "en" => "" . $msg

    );

    $fields = array(
        'app_id' => "67f07798-346e-40a0-8c60-9fa023242fd8",
        'included_segments' => array('All'),
        'data' => array("foo" => "bar"),
        'contents' => $nofity,
        'smail_icon'=> 'icon'
        );

    $fields = json_encode($fields);


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
        'Authorization: Basic MmEyMmViMTYtMjVlMi00ZDIxLWJlNDYtNjM3MzQ3MDIxM2Fl'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

    $response = curl_exec($ch);
    curl_close($ch);
} 

$live = R::dispense('live');
$live->ppm=$ppm;
    $live->message=$msg;
    $live->status='Pollution';
    $live->date=date('d-m-Y H:i');
    $liveid=R::store($live);
?>
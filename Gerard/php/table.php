<?php

include 'config.php';
date_default_timezone_set('Asia/Kolkata');

$live = R::dispense('live');
    $live->ppm='500';
    $live->message='too high ppm';
    $live->status='Meduim Pollution';
    $live->date=date('d-m-Y H:i');
    $liveid=R::store($live);
    
    echo ''.$liveid;
    
    $histrory = R::dispense('histrory');
    $histrory->ppm='800';
    $histrory->message='too high ppm';
    $histrory->status='Meduim Pollution';
    $histrory->date=date('d-m-Y H:i');
    $histroryid=R::store($histrory);
    
    
    echo ''.$histroryid;
    
    
    

?>
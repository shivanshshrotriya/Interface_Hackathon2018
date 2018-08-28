<?php


header('Content-type: application/json');
include 'config.php';
$result = R::getAll('select * from histrory ORDER BY id DESC ');
echo json_encode(array("HistroryData"  => $result));

?>
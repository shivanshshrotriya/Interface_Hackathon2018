<?php


header('Content-type: application/json');
include 'config.php';
$result = R::getAll('select * from live ORDER BY id DESC LIMIT 1');
echo json_encode(array("LiveData"  => $result));

?>
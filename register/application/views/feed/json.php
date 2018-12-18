<?php
$print = false;

if($print){
    var_dump($json);
}else{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($json);
}
?>
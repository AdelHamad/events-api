<?php

require_once "includes/config.php";

$id = isset($_GET['id']) ? make_safe($_GET['id']) : null;
$page = isset($_GET['page']) ? make_safe($_GET['page']) : null;
$size = isset($_GET['size']) ? make_safe($_GET['size']) : null;

$result = array();

if (isset($id)){
    $result = get_event_by_id($id);
}elseif (isset($page) && isset($size)){
    $result['events'] = get_events($page, $size);
}else{
    $result['error'] = "please check entered parameters...";
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  
echo json_encode($result, true);
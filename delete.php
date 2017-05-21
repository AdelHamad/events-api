<?php

require_once "includes/config.php";
$id = isset($_GET['id']) ? make_safe($_GET['id']) : null;

$result = array();

if (isset($id)){
    $is_deleted = delete_event($id);
    if ($is_deleted){
    	$result['code'] = 1;
		$result['msg'] = "event id = " . $id . " has been successfully deleted.";
    }else{
    	$result['code'] = -1;
		$result['msg'] = "there is no row with id = " . $id;
    } 
}else{
    $result['code'] = -1;
    $result['msg'] = "please check entered parameters...";
}

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  
echo json_encode($result, true);
<?php
require_once "includes/config.php";

$data = array(
    'username' => make_safe($_POST['username']),
    'password' => encode_password(make_safe($_POST['password'])),
    'email' => make_safe($_POST['email']),
);

$response = signup($data);

$result['code'] = $response ? 1 : -1;
$result['msg'] = $response ? "Register Success" : "Register Faild";


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  
echo json_encode($result, true);
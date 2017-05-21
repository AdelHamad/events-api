<?php
require_once "includes/config.php";
$username = make_safe($_POST['username']);
$password = encode_password(make_safe($_POST['password']));

$user_info =  signin($username , $password);

$is_verified = $user_info ? true : false;

$result['code'] = $is_verified ? 1 : -1;
$result['msg'] = $is_verified ? "SignIn Success" : "SignIn Faild";

if ($is_verified) $_SESSION['events']['user_info'] = $user_info;

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  
echo json_encode($result, true);
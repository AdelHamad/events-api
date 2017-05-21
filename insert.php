<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');  

require_once "includes/config.php";
// var_dump($_POST);
// var_dump($_FILES);
// exit;

$file_name = generate_code();
while (file_exists("../files/img/" . $file_name . ".jpg")) {
    $file_name = generate_code();
}

$pic = "assets/img/placeholder.jpg";
if (isset($_FILES['pic'])){
    @$handle = new upload($_FILES['pic']);
    if (@$handle->uploaded) {
        $handle->file_new_name_body = $file_name;
        $handle->mime_check = true;
        $handle->allowed = array('image/*');
        $handle->image_convert = 'jpg';
        $handle->image_x = 200;
        $handle->image_y = 200;
        $handle->image_resize = true;
        $handle->image_ratio = true;
        $handle->image_ratio_fill = true;
        $handle->process('files/img/');
        if (@$handle->processed) {
            $pic = "files/img/".$file_name.".jpg";
        } else {
            echo 'error : ' . $handle->error;
        }
    }
}

// var_dump($_POST);
// var_dump($_FILES);
// var_dump($pic);
// exit;


$title = isset($_POST['title']) ? make_safe($_POST['title']) : null;
$desc = isset($_POST['desc']) ? make_safe($_POST['desc']) : null;
$start_date = isset($_POST['start_date']) ? make_safe($_POST['start_date']) : null;
$insert_date = time();
$location = isset($_POST['location']) ? make_safe($_POST['location']) : null;
$longitude = isset($_POST['longitude']) ? make_safe($_POST['longitude']) : null;
$latitude = isset($_POST['latitude']) ? make_safe($_POST['latitude']) : null;

$result = array();

if (!isset($title) || !isset($desc) || !isset($start_date) ||
    empty($title) || empty($desc) || empty($start_date)){
    $result['code'] = "-1";
    $result['msg'] = "one or more required parameters is not set...";
}else{
    // $location = array();
    // if (isset($longitude) && isset($latitude)){
    //     $location['longitude'] = $longitude;
    //     $location['latitude'] = $latitude;
    // }
    if (!is_valid_timestamp($start_date)){
        $result['code'] = "-1";
        $result['msg'] = "please enter valid date";
    }else{
        $data = array(
            "title" => $title,
            "desc" => $desc,
            "start_date" => $start_date,
            "insert_date" => $insert_date,
            "pic" => $pic,
            "longitude" => $longitude,
            "latitude" => $latitude,
            "location" => $location
        );
        $is_inserted = insert_event($data);
        if ($is_inserted){
            $result['code'] = "1";
            $result['msg'] = "the event has been inserted successfully";
        }else{
            $result['code'] = "-1";
            $result['msg'] = "please check entered parameters...";
        } 
    }
}

echo json_encode($result, true);
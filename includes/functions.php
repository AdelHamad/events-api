<?php

function escape_db_chars($value)
{
    $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
    $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}
function make_safe($data)
{
	$data = trim($data);
	$data = addslashes($data);
	$data = htmlspecialchars($data);
    $data = escape_db_chars($data);
	return $data;
}

function redirect($pageName)
{
	@header("Location: ". $pageName ."");
    echo "<script language='JavaScript' type='text/JavaScript'>" .
        "window.location='" . $pageName . "'</script>";
	
    exit;
}

function timestamp_to_date($timestamp)
{
    return '<div style="direction: rtl">' . date('Y/m/d', $timestamp) . " " . _AtHour . " " . date('H:m', $timestamp) . '</div>';
}

function guid()
{
    if (function_exists('com_create_guid') === true) {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function is_valid_timestamp($timestamp)
{
    return ((string) (int) $timestamp === $timestamp)
    && ($timestamp <= PHP_INT_MAX)
    && ($timestamp >= ~PHP_INT_MAX);
}

function generate_code()
{
    return md5(uniqid(rand()));
}

function encode_password($password)
{
    $salt = "adel";
    return crypt($password, $salt);
}

<?php

require_once(APP_PATH . '/includes/db/MysqliDb.php');

$live_links = array(
    'db_server' => 'localhost',
    'db_user' => 'root',
    'db_pass' => '',
    'db_name' => 'events'
);

$current_links = $live_links;


$db = new MysqliDb ($current_links['db_server'], $current_links['db_user'], $current_links['db_pass'], $current_links['db_name']);

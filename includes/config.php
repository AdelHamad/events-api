<?php
session_start();
define("APP_PATH", realpath(dirname(__FILE__) . '/..'));

require_once(APP_PATH . '/includes/functions.php');

require_once(APP_PATH . '/includes/authorization.php');

require_once(APP_PATH . '/includes/upload.php');

require_once(APP_PATH . '/includes/queries.php');
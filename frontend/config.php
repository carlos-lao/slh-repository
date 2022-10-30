<?php
session_start(); // put it here so session is started on every page that requries the config
define('DB_HOST', 'localhost:8889');
define("DB_USER", "root");
define("DB_PASS", "root");
define("DB_NAME", "slh-repository");

?>
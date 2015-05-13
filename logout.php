<?php
include_once "connect_server.php";
    session_start();
    session_destroy();
	include_once $_SERVER['DOCUMENT_ROOT'] . '/redirect.php';
    Redirect('/index.php');
?>
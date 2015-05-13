<?php
session_start();
$_SESSION["uExam_id"] = 0;
include_once $_SERVER['DOCUMENT_ROOT'] . '/redirect.php';
Redirect('/index.php');
?>

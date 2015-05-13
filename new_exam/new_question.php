<?php
    
    session_start();
    if($_SESSION["status"] == 2){
    include_once "../connect_server.php";
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());
	// Выбор БД
	mysql_select_db(db) or die(mysql_error());
        
    	$strSQL = "INSERT INTO `" . db . "`.`" . question_dbt . "` (`id`,`exam_id`,`content`) ";
	    $strSQL = $strSQL .  "VALUES (NULL, '"  . $_POST["exam_id"] . "', '"  . $_POST["content"] . "')";
	    $rs = mysql_query($strSQL);
        include_once $_SERVER['DOCUMENT_ROOT'] . '/redirect.php';
        Redirect('/show_exam/show.php');
    }
        
    else{
        echo "You are not allowed to be here =\ ";
    }
?>
<?php
    
    session_start();
    if($_SESSION["status"] == 2){
    include_once "../connect_server.php";
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());
	// Выбор БД
	mysql_select_db(db) or die(mysql_error());
        
        $strSQL = "DELETE FROM " . question_dbt . " WHERE id = '" . $_POST["question_id"] . "'";
	    $rs = mysql_query($strSQL);
	    include_once $_SERVER['DOCUMENT_ROOT'] . '/redirect.php';
        Redirect('/show_exam/show.php');
    }
        
    else{
        echo "You are not allowed to be here =\ ";
    }
?>
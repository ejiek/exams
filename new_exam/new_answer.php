<?php
    
    session_start();
    if($_SESSION["status"] == 2){
    include_once "../connect_server.php";
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());
	// Выбор БД
	mysql_select_db(db) or die(mysql_error());
        
    	$strSQL = "INSERT INTO `" . db . "`.`" . answer_dbt . "` (`id`,`question_id`,`content`,`is_correct`) ";
	    $strSQL = $strSQL .  "VALUES (NULL, '"  . $_POST["question_id"] . "', '"  . $_POST["content"] . "', '"  . $_POST["is_correct"] . "')";
	    echo $strSQL;
	    $rs = mysql_query($strSQL);
    }
        
    else{
        echo "You are not allowed to be here =\ ";
    }
?>
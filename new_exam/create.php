<?php
    
    session_start();
    if($_SESSION["status"] == 2){
    include_once "../connect_server.php";
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());
	// Выбор БД
	mysql_select_db(db) or die(mysql_error());
        
    	$strSQL = "INSERT INTO `" . db . "`.`" . exam_dbt . "` (`id`,`Name`,`author_id`,`is_open`,`comment`) ";
    	
    	if($_POST["is_open"] == 'on'){
    	    $is_open = 1;
    	}
    	else{$is_open = 0;}
	    $strSQL = $strSQL .  "VALUES (NULL, '"  . $_POST["name"] . "', '"  . $_POST["author_id"] . "', '"  . $is_open . "', '"  . $_POST["comment"] . "')";
	    echo $strSQL;
	    $rs = mysql_query($strSQL);
	    
	    $strSQL = "SELECT * FROM " . exam_dbt . " WHERE Name = '"  . $_POST["name"] . "', author_id = '"  . $_POST["author_id"] . "', is_open = '"  . $is_open . "', comment = '"  . $_POST["comment"] . "')";
	    include_once $_SERVER['DOCUMENT_ROOT'] . '/redirect.php';
        Redirect('/index.php');
    }
        
    else{
        echo "You are not allowed to be here =\ ";
    }
?>
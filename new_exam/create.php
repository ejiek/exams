<?php
    
    session_start();
    if($_SESSION["status"] == 2){
    include_once "../connect_server.php";
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());
	// Выбор БД
	mysql_select_db(db) or die(mysql_error());
        
    	$strSQL = "INSERT INTO `polyexam`.`exam` (`id`,`Name`,`author_id`,`is_open`,`comment`) ";
	    $strSQL = $strSQL .  "VALUES (NULL, '"  . $_POST["name"] . "', '"  . $_POST["author_id"] . "', '"  . $_POST["is_open"] . "', '"  . $_POST["comment"] . "');";
	    echo $strSQL;
	    $rs = mysql_query($strSQL);
	    
	    $strSQL = "SELECT * FROM " . exam_dbt . " WHERE Name = '"  . $_POST["name"] . "', author_id = '"  . $_POST["author_id"] . "', is_open = '"  . $_POST["is_open"] . "', comment = '"  . $_POST["comment"] . "')";
    }
        
    else{
        echo "You are not allowed to be here =\ ";
    }
?>
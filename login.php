<?php
include_once "connect_server.php";

	// Соединение с сервером БД
	mysql_connect(servername, server_username, server_password) or die (mysql_error ());

	// Выбор БД
	mysql_select_db(db) or die(mysql_error());

    //БЕЛЫЙ СПИСОК?! ПЛЭЙСХОЛДЕРЫ?!
    $username=$_POST['username'];
    
	// SQL-запрос
	$strSQL = "SELECT user_id, login, password FROM " . login_dbt . " WHERE login = 'Student'";
	$rs = mysql_query($strSQL);
    echo $rs;
    // Проверка наличия такого логина + пароля
    if ($rows = mysql_fetch_row($rs)){
        if ($row['password']!=$_POST["password"]){
            echo $row;
            echo "not euqval";
        }
        else{
            session_start();
            $_SESSION["user_id"] = $rs['user_id'];
            echo "good";
            echo $row['user_id'];
        }

    }
    else{
        echo "Error! There is no such user";
    }


	// Закрытие соединения
	mysql_close();
?>
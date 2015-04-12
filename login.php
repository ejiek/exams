<?php
include_once "connect_server.php";

	// Соединение с сервером БД
	mysql_connect($servername, $server_username, $server_password) or die (mysql_error ());

	// Выбор БД
	mysql_select_db($db) or die(mysql_error());

    //БЕЛЫЙ СПИСОК?! ПЛЭЙСХОЛДЕРЫ?!
    $username=$_POST['username'];
    

	// SQL-запрос
	$strSQL = "SELECT * FROM $login_dbt WHERE username='$username'";
	$rs = mysql_query($strSQL);
	$rows=$rs->sql_numrows();
	
    // Проверка наличия такого логина + пароля
    if ($rows==0){
        echo "Error!";
    }
    else{
        if ($rs['password']!=$_POST["password"]){
            echo "Error!";
        }
        else{
            session_start();
            $_SESSION["user_id"] = $rs['user_id'];
        }
    }


	// Закрытие соединения
	mysql_close();
?>
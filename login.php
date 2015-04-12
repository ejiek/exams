<?php
include_once "connect_server.php";

	// Соединение с сервером БД
	mysql_connect(servername, server_username, server_password) or die (mysql_error ());

	// Выбор БД
	mysql_select_db(db) or die(mysql_error());

    //БЕЛЫЙ СПИСОК?! ПЛЭЙСХОЛДЕРЫ?!
    $username=$_POST['username'];
    
	// SQL-запрос
	$strSQL = "SELECT user_id, login, password FROM " . login_dbt . " WHERE login = '$username'";
	$rs = mysql_query($strSQL);
    $row = mysql_fetch_array($rs);
    
    // Проверка наличия такого логина + пароля
    if ($row != 0){
        if ($row['password']==$_POST["password"]){
            session_start();
            $_SESSION["user_id"] = $row['user_id'];
            
            $strSQL = "SELECT Name, status FROM " . user_dbt . " WHERE id = '" . $row['user_id'] . "'";
            $rs = mysql_query($strSQL);
            $row = mysql_fetch_array($rs);
            $_SESSION["status"] = $row['status'];
            $_SESSION["Name"] = $row['Name'];
            echo "session created";
        }
        else{
            echo "Error! Wrong Password</br>";
            echo "p" . $_POST["password"] . "</br>";
            echo "r" . $row['password'] . "</br>";
        }

    }
    else{
        echo "Error! There is no such user";
    }


	// Закрытие соединения
	mysql_close();
?>
<?php
include_once "connect_server.php";
?>
<html>
    <head>
        <title>Welcome!</title>
        <link rel="stylesheet" type="text/css" href="css/header.css">
    </head>
    
    <body>
        <?php
        
        session_start();
        if($_SESSION["user_id"] == 0){
            echo '<form class="login_bord" method="post" action="login.php">';
    		echo '<p><input type="text" name="username" placeholder="Username"></p>';
    		echo '<input type="password" name="password" placeholder="Password">';
    		echo '<div><input type="submit" value="Login">';
    		echo '<input type="submit" value="Sign Up"></div></form></li>';
        }
        
        else{
        
            echo "Hi, ";
            
            // Соединение с сервером БД
        	mysql_connect(servername, server_username, server_password) or die (mysql_error ());

        	// Выбор БД
        	mysql_select_db(db) or die(mysql_error());

        	// SQL-запрос
        	$strSQL = "SELECT Name FROM " . user_dbt . " WHERE id = '" . $_SESSION["user_id"] . "'";
        	$rs = mysql_query($strSQL);
            $row = mysql_fetch_array($rs);
    
            // Проверка наличия такого логина + пароля
            if ($row != 0){
                echo $row['Name'];
            }
            
            
            echo '<a href="logout.php" class="logout_bord">Log Out</a>';
        }
		?>
    </body>
</html>
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
            echo "Hi, " . $_SESSION["Name"] . "\r\n";
            echo '<a href="logout.php" class="logout_bord">Log Out</a>'. "\r\n";
        
            if($_SESSION["status"] == 2){
                
                // Соединение с сервером БД
            	mysql_connect(servername, server_username, server_password) or die (mysql_error ());
    
            	// Выбор БД
              	mysql_select_db(db) or die(mysql_error());
              	
                echo "<br/><div>Your Exams:<br/> \r\n<ul>\r\n";
                $strSQL = "SELECT * FROM " . exam_dbt . " WHERE author_id = '" . $_SESSION["user_id"] . "'";
    	        $rs = mysql_query($strSQL);
                while($row = mysql_fetch_array($rs)){
                    $strExamName = $row['Name'];
                    $strExamID = $row['id'];
                    $strExam_IsOpen = $row['is_open'];
                    $strExamComment = $row['comment'];
                    
                    echo '<div><form method="post" action="show_exam/show.php" style="display:inline;">' . "\r\n";
                    echo '<input type="hidden" name="exam_id" value="' . $strExamID . '">' . "\r\n";
                    echo '<input type="submit" value="' . $strExamName . '"></form>' . "\r\n\r\n";
                    echo '<form method="post" action="/new_exam/delete.php" style="display:inline;">' . "\r\n";
                    echo '<input type="hidden" name="exam_id" value="' . $strExamID . '">' . "\r\n";
                    echo '<input type="submit" value="delete it"></form></div>' . "\r\n";
                }
                echo "</ul> \r\n <a href='new_exam/new_exam.php'>create new exam</a></div>\r\n";
            }	
            else{
                // Соединение с сервером БД
            	mysql_connect(servername, server_username, server_password) or die (mysql_error ());
    
            	// Выбор БД
              	mysql_select_db(db) or die(mysql_error());
              	
                echo "<br/><div>Available exams:<br/> \r\n<ul>\r\n";
                $strSQL = "SELECT * FROM " . exam_dbt . " WHERE is_open = '1'";
    	        $rs = mysql_query($strSQL);
                while($row = mysql_fetch_array($rs)){
                    $strExamName = $row['Name'];
                    $strExamID = $row['id'];
                    $strExam_IsOpen = $row['is_open'];
                    $strExamComment = $row['comment'];
                    $strExamAuthor = $row['author_id'];
                    
                    $strSQLAu = "SELECT * FROM " . user_dbt . " WHERE id = " . $strExamAuthor . "";
    	            $rsAu = mysql_query($strSQLAu);
                    while($rowAu = mysql_fetch_array($rsAu)){
                        $strAuthorName = $rowAu['Name'];
                    }
                    
                    echo '<form method="post" action="/take_exam/questions.php">' . "\r\n";
                    echo '<input type="hidden" name="exam_id" value="' . $strExamID . '">' . "\r\n";
                    echo '<div><input type="submit" value="' . $strExamName . ' (' . $strAuthorName . ')"></div></form>' . "\r\n";
                }
                echo "</ul> \r\n";
            }
        }
		
		?>
    </body>
</html>
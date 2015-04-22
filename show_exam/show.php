<?php
session_start();
include_once "../connect_server.php";
            
             // Соединение с сервером БД
        	mysql_connect(servername, server_username, server_password) or die (mysql_error ());

        	// Выбор БД
          	mysql_select_db(db) or die(mysql_error());

            $strSQL = "SELECT * FROM " . exam_dbt . " WHERE id = '" . $_POST["exam_id"] . "'";
	        $rs = mysql_query($strSQL);
            while($row = mysql_fetch_array($rs)){
                $strExamName = $row['Name'];
                $strExamID = $row['id'];
                $strExam_IsOpen = $row['is_open'];
                $strExamComment = $row['comment'];
                echo 'Exam: ' . $strExamName . '</br>' . "\r\n";
            }
            
            $strSQL = "SELECT * FROM " . question_dbt . " WHERE exam_id = '" . $_POST["exam_id"] . "'";
	        $rs = mysql_query($strSQL);
	        echo "<ul>\r\n";
            while($row = mysql_fetch_array($rs)){
                $strQustContent = $row['Content'];
                $strQuestID = $row['id'];
                echo '<li>' . $strQustContent . '</li>' . "\r\n";
                
                $strAnsSQL = "SELECT * FROM " . answer_dbt . " WHERE question_id = '" . $strQuestID . "'";
	            $rsAns = mysql_query($strSQL);
	            echo "<ul>\r\n";
	            while($rowAns = mysql_fetch_array($rsAns)){
	                $strAnsContent = $rowAns['content'];
	                $strAnsIsCor = $rowAns['is_correct'];
	                echo '<li>' . $strAnsContent . '</li>' . "\r\n";
	            }
                echo "<ul>\r\n";
            }
            echo "<ul>\r\n";


?>
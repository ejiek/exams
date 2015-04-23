<html>
    <head>
        
    </head>
    <body>
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
                echo 'Exam: ' . $strExamName . '<br>' . "\r\n";
            }
            
            $strSQL = "SELECT * FROM " . question_dbt . " WHERE exam_id = '" . $_POST["exam_id"] . "'";
	        $rs = mysql_query($strSQL);
	        echo "<ul>\r\n";
            while($row = mysql_fetch_array($rs)){
                $strQustContent = $row['content'];
                $strQuestID = $row['id'];
                echo '<li>' . $strQustContent . '</li>' . "\r\n";
                
                $strAnsSQL = "SELECT * FROM " . answer_dbt . " WHERE question_id = '" . $strQuestID . "'";
	            $rsAns = mysql_query($strAnsSQL);
	            echo "<ul>\r\n";
	            while($rowAns = mysql_fetch_array($rsAns)){
	                $strAnsContent = $rowAns['content'];
	                $strAnsIsCor = $rowAns['is_correct'];
	                echo '<li>' . $strAnsContent . '</li>' . "\r\n";
	            }
                echo "</ul>\r\n";
                echo "\r\n" . '<form method="post" action="../new_exam/new_answer.php" autocomplete="off">';
    	    	echo "\r\n" . '<p><input type="text" name="content" placeholder="Content"></p>';
    	    	echo "\r\n" . '<input type="checkbox" name="is_correct">Is it correct';
        		echo "\r\n" . '<input type="hidden" name="question_id" value="'. $strQuestID .'">';
    	    	echo "\r\n" . '<div><input type="submit" value="Add Answer"></div></form>';

            }
            echo "</ul>\r\n";
            echo "\r\n" . '<form method="post" action="../new_exam/new_question.php" autocomplete="off">';
    		echo "\r\n" . '<p><input type="text" name="content" placeholder="Content"></p>';
    		echo "\r\n" . '<input type="hidden" name="exam_id" value="'. $strExamID .'">';
    		echo "\r\n" . '<div><input type="submit" value="Add Question"></div></form>';


?>
</body>
</html>
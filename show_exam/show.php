<html>
    <head>
        
    </head>
    <body>
<?php
session_start();
if($_SESSION["status"] == 2){
include_once "../connect_server.php";
            
             // Соединение с сервером БД
        	mysql_connect(servername, server_username, server_password) or die (mysql_error ());

        	// Выбор БД
          	mysql_select_db(db) or die(mysql_error());

if($_POST["exam_id"] != 0){
    $editExam_id = $_SESSION["editExam_id"] = $_POST["exam_id"];
}
else{
    $editExam_id = $_SESSION["editExam_id"];
}


            $strSQL = "SELECT * FROM " . exam_dbt . " WHERE id = '" . $editExam_id . "'";
	        $rs = mysql_query($strSQL);
            while($row = mysql_fetch_array($rs)){
                $strExamName = $row['Name'];
                $strExamID = $row['id'];
                $strExam_IsOpen = $row['is_open'];
                $strExamComment = $row['comment'];
                echo 'Exam: ' . $strExamName . '<br>' . "\r\n";
            }
            
            $strSQL = "SELECT * FROM " . question_dbt . " WHERE exam_id = '" . $editExam_id . "'";
	        $rs = mysql_query($strSQL);
	        echo "<ul>\r\n";
            while($row = mysql_fetch_array($rs)){
                $strQustContent = $row['content'];
                $strQuestID = $row['id'];
                echo '<li>' . $strQustContent . "\r\n";
                    echo '<form method="post" action="/new_exam/delete_question.php" style="display:inline;">' . "\r\n";
                    echo '<input type="hidden" name="question_id" value="' . $strQuestID . '">' . "\r\n";
                    echo '<input type="submit" value="delete it"></form></li>' . "\r\n";
                
                $strAnsSQL = "SELECT * FROM " . answer_dbt . " WHERE question_id = '" . $strQuestID . "'";
	            $rsAns = mysql_query($strAnsSQL);
	            echo "<ul>\r\n";
	            while($rowAns = mysql_fetch_array($rsAns)){
	                $strAnsID = $rowAns['id'];
	                $strAnsContent = $rowAns['content'];
	                $strAnsIsCor = $rowAns['is_correct'];
	                echo '<li>' . $strAnsContent . "\r\n";
                    echo '<form method="post" action="/new_exam/delete_answer.php" style="display:inline;">' . "\r\n";
                    echo '<input type="hidden" name="answer_id" value="' . $strAnsID . '">' . "\r\n";
                    echo '<input type="submit" value="delete it"></form></li>' . "\r\n";
	            }
                echo "\r\n" . '<li><form method="post" action="../new_exam/new_answer.php" autocomplete="off">';
    	    	echo "\r\n" . '<p><input type="text" name="content" placeholder="Content"></p>';
    	    	echo "\r\n" . '<input type="checkbox" name="is_correct">Is it correct';
        		echo "\r\n" . '<input type="hidden" name="question_id" value="'. $strQuestID .'">';
    	    	echo "\r\n" . '<div><input type="submit" value="Add Answer"></div></form></li>';
                echo "</ul>\r\n";

            }
            echo "\r\n" . '<li><form method="post" action="../new_exam/new_question.php" autocomplete="off">';
    		echo "\r\n" . '<p><input type="text" name="content" placeholder="Content"></p>';
    		echo "\r\n" . '<input type="hidden" name="exam_id" value="'. $strExamID .'">';
    		echo "\r\n" . '<div><input type="submit" value="Add Question"></div></form></li>';
            echo "</ul>\r\n";
}
else{
    echo "You are not allowed to be here =\ ";
}

?>
</body>
</html>
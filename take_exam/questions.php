<html>
    <head>
        
    </head>
    <body>
<?php
session_start();
include_once $_SERVER['DOCUMENT_ROOT'] . '/connect_server.php';
    // Соединение с сервером БД
    mysql_connect(servername, server_username, server_password) or die (mysql_error ());

    // Выбор БД
    mysql_select_db(db) or die(mysql_error());

if($_SESSION["uExam_id"] == 0){
    $ExamID = $_POST["exam_id"];
    $strSQL = "INSERT INTO `" . db . "`.`" . user_exam_dbt . "` (`id`,`exam_id`,`user_id`,`date`) ";
	$strSQL = $strSQL .  "VALUES (NULL, '"  . $ExamID . "', '"  . $_SESSION["user_id"] . "', NULL)";
	$rs = mysql_query($strSQL);
	
	$strSQL = "SELECT * FROM " . user_exam_dbt . " WHERE exam_id = '" . $ExamID . "' AND user_id = '" . $_SESSION["user_id"] . "'";
	$rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)){
        $_SESSION["uExam_id"] = $row["id"];
    }
	
	
}
else{
    $strSQL = "SELECT * FROM " . user_exam_dbt . " WHERE id = '" . $_SESSION["uExam_id"] . "'";
	$rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)){
        $ExamID = $row["exam_id"];
    }
}

            $strSQL = "SELECT * FROM " . exam_dbt . " WHERE id = '" . $ExamID . "'";
	        $rs = mysql_query($strSQL);
            while($row = mysql_fetch_array($rs)){
                $strExamName = $row['Name'];
                $strExamID = $row['id'];
                $strExam_IsOpen = $row['is_open'];
                $strExamComment = $row['comment'];
                echo 'Exam: ' . $strExamName . '<br>' . "\r\n";
            }
            
            $strSQL = "SELECT * FROM " . question_dbt . " WHERE exam_id = '" . $ExamID . "'";
	        $rs = mysql_query($strSQL);
	        echo "<ul>\r\n";
            while($row = mysql_fetch_array($rs)){
                $strQustContent = $row['content'];
                $strQuestID = $row['id'];
                
        		echo "\r\n" . '<li><form method="post" action="/take_exam/one_question.php">' . "\r\n";
                echo "\r\n" . '<input type="hidden" name="question_id" value="' . $strExamID . '">' . "\r\n";
                echo "\r\n" . '<div><input type="submit" value="' . $strQustContent . '"></div></form></li>' . "\r\n";
        		
                echo "</ul>\r\n";
                echo "</br><a href='/take_exam/finish.php'>FINISH IT!!!</a>\r\n";  
            }

?>
</body>
</html>
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
 echo 'Why are you here?';
	
}
else{
    $strSQL = "SELECT * FROM " . user_exam_dbt . " WHERE id = '" . $_SESSION["uExam_id"] . "'";
	$rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)){
        $ExamID = $row["exam_id"];
    }
}
    $QuestID = $_POST["question_id"];
    $is_q_already_a = 0;
    $strSQL = "SELECT * FROM " . user_answer_dbt . " WHERE user_exam_id = '" . $_SESSION["uExam_id"] . "'";
	$rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)){
        $QstrSQL = "SELECT * FROM " . answer_dbt . " WHERE id = '" . $row["answer_id"] . "'";
    	$Qrs = mysql_query($QstrSQL);
        while($Qrow = mysql_fetch_array($Qrs)){
            if($Qrow["question_id"] == $QuestID){$is_q_already_a = $is_q_already_a + 1;}
        }
    }

    if($is_q_already_a == 0){
        $strSQL = "SELECT * FROM " . question_dbt . " WHERE id = '" . $QuestID . "'";
        $rs = mysql_query($strSQL);
        while($row = mysql_fetch_array($rs)){
            $strQustContent = $row['content'];
            echo 'Question: ' . $strQustContent . '<br>' . "\r\n";
        }
        
        $strSQL = "SELECT * FROM " . answer_dbt . " WHERE question_id = '" . $QuestID . "'";
        $rs = mysql_query($strSQL);
        echo "<ul>\r\n";
        while($row = mysql_fetch_array($rs)){
            $strAnsContent = $row['content'];
            $strAnsID = $row['id'];
            
    		echo "\r\n" . '<li><form method="post" action="/take_exam/give_answer.php">' . "\r\n";
            echo "\r\n" . '<input type="hidden" name="answer_id" value="' . $strAnsID . '">' . "\r\n";
            echo "\r\n" . '<div><input type="submit" value="' . $strAnsContent . '"></div></form></li>' . "\r\n";
        }
        echo "</ul>\r\n";
    }
    else{
        echo "You've already answered";
    }

?>
</body>
</html>
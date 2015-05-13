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

    //*** Answered check
    //**getting question_id for current answer
    $AnsID = $_POST["answer_id"];
    $QstrSQL = "SELECT * FROM " . answer_dbt . " WHERE id = '" . $AnsID . "'";
    	$Qrs = mysql_query($QstrSQL);
        while($Qrow = mysql_fetch_array($Qrs)){
            $QuestID = $QArow["question_id"];
        }
    //**Looking for answeres for the same question
    $is_q_already_a = 0;
    $strSQL = "SELECT * FROM " . user_answer_dbt . " WHERE user_exam_id = '" . $_SESSION["uExam_id"] . "' JOIN " . answer_dbt . " ON " . user_answer_dbt . ".answer_id=" . answer_dbt . ".id";
    $rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)){
        if($row["id"] == $QuestID){$is_q_already_a = $is_q_already_a + 1;}
    }


    if($is_q_already_a == 0){
    	$strSQL = "INSERT INTO `" . db . "`.`" . user_answer_dbt . "` (`user_exam_id`,`answer_id`) ";
	    $strSQL = $strSQL .  "VALUES ('"  . $_SESSION["uExam_id"] . "', '"  . $AnsID . "')";
	    $rs = mysql_query($strSQL);
    }
    else{
        echo "You've already answered";
    }

?>
</body>
</html>
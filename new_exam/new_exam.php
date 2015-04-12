<?php
include_once "../connect_server.php";
?>
<html>
    <head>
        <title>Create</title>
        <link rel="stylesheet" type="text/css" href="css/header.css">
    </head>
    
    <body>
        
        
        <?php
        
        session_start();
        if($_SESSION["status"] == 2){
            echo "\r\n" . '<form method="post" action="create.php" autocomplete="off">';
    		echo "\r\n" . '<p><input type="text" name="name" placeholder="Exam name"></p>';
    		echo "\r\n" . '<p><input type="text" name="comment" placeholder="Comment"></p>';
    		echo "\r\n" . '<input type="checkbox" name="is_open">Is it open for everybody';
    		echo "\r\n" . '<input type="hidden" name="author_id" value="'. $_SESSION["user_id"] .'">';
    		echo "\r\n" . '<div><input type="submit" value="Create"></div></form>';
        }
        
        else{
            echo "You are not allowed to be here =\ ";
        }
		?>
    </body>
</html>
<?php
include_once "connect_server.php";
?>
<html>
    <head>
        <title>Welcome!</title>
        <style type="text/css">
		   .bord {
		    border: solid 1px black; 
		    float: right;
		    margin-right: 10%;
		    }
		 </style>
    </head>
    
    <body>
        <?php
        
        session_start();
        echo "session['user_id'] = ";
        echo $_SESSION["user_id"];
        if($_SESSION["user_id"] == 0){
            echo '<form class="bord" method="post" action="login.php">';
    		echo '<p><input type="text" name="username" placeholder="Username"></p>';
    		echo '<input type="password" name="password" placeholder="Password">';
    		echo '<div><input type="submit" value="Login">';
    		echo '<input type="submit" value="Sign Up"></div></form></li>';
        }
        else{
            echo '<a href="logout.php">Log Out</a>';
        }
		?>
    </body>
</html>
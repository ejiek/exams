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
        <form class="bord" method="post" action="php/login.php">
		<p><input type="text" name="username" placeholder="Username"></p>
		<input type="text" name="password" placeholder="Password">
		<div><input type="submit" value="Login">
		<input type="submit" value="Sign Up"></div></form></li>
    </body>
</html>
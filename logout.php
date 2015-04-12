<?php
include_once "connect_server.php";
            session_start();
            session_destroy();
            echo "You've successfully loged out!"
?>
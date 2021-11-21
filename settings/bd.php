<?php
    $db = mysqli_connect("localhost","root","","dikdosham_db");    
    mysqli_query($db, "SET NAMES UTF8");

    if (!$db) {
    	printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error());
   		exit;
    }
?>
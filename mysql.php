<?php
// файл подключения к БД.

    $DB             = array();
    $DB['host']     = "localhost";
    $DB['user']     = "root";
    $DB['pass']     = "";
    $DB['db']       = "new_project";

    $link           = mysqli_connect($DB['host'], $DB['user'], $DB['pass'], $DB['db']);

    if (!$link) {
	    echo "Код ошибки errno :".mysqli_connect_errno().PHP_EOL;
	    echo "Текст ошибки error :".mysqli_connect_error().PHP_EOL;
	    exit;
    }
    
    echo "Соединение с MySQL установленно !".PHP_EOL;
    echo "Соединение с MySQL установленно !".PHP_EOL;

    echo "<br />";
    echo "<br />";

?>
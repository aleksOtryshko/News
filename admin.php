<?php
// файл добавления новостей.

    require_once 'mysql.php';

    $title         = $_POST['title'];
    $content       = $_POST['content'];
    $status        = $_POST['status'];


echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="POST" >

Заголовок:<br /> <input type="text" name="title" >
<br />
Новость:<br /> <textarea name="content"></textarea>
<br />
Опубликовать? <br /> <input type="checkbox" name="status">
<br /> 
<input type="submit" name="add_news" value=" Добавить новость ">
</form>

</body>
</html>
FORMA;
 
    if(isset($title) and isset($content)) {    
    
       $title     = mysqli_real_escape_string($link,trim($title));
        $content   = mysqli_real_escape_string($link,trim($content));

        if($status == 'on') {
            $status = 1;
        } else {
            $status = 2;
        }

        $res = mysqli_query($link, "INSERT INTO `news`(`title` , `content` , `status`) VALUES ('$title' , '$content' , '$status')");

        if($res == true) {
            echo "Новость добавленна в БД !";
        } else {
            echo "Ошибка добавления записи в БД!".mysqli_error($link).PHP_EOL;
            echo "<br />";
            echo " Код ошибки errno : ".mysqli_connect_errno().PHP_EOL;
            echo "<br />";
        }
    } else {
        echo "Хотите добавить новость ?".PHP_EOL;
    }

    echo "<br />";

?>


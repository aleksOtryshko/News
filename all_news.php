<?php
// файл отображения всех новостей на публикацию.
    require_once 'mysql.php';

    $like           = $_POST['like'];
    $dis            = $_POST['dis'];
    $id             = $_POST['id'];
    $search_request = $_POST['search_request'];

//Форма поиска по новостям.

echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form name="search" method="POST" action="search_request.php">
Введите параметры для поиска по новостям: </br>
<input type="search" name="search_request" /></br>
<br />
<br />
<input type="submit"  value="Поиск" /></br>

</form>

</body>
</html>
FORMA;

//Отображение всех добавленных к публикации новостей.

    $result_all_news = mysqli_query($link, "SELECT * FROM `news` WHERE status = 1 ") ;
        while($rows_all_news = mysqli_fetch_assoc($result_all_news)) {

            echo "<div>";

            echo "<a href='article_news.php?id={$rows_all_news['id']}'>".htmlspecialchars($rows_all_news['title'])."</a>" ;
            echo "<br />";
            $text_content = htmlspecialchars($rows_all_news['content']);
            $display128   = substr($text_content, 0, 128);
            echo $display128;
            echo "<br />";
            echo "Понравилось: ".htmlspecialchars($rows_all_news['like']);
            echo "<br />";
            echo "Не понравилось :".htmlspecialchars($rows_all_news['dis']);
            echo "<br />";
            echo "<br />";

            echo "</div>";

            echo "<br />";

            echo "<br />";
            echo "<br />";

    }
       
?> 
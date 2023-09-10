<?php
// файл добавления коментариев и лайков.

    require_once 'mysql.php';

    $id            = $_GET['id'];
    $searc_hashtag = $_GET['$searc_hashtag'];

    $like           = $_POST['like'];
    $dis            = $_POST['dis'];

    $coment         = $_POST['coment'];
    $coment_add     = $_POST['coment_add'];
    $l_i_k_e        = $_POST['l_i_k_e'];
    $d_i_s          = $_POST['d_i_s'];
    $i_d            = $_POST['i_d'];

    mysqli_query($link,"UPDATE `news` SET `views` = `views`+1  WHERE `id`='$id'");

    if($like == 'on') {
        $like = mysqli_query($link,"UPDATE `news` SET `like` = `like`+1  WHERE `id`='$id'");
    } else {
          echo "Вам не понравилось?";
    }

    if($dis == 'on') {           
        $like = mysqli_query($link,"UPDATE `news` SET `dis` = `dis`+1  WHERE `id`='$id'");
    } else  {
          echo "Мы рады что Вам понравилась";
    }

    echo "<br /";

    if($id == true) {
        $result_article = mysqli_query($link, "SELECT * FROM `news` WHERE `id` = '$id' ") ;
        $rows_article = mysqli_fetch_assoc($result_article);

     	        echo "<div>";
     	        echo htmlspecialchars($rows_article['title']);
     	        echo "<br />";
     	        echo "<br />";
     	        echo "</div>";

     	        echo "<div>";
     	        echo htmlspecialchars($rows_article['content']);
     	        echo "<br />";
     	        echo "</div>";
      
                echo "<div>";
                echo "Статью просмотрели: ".htmlspecialchars($rows_article['views'])." раз";
                echo "<br />";
                echo "</div>";

                echo "<br />";
                echo "Понравилось: ".htmlspecialchars($rows_article['like']);
                echo "<br />";
                echo "Не понравилось :".htmlspecialchars($rows_article['dis']);
                echo "<br />";
                echo "<br />";

    } else {

	      echo "Ошибка :".mysqli_error($link).PHP_EOL;
          echo "<br />";
          echo " Код ошибки errno : ".mysqli_connect_errno().PHP_EOL;
          echo "<br />";
    }

echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="POST" >
Нравиться :<br /> <input type="checkbox" name="like">
<br />
Не нравиться : <br /> <input type="checkbox" name="dis">
<br />
<input type="text" name="id" value="$id" >
<br />
<input type="submit" name="add_golos" value=" Голосуй  ">
<br />
</form>

</body>
</html>
FORMA;

echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="POST" >


Коментарий:<br /> <textarea name="coment_add"></textarea>
<br />
<input type="text" name="id" value="{$row['id']}" >
<br />
<input type="submit" name="add_coment" value=" Добавить коментарий ">
</form>

</body>
</html>
FORMA;

// код для работы с  " # "
    $hashtag       = $coment_add;
    preg_match("/#[^\s]+/" , $hashtag , $matches);

// функция делает из массива строку
    $matches = implode(" ", $matches);

// функция добавления коментария
    if(isset($coment_add)) {   
        $coment_add   = mysqli_real_escape_string($link, trim($coment_add));
        $result_coment_add = mysqli_query($link, "INSERT INTO `com`(`coment`, `hashtag` , `id`) VALUES ('$coment_add' , '$matches' , '$id') ");

        if($result_coment_add == true) {
            echo "Комент добавлен  в БД !";
        } else {
              echo "Ошибка добавления записи в БД!".mysqli_error($link).PHP_EOL;
              echo "<br />";
              echo " Код ошибки errno : ".mysqli_connect_errno().PHP_EOL;
              echo "<br />";
        }
   } else {
         echo "Хотите добавить коментарий ?".PHP_EOL;
   }

   echo "<br />";

   $display = mysqli_query($link,"SELECT *  FROM `com` WHERE `id` = '$id' ") ;
      while($rowD = mysqli_fetch_assoc($display)) {

          echo "<div>";

              echo "<br />";
              echo htmlspecialchars($rowD['coment']);
              echo "<br />";
              echo "<br />";

              echo "Понравилось: ".htmlspecialchars($rowD['l_i_k_e']);
              echo "<br />";
              echo "Не понравилось :".htmlspecialchars($rowD['d_i_s']);
              echo "<br />";
              echo "<br />";

echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<form method="POST" >
Нравиться    <br /> <input type="checkbox" name="l_i_k_e">
<br />
Не нравиться <br /> <input type="checkbox" name="d_i_s">
<br />
<input type="text" name="i_d" value="{$rowD['i_d']}" >
<br />
<input type="submit" name="add_golos" value=" Голосуй  ">
<br />
</form>

</body>
</html>
FORMA;




    if($l_i_k_e == 'on') {               
        $l_i_k_e = mysqli_query($link,"UPDATE `com` SET `l_i_k_e`=`l_i_k_e`+1  WHERE `i_d`='$i_d'");
    } else  {
          echo "ПОЛОЖИТЕЛЬНЫЙ ОТЗЫВ НЕ ДОБАВЛЕН!!!!!";
          echo "<br />";
    }

    if($d_i_s == 'on') {               
        $d_i_s = mysqli_query($link,"UPDATE `com` SET `d_i_s` = `d_i_s`+1  WHERE `i_d`='$i_d'");
    } else {
          echo "ОТРИЦАТЕЛЬНЫЙ ОТЗЫВ НЕ ДОБАВЛЕН!!!!!!";
          echo "<br />";
    }

    echo "<br /";

    echo "</div>";

   }

   echo "<br />";

echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>


Поиск по хэштегу<br />
<form name="search_hashtag" method="GET" action="hashtag_news.php">
<input type="search" name="search_hashtag" /></br>
<br />
<br />
<input type="submit"  value="Найти" /></br>

</form>

</body>
</html>
FORMA;

?>
<<?php  
// файл поиска по новостям

    require_once 'mysql.php';

    $search_request = $_POST['search_request'];
    $search_request = trim($search_request);
    $search_request = strip_tags($search_request);

    if(!empty($search_request)) {

      $result_search = mysqli_query($link, "SELECT * FROM `news` WHERE  `content` LIKE '%$search_request%'");
          $rows_search = mysqli_fetch_assoc($result_search);

               echo "<div>";
               echo htmlspecialchars($rows_search['title']);
               echo "<br />";
               echo "<br />";
               echo "</div>";

               echo "<div>";
               echo htmlspecialchars($rows_search['content']);
               echo "<br />";
               echo "</div>";

      
     
    } else {

          echo "Ошибка :".mysqli_error($link).PHP_EOL;
          echo "<br />";
          echo " Код ошибки errno : ".mysqli_connect_errno().PHP_EOL;
          
      }

  

    mysqli_close($link);

?>  
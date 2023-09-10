<?php
// файл поиска по #

    require_once 'mysql.php';

    $search_hashtag = $_GET['search_hashtag'];

    $comparition = mysqli_query($link,"SELECT * FROM `com` WHERE `hashtag` LIKE '%{$search_hashtag}%' ") ;
        while($num_row = mysqli_fetch_assoc($comparition)) {
            echo "<div>";
            echo "<br />";
            echo htmlspecialchars($num_row['coment']);
            echo "<br />";
            echo "<br />";
            echo "<br />";
            echo "</div>";
        }

 ?>
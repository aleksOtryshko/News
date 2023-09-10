<?php
// файл аутентификации.

    require_once 'mysql.php';

    $user      = $_POST['user'];
    $pass      = $_POST['pass'];


echo <<<FORMA
<html>
<heade>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<<form method="POST" >

Имя:<br /> <input type="text" name="user" >
<br />
Пароль:<br /> <input type="text" name="pass" >
<br />

<input type="submit" name="log_in" value=" Войти ">
</form>

</form>

</body>
</html>
FORMA;

    if(isset($user) and isset($pass)) {
        
        $user   = mysqli_real_escape_string($link, trim($user));
        $pass   = mysqli_real_escape_string($link, trim($pass));
        $sql    = mysqli_query($link, "SELECT * FROM `login` WHERE `user` = '{$user}' AND `pass` = '{$pass}' ");
        if(mysqli_num_rows($sql) == 0) {
        	print "Неправильный пароль логин";
        } else {
              header("Location: admin.php");
        } 
         

/*  АЛЬТЕРНАТИВНЫЙ ВАРИАНТ :

        $query = mysqli_query($link, "SELECT `pass` FROM `login` WHERE `user`='".mysqli_real_escape_string($link, $_POST['user'])."' LIMIT 1");
            $data  = mysqli_fetch_assoc($query);
            if($data['pass'] === $_POST['pass']) {
        	    header('Location: admin.php');
        	    exit();
            } else {
        	    echo "Вы ввели неправильный лог - пароль!";
            }

*/

    }

?>    
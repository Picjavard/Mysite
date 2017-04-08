<?

// Страница регситрации нового пользователя


# Соединямся с БД

mysql_connect("localhost", "x96229u3_userdat", "andorra1996");

mysql_select_db("x96229u3_userdat");



if(isset($_POST['reg']))

{
    //print_r ($_POST);
    $flag = 2;
    $err = array();


    # проверям логин

    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))

    {

        $err[] = "Логин может состоять только из букв английского алфавита и цифр";

    }



    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)

    {

        $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";

    }



    # проверяем, не сущестует ли пользователя с таким именем
    # mysql_query() - создание запроса
    # mysql_real_escape_string() - экранирует символы для использования в SQL-запросе

    $query = mysql_query("SELECT COUNT(user_id) FROM users WHERE user_login='".mysql_real_escape_string($_POST['login'])."'");

    # Если возврашает 0 - то все норм(запрос прошел)
    if(mysql_result($query, 0) > 0)

    {

        $err[] = "Пользователь с таким логином уже существует в базе данных";

    }

    if($_POST['password']!==$_POST['password_check'])

    {

        $err[] = "Подверждение пароля НЕ соответствует паролю";

    }



    # Если нет ошибок, то добавляем в БД нового пользователя

    if(count($err) == 0)

    {


        $login = $_POST['login'];



        # Убераем лишние пробелы и делаем двойное шифрование

        $password = md5(md5(trim($_POST['password'])));



        mysql_query("INSERT INTO users SET user_login='".$login."', user_password='".$password."';");



        header("Location: index.php"); exit();

    }

    else

    {

        print "<b>При регистрации произошли следующие ошибки:</b><br>";

        foreach($err AS $error)

        {

            print $error."<br>";

        }

    }

}

?>




<form action="register.php" method="POST">

  Логин <input name="login" type="text" ><br>

  Пароль <input name="password" type="password"><br>
  Подтверждение пароля <input name="password_check" type="password"><br>
  <div class="form-actions">
    <button name="reg" type="submit" class="btn btn-primary">Зарегистрироваться</button>
  </div>


</form>

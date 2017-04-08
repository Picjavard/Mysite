<?php
  if (isset($_POST['exit'])){
    session_destroy();
    exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
  }

# автологин через сессию
  if (isset($_SESSION['user_name']))
  {
    # если нет пути аватарки в сессии - подгружаем из БД
    if(!$_SESSION['avatar_path'])
    {
      $Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");
      $query = "SELECT * from image where image_id = (SELECT image_id from personal where user_id = '".$_SESSION['user_id']."');";
      $row = mysqli_fetch_assoc(mysqli_query($Link,$query));
      $_SESSION['avatar_path'] = $row['image_path'];
      //echo "LINK";
    }

    echo "<div align = 'enter' class='avatar'> <img height = 200px width = 200px src='",$_SESSION['avatar_path'],"'></img>";

    echo "Привет, ".$_SESSION['user_name']."!";
    echo "<form class='exit'	action='index.php' method='post'>
      <button name='exit' type='submit' class='btn'>Выйти</button>
    </form></div>";
  } else
  {
    SignIn();
  }


# Логин
  if (isset($_POST['loginbut']))
  {
    $_SESSION['flag'] = 0;
    Loginbut();
  }
  function Loginbut()
  {
    $Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");
    if(!$Link)
    {
      printf("Не удалось ", mysqli_connect_error()); exit();
    }
    $query = "SELECT * from users where `user_login` = '".$_POST['login']."' and `user_password` = '".md5(md5($_POST['password']))."';";
    $result = mysqli_query($Link,$query);
    if(($result)&&(mysqli_num_rows($result) == 1))
    {
      $row = mysqli_fetch_assoc($result);
      $_SESSION['user_name'] = $row['user_login'];
      $_SESSION['user_id'] = $row['user_id'];
      mysqli_free_result($result);
      exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
    }else
    {
      echo "Неправильные учетные данные";
      //print_r($_SESSION);
      //print_r($_POST);
    }
    mysql_close($Link);
  }


# Регистрация нового пользователя
  if(isset($_POST['reg']))

  {
      //print_r ($_POST);
      $_SESSION['flag'] = 1;
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
      $Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");

      if(!$Link)
      {
        printf("Не удалось ", mysqli_connect_error()); exit();
      }
      $query = "SELECT * from users WHERE `user_login` ='".$_POST['login']."';";
      $result = mysqli_query($Link,$query);
      # Если возврашает 0 - то все норм(запрос прошел)
      if(($result)&&(mysqli_num_rows($result) > 0))
      {

          $err[] = "Пользователь с таким логином уже существует в базе данных";

      }else
      {

      }

      if($_POST['password']!==''){
        if(strlen($_POST['password'])>7){
          if($_POST['password']!==$_POST['password_check'])
              $err[] = "Подверждение пароля НЕ соответствует паролю";
        }else $err[] = "Пароль должен состоять из 8 и более символов";
      }else $err[] = "Пароль не может быть пустым";
      if($_SERVER['REMOTE_ADDR']=='')
        $err[] = "ошибка";



      # Если нет ошибок, то добавляем в БД нового пользователя

      if(count($err) == 0)

      {


          $login = $_POST['login'];



          # Убераем лишние пробелы и делаем двойное шифрование

          $password = md5(md5(trim($_POST['password'])));



          $query = "INSERT INTO users SET user_login='".$login."', user_password='".$password."', user_ip= INET_ATON('".$_SERVER['REMOTE_ADDR']."');";
          $query2 = "SELECT * from users WHERE user_login='".$login."';";

          $result = mysqli_query($Link,$query);
          $result2 = mysqli_fetch_assoc(mysqli_query($Link,$query2));
          $user_id = $result2['user_id'];
          $query3 = "INSERT INTO personal SET user_id='".$user_id."', user_group = '42', date_reg = CURRENT_TIMESTAMP image_id = '1';";
          $result3 = mysqli_query($Link,$query3);

          Loginbut();

          //exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");

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

//print_r($_SESSION);
//print_r($_POST);

# Вывод панели входа:

function SignIn()
{
  echo '
  <ul id="myTab" class="nav nav-tabs">
    <li ';
  if($_SESSION['flag'] == 0) echo 'class="active"';
  echo  '>
    <a href="#login" data-toggle="tab">Вход</a>
    </li>
    <li ';
  if($_SESSION['flag'] == 1) echo 'class="active"';
  echo  '>
    <a href="#reg" data-toggle="tab">Регистрация</a>
  </ul>
    <div id="myTabContent" class="tab-content">
      <div id="login" class="tab-pane fade ';
  if($_SESSION['flag'] == 0) echo 'active in';
  echo '">
        <form action="" method="post">
          <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Логин">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
          </div>
          <button name="loginbut" type="submit"  class="btn btn-primary" value="loginbut">Войти</button>
        </form>
      </div>

      <div id="reg" class="tab-pane fade ';
      if($_SESSION['flag'] == 1) echo 'active in';
      echo '">
        <form class="sign"	action="" method="post">
          <div class="form-group">
            <label for="login">Логин</label>
            <input type="text" class="form-control" id="login" name="login" placeholder="Логин">
          </div>
          <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Пароль">
          </div>
          <div class="form-group">
            <label for="password_check">Подтверждение пароля</label>
            <input type="password" class="form-control" id="password_check" name="password_check" placeholder="Подтверждение пароля">
          </div>
        <button name="reg" type="submit" class="btn btn-primary" value="reg">Зарегистрироваться</button>
        </form>
      </div>
    </div>';
}

?>

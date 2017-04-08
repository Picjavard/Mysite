<?php
  # exit from login
  if(isset($_POST['Exit'])){
            setcookie("id", "", time() - 3600*24*30*12, "/");
            setcookie("hash", "", time() - 3600*24*30*12, "/");
            exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");


  }


  # Соединямся с БД
  $Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");

  if(!$Link) {
    printf("Не удалось ", mysqli_connect_error()); exit();
  }
  /*  else{
    echo "good";
  }*/

  //print_r($_SERVER);
  //echo "string";

  if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))

  {
    # intval()
    $query = mysqli_query($Link,"SELECT *,INET_NTOA(user_ip) as user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");

    $userdata = mysqli_fetch_assoc($query);
    //echo $userdata['user_ip'];

    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))

    {

        setcookie("id", "", time() - 3600*24*30*12, "/");

        setcookie("hash", "", time() - 3600*24*30*12, "/");

        print "Хм, что-то не получилось";

    }

    else

    {

        print "Привет, ".$userdata['user_login'].". Всё работает!<br>";

    }
  }
  else

  {


  		//require("login.php");
  		//print "Включите куки";

  }



  	if(isset($_POST['reg']))

  	{
  		//header("Location: register.php"); exit();
  	}

?>

<HTML>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="http://x96229u3.beget.tech/css/mystyle.css">
  </head>

  <body>
    <?

        echo "<div class = 'message'>";
        //checking cookies
        if ((isset($_COOKIE['id']) and isset($_COOKIE['hash']))){
        echo "<form action = \"chat.php\" method = 'POST'>
                <input type=\"text\" name=\"nickname\"
                 value=\"".$userdata['user_login']."\" disabled placeholder=\"nickname\">
                 <button name = \"Exit\" value=\"Exit\">Exit</button><br>
                <textArea rows = \"5\" cols = \"50\" name=\"message\" placeholder=\"message\"></textarea><br>
                <input type=\"Submit\"  name=\"Submit\" value=\"Submit\">
                <input type=\"Reset\" value=\"Reset\">
              </form>";
        } else echo "Войдите, чтобы оставить комментарий ";
        echo "</div>";


    //echo table
    echo "<div class='tab'>";
    $result= mysqli_query($Link, "SELECT * FROM `chat` JOIN `users` ON `chat`.user_id = `users`.user_id /*WHERE user_id = (Select user_id From users Where user_login='vseven')*/ ORDER by `ID` DESC LIMIT 20;");

    if(!$result){
      printf("error! ");
    }
    else
    {
      while ($row = mysqli_fetch_assoc($result))
      {
        echo $row['date']," ";
        echo $row['time']," ";
        echo $row['user_id'],":<br> ";
        echo $row['message'],"<br>";
      }

      mysqli_free_result($result);
    }
    echo "</div>";


    //Addding comment
    if(isset($_POST['Submit'])&&isset($_POST['message'])){
      $dated = date("Y-m-d");
      $timed = date("H:i:s");
      $ulogin = $userdata['user_id'];
      $text = $_POST['message'];
      $result= mysqli_query($Link, "INSERT INTO `chat`(`user_id`, `date`, `time`, `message`) VALUES ('$ulogin','$dated','$timed','$text');");


      //checking query
      if($result=== true){
        echo "Ваш комментариий добавлен ".date("Y-m-d")." ".date("H:i:s");
        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
      }
      else printf("Не прошло");
    }
    mysqli_close($Link);
    ?>
  </body>
</HTML>

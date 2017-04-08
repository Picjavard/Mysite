<?php include('tempTop.php');
?>
		<div class="col-md-3 ">
			<br>
			<?php
				include('login.php');
			?>
		</div>
		<div class="col-md-9">
			<div class="content">
		    <?

				//--------------------------------------------------------------

		      echo "<div class = 'message'>";
		      //print_r($_SESSION);
		      if(!isset($_SESSION['user_name']))
		      {
		        echo "Войдите, чтобы оставить комментарий ";
		      } else {

		        echo "<form action = '' method = 'POST' enctype = 'multipart/form-data'>

		                <textarea class='form-control' rows = '5' cols = '50' name='message' placeholder='message'></textarea><br>
										<input name = 'user_file' type = 'file'/>
		                <input type='Submit' class='btn btn-primary' name='Submit' value='Submit'>
		                <input type='Reset'  class='btn' value='Reset'>
										 </form>";
										 //print_r($_FILES);
		      }
		      if ($_SESSION['added'])
		      {
		        echo $_SESSION['added'];
						unset($_SESSION['added']);
						//print_r($_SESSION);
		      }
		      echo "</div></div><hr>";


//--------------------------------------------------------------

		    //echo table
		    //echo "<div class='tab'>";
		    $Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");
		    if(!$Link)
		    {
		      printf("Не удалось ", mysqli_connect_error()); exit();
		    }
		    $result= mysqli_query($Link, "SELECT user_login,message,date,time,image_path FROM `chat`,`users`,`personal`,`image` WHERE `chat`.user_id = `users`.user_id AND `users`.user_id = `personal`.user_id AND `personal`.image_id = `image`.image_id /*WHERE user_id = (Select user_id From users Where user_login='vseven')*/ ORDER by `ID` DESC LIMIT 20;");
		    if(!$result){
		      printf("error! ");
		    }
		    else
		    {
		      while ($row = mysqli_fetch_assoc($result))
		      {
						//echo "<p>";
						echo '<div class="panel panel-default">
							<div class="row">
							<div align = "center" class="col-md-2">

							<img class="media-object" alt="Ошибка" style="width: 100px; height: 100px;" src="',$row['image_path'],'">

							';
						echo	$row['user_login'],
							'</div><div class="col-md-7">';

						echo "<p>";
		        echo $row['message'],"";
						echo '</p></div><div align = "center" class="col-md-3">';
						echo '<span class="label label-default">',$row['date']," ",$row['time'],'</span>',"</div></div></div>";
		      }

		      mysqli_free_result($result);
		    }
		    echo "</div>";

				//--------------------------------------------------------------

		    //Addding comment
		    if(isset($_POST['Submit'])&&isset($_POST['message'])){
		      $dated = date("Y-m-d");
		      $timed = date("H:i:s");
		      $ulogin = $_SESSION['user_id'];
		      $text = htmlspecialchars($_POST['message'],ENT_QUOTES);
		      $result= mysqli_query($Link, "INSERT INTO `chat`(`user_id`, `date`, `time`, `message`) VALUES ('$ulogin','$dated','$timed','$text');");
					if($_FILES['user_file']['tmp_name'] ==='')
					{
							if (($_FILES['user_file']['error'] !== UPLOAD_ERR_OK) or ($_FILES['user_file']['tmp_name'] ==='')and($_FILES['user_file']['size'] ===0))
							{
								//echo "Произошла ошибка при загрузке<br>";
								//exit();
							}
							$FileName=MD5("");
					}
				}

				//--------------------------------------------------------------

		      //checking query
		      if($result=== true){
		        $added = "Ваш комментариий добавлен ".date("Y-m-d")." ".date("H:i:s");
		        $_SESSION['added'] = $added;
		        exit("<meta http-equiv='refresh' content='0; url= $_SERVER[PHP_SELF]'>");
		      }
		      //else printf("Не прошло");
		    mysqli_close($Link);
		    ?>

		</div>

				<?php include('tempBott.php');
				?>

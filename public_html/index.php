<?php include('tempTop.php');?>

				<div class="col-md-9">

					<?php
					$Link = mysqli_connect("localhost", "x96229u3_userdat", "andorra1996", "x96229u3_userdat");
					if(!$Link)
					{
						printf("Не удалось ", mysqli_connect_error()); exit();
					}
					$result= mysqli_query($Link, "SELECT * FROM `news` ORDER by `news_id` DESC LIMIT 20;");

					if(!$result){
						printf("error! ");
					}
					else
					{
						while ($row = mysqli_fetch_assoc($result))
						{
							//echo "<p>";
							echo '<div class="panel panel-default">
										<div class="panel-heading">
												<H1 class="panel-title">';
							echo $row['news_theme'];
							echo '  <span class="label label-default">',$row['news_date'],'</span></H1></div><div class="panel-body">';
							echo $row['news_text'];
							echo '</div></div>';
						}

						mysqli_free_result($result);
					}
					//echo "</div>";
					?>

	</div>


<?php include('tempBott.php');?>

<?
	session_start();
	//print_r($_SERVER);
	//print_r($_SESSION);
	//print_r($_POST);
	//$ip = ip2long($_SERVER['REMOTE_ADDR']);
	//echo "<br>";
	//echo $ip;
  $path = basename($_SERVER['PHP_SELF'], ".php");
?>
<!DOCTYPE html>
<html lang="en">
	<HEAD>
		<meta charset="UTF-8">
		<TITLE>Picjavard - pesonal website</TITLE>
		<link rel="shortcut icon" href="../pic/PGD-alfa16x16.png" type="image/png">
		<link rel="stylesheet" href="../boot/bootstrap-3.3.7-dist/css/bootstrap.css">
		<link rel="stylesheet" href="../css/mystyle.css">

<!--			<link rel="stylesheet" href="http://x96229u3.beget.tech/css/mystyle.css">-->
		<script src="http://code.jquery.com/jquery-latest.js"></script>
		<script src="bootstrap.js"></script>


		<!-- Yandex.Metrika counter -->
		<script type="text/javascript">
		    (function (d, w, c) {
		        (w[c] = w[c] || []).push(function() {
		            try {
		                w.yaCounter43717674 = new Ya.Metrika({
		                    id:43717674,
		                    clickmap:true,
		                    trackLinks:true,
		                    accurateTrackBounce:true
		                });
		            } catch(e) { }
		        });

		        var n = d.getElementsByTagName("script")[0],
		            s = d.createElement("script"),
		            f = function () { n.parentNode.insertBefore(s, n); };
		        s.type = "text/javascript";
		        s.async = true;
		        s.src = "https://mc.yandex.ru/metrika/watch.js";

		        if (w.opera == "[object Opera]") {
		            d.addEventListener("DOMContentLoaded", f, false);
		        } else { f(); }
		    })(document, window, "yandex_metrika_callbacks");
		</script>
		<noscript><div><img src="https://mc.yandex.ru/watch/43717674" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
		<!-- /Yandex.Metrika counter -->


	</HEAD>
	<BODY >
		<?php
		if($path=="index")
		Slide();
		?>
<!--		<img src= http://x96229u3.beget.tech/pic/nick.png usemap="#myMap" margin-left="0">
			<map name="myMap" >
				<area shape="rect" coords="111,37,569,123" href="">
				<area shape="rect" coords="8,35,113,122" href="https://www.youtube.com/channel/UCbBSvZ-byJ64fPTKmpR7YuQ"/>
			</map>
-->


<nav class="navbar navbar-default navbar-static-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button class="collapsed navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href=""><img src="../pic/Picjavard.png" class="img-rounded" alt="Brand"></a>
			</div>
			<div id="bs-example-navbar-collapse-8" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li <?if($path=="index") echo 'class="active"';?>>
					<a href="index.php"><span class="glyphicon glyphicon-home"></span>   ГЛАВНАЯ </a>
				</li>
				<li <?if($path=="bio") echo 'class="active"';?>>
					<a href="bio.php"><span class="glyphicon glyphicon-book"></span>  БИОГРАФИЯ  </a>
				</li>
				<li <?if($path=="creative") echo 'class="active"';?>>
					<a href="creative.php"><span class="glyphicon glyphicon-pencil"></span> ТВОРЧЕСТВО </a>
				</li>
				<li <?if($path=="faq") echo 'class="active"';?>>
					<a href="faq.php"><span class="glyphicon glyphicon-comment"></span>  FAQ </a>
				</li>
				<li <?if($path=="forum") echo 'class="active"';?>>
					<a href="forum.php"><span class="glyphicon glyphicon-th-list"></span> ФОРУМ </a>
				</li>

			</ul>
		</div>
	</div>
</nav>
<div class="container">
<?php
function Slide()
{
	echo '<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" >
		<!-- Indicators -->
		<ol class="carousel-indicators">
			<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
			<li data-target="#carousel-example-generic" data-slide-to="1"></li>

		</ol>

		<!-- Wrapper for slides -->
		<div class="carousel-inner" role="listbox">
			<div class="item active">
				<img src="../pic/piano-362252_960_720.jpg" alt="">
				<div class="carousel-caption">
					<H1>Piano1</H1>
					<p>123 <br>
						fdsg<br>
						gedgergreh5he<br>
						вырцрк<br>
					</p>
				</div>
			</div>
			<div class="item">
				<img src="../pic/piano-362252_960_720.jpg" alt="...">
				<div class="carousel-caption">
					Piano2
				</div>
			</div>

		</div>

		<!-- Controls -->
		<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
			<span class="sr-only">Previous</span>
		</a>
		<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
			<span class="sr-only">Next</span>
		</a>
	</div>
';
}
?>

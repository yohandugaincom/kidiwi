<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start(); if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	background: linear-gradient(-45deg, #e74c3c, #2ecc71, #c0392b, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
	overflow-x: hidden;
}
.navbar {
	color: #fff;
	background: linear-gradient(-45deg, #e74c3c, #2ecc71, #c0392b, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
}


@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}
</style>
<div align="center" style="font-size:35px;margin-top:15%;">
<p class="raleway"><span class="animated fadeIn" style="margin-top:10px;font-family:'Hand';color:white;font-size:50px;text-shadow: 1px 1px 3px black;">
<img src="/public/img/origami.png" width="100px" style="vertical-align: -15px;" />
   Kid'iwi</span></br>
<span class="animated fadeIn delay-1s">Oups, un incident est survenue.</br>Mais ne vous inquietez pas, notre équipe s'en charge immédiatement.</span></p>
  <span class="animated fadeIn delay-2s">
	<a href="/public/compte/se-connecter/se-connecter.php"><button class="btn btn-light btn-lg animated pulse infinite" id="continue">Se connecter</button></a>
	</span>
</div>

<script>
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; session_destroy(); ?>

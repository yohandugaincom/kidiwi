<?php
session_start();
session_destroy();
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start(); if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$date = date("Y-m-d H:i:s");
$requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_GET['email']."', '".$date."', 'Votre compte a bien été activé !', 'Au nom de toute l''équipe, nous vous souhaitons la bienvenue sur Kid''iwi.', '')";
$pdo->prepare($requete)->execute();

$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_GET['email']."'");
while ($donnees = $req->fetch())
{
  $num = $donnees['notifications_num'];
}
$num = $num+1;
$requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_GET['email']."'";
$pdo->prepare($requete)->execute();

include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
	overflow-x: hidden;
}
.navbar {
	color: #fff;
	background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);
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
<span class="animated fadeIn delay-1s">est heureux d'accueillir votre talent d'artiste !</span></p>
  <span class="animated fadeIn delay-2s">
	<a href="/public/compte/se-connecter/se-connecter.php"><button class="btn btn-light btn-lg animated pulse infinite" id="continue">Commencer</button></a>
	</span>
</div>

<script>
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; session_destroy(); ?>

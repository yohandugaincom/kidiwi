<?php
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$requete = "DROP TABLE IF EXISTS ".BDD."enfants";
$pdo->prepare($requete)->execute();
$requete = "DROP TABLE IF EXISTS ".BDD."general";
$pdo->prepare($requete)->execute();
$requete = "DROP TABLE IF EXISTS ".BDD."utilisateurs";
$pdo->prepare($requete)->execute();
$requete = "DROP TABLE IF EXISTS ".BDD."evenements";
$pdo->prepare($requete)->execute();
$requete = "DROP TABLE IF EXISTS ".BDD."notifications";
$pdo->prepare($requete)->execute();
$requete = "DROP TABLE IF EXISTS ".BDD."messages";
$pdo->prepare($requete)->execute();
unlink($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi");
array_map('unlink', glob($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/*"));
array_map('unlink', glob($_SERVER['DOCUMENT_ROOT']."/public/activite/img/*"));

?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/public/img/origami.png" />
    <title>Kid'iwi</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/default.css">
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	background: linear-gradient(-45deg, black, #e74c3c, black, black);
	background-size: 400% 400%;
	-webkit-animation: Gradient 8s ease;
	-moz-animation: Gradient 8s ease;
	animation: Gradient 8s ease;
	overflow-x: hidden;
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
  </head>
  <body>
<div align="center" style="font-size:35px;margin-top:15%;">
<p class="raleway"><span class="animated fadeIn" style="margin-top:10px;font-family:'Hand';color:white;font-size:50px;text-shadow: 1px 1px 3px black;">
<img src="/public/img/origami.png" width="100px" style="vertical-align: -15px;" /> Kid'iwi</span></br>
   <span id="status" class="animated fadeIn slower">Préparation à la réinitialisation...</span></p>
   <div id="chargement" class="spinner-border text-light" style="display:block;" role="status">
     <span class="sr-only">Chargement...</span>
   </div>
   <div id="fin" align="center" class="animated fadeIn" style="margin-top:1%;display:none;">
     <a href="/dev"><button class="btn btn-light btn-lg animated pulse infinite">Terminer</button></a>
   </div>
</div>
</div>
<script>
  var nstatus = document.getElementById('status');
  function status(x) {
    nstatus.innerHTML = x;
  }
  function fin() {
    document.getElementById('chargement').style.display = "none";
    document.getElementById('fin').style.display = "block";
  }
  setTimeout(status, 500, "Réinitialisation de la base de données...");
  setTimeout(status, 1000, "Suppression des données utilisateurs...");
  setTimeout(status, 1200, "Vérification des données...");
  setTimeout(status, 1500, "Réinitialisation terminée.");
  setTimeout(fin, 2000);
</script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <body>
  </html>

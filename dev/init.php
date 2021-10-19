<?php
$fp = fopen($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi", "w+");
fclose ($fp);

include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");

$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$requete = "CREATE DATABASE IF NOT EXISTS ".FBDD." DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."utilisateurs ( id INT NOT NULL AUTO_INCREMENT ,
   prenom TEXT NOT NULL ,
    nom TEXT NOT NULL ,
     prenom_secondaire TEXT NOT NULL ,
      nom_secondaire TEXT NOT NULL ,
       adresse TEXT NOT NULL ,
        adresse_complement TEXT NOT NULL ,
         ville TEXT NOT NULL ,
          code_postal TEXT NOT NULL ,
           mot_de_passe TEXT NOT NULL ,
            email TEXT NOT NULL ,
             email_secondaire TEXT NOT NULL ,
             role TEXT NOT NULL ,
              active TEXT NOT NULL ,
               PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."enfants ( id INT NOT NULL AUTO_INCREMENT ,
  email TEXT NOT NULL ,
  prenom TEXT NOT NULL ,
  nom TEXT NOT NULL ,
  date_naissance TEXT NOT NULL ,
  sexe TEXT NOT NULL ,
  PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."general ( id INT NOT NULL AUTO_INCREMENT ,
  email TEXT NOT NULL ,
  note TEXT NOT NULL ,
  messages_num TEXT NOT NULL ,
  notifications_num TEXT NOT NULL ,
  avatar TEXT NOT NULL ,
  theme TEXT NOT NULL ,
  PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."notifications ( id INT NOT NULL AUTO_INCREMENT ,
  email TEXT NOT NULL ,
  date DATETIME NOT NULL ,
  titre TEXT NOT NULL ,
  message TEXT NOT NULL ,
  href TEXT NOT NULL ,
  PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."messages ( id INT NOT NULL AUTO_INCREMENT ,
  email_expediteur TEXT NOT NULL ,
  email_destinataire TEXT NOT NULL ,
  date DATETIME NOT NULL ,
  titre TEXT NOT NULL ,
  message TEXT NOT NULL ,
  lu TEXT NOT NULL ,
  visible_des TEXT NOT NULL ,
  visible_exp TEXT NOT NULL ,
  PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

$requete = "CREATE TABLE IF NOT EXISTS ".BDD."evenements ( id INT NOT NULL AUTO_INCREMENT ,
  email TEXT NOT NULL ,
  date DATETIME NOT NULL ,
  titre TEXT NOT NULL ,
  description TEXT NOT NULL ,
  places_min TEXT NOT NULL ,
  places_max TEXT NOT NULL ,
  age_min TEXT NOT NULL ,
  age_max TEXT NOT NULL ,
  prix TEXT NOT NULL ,
  adresse TEXT NOT NULL ,
  theme TEXT NOT NULL ,
  longitude TEXT NOT NULL ,
  latitude TEXT NOT NULL ,
  liste_inscrits TEXT NOT NULL ,
  active TEXT NOT NULL ,
  image1 TEXT NOT NULL ,
  image2 TEXT NOT NULL ,
  image3 TEXT NOT NULL ,
  PRIMARY KEY (id))";
$pdo->prepare($requete)->execute();

?>
<!DOCTYPE html>
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
	background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 10s ease infinite;
	-moz-animation: Gradient 10s ease infinite;
	animation: Gradient 10s ease infinite;
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
   <span id="status" class="animated fadeIn slower">Préparation à l'installation...</span></p>
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
  setTimeout(status, 500, "Configuration de la base de données...");
  setTimeout(status, 700, "Vérification des données...");
  setTimeout(status, 1000, "Installation terminée.");
  setTimeout(fin, 1500);
</script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <body>
  </html>

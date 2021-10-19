<?php
$fp = fopen($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi", "w+");
fclose ($fp);

include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");

$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
  $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp) VALUES (NULL, 'email@kidiwi.fr', 'demo@kidiwi.fr', '2019-05-27 08:25:24', 'Votre prestation', 'Bonjour, j\'aurais aimé en savoir plus. Bonne matinée.', 'non', 'oui', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp) VALUES (NULL, 'email2@kidiwi.fr', 'demo@kidiwi.fr', '2019-05-17 12:35:24', 'À propos de votre prestation', 'Bonjour, j\'aurais aimé en savoir plus à propos de votre prestations. Bonne journée.', 'non', 'oui', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp) VALUES (NULL, 'demo@kidiwi.fr', 'email@kidiwi.fr', '2019-05-25 19:25:24', 'Coucou encore toi', 'Bonne soirée cette fois.', 'non', 'oui', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp) VALUES (NULL, 'demo@kidiwi.fr', 'email@kidiwi.fr', '2019-05-20 10:25:24', 'Coucou', 'Bonne journée.', 'oui', 'oui', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp) VALUES (NULL, 'demo@kidiwi.fr', 'email@kidiwi.fr', '2019-04-10 17:25:24', 'Hello', 'Tu vas bien ?', 'oui', 'oui', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."utilisateurs (id, prenom, nom, prenom_secondaire, nom_secondaire, adresse, adresse_complement, ville, code_postal, mot_de_passe, email, email_secondaire, role, active) VALUES (NULL, 'Cécile', 'Moreau', '', '', '', '', '', '', 'dazefgrhtjy', 'email@kidiwi.fr', '', 'Artiste', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."utilisateurs (id, prenom, nom, prenom_secondaire, nom_secondaire, adresse, adresse_complement, ville, code_postal, mot_de_passe, email, email_secondaire, role, active) VALUES (NULL, 'Pierre', 'Dupont', '', '', '', '', '', '', 'dazefgrhtjy', 'email2@kidiwi.fr', '', 'Artiste', 'oui')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."general (id, email, note, messages_num, notifications_num, avatar, theme) VALUES (NULL, 'email@kidiwi.fr', '3', '', '', '', 'sombre')";
  $pdo->prepare($req)->execute();
  $req = "INSERT INTO ".BDD."evenements (id, email, date, titre, description, places_min, places_max, age_min, age_max, prix, adresse, theme, longitude, latitude, liste_inscrits, active, image1, image2, image3) VALUES (NULL, 'email@kidiwi.fr', '2019-06-09 09:30:00', 'Atelier couture', 'Vous souhaitez inscrire vos Enfants aux cours de Couture à l\'année ? Nous accueillons vos enfants à partir de 7 ans !', '', '12', '7', '12', '13', '1 Avenue du parc, Cergy, 95000', 'creatif', '2.069574', '49.035171', '3,4,5,6,', 'oui', 'demo1.png', 'demo2.png', 'demo3.png')";
  copy($_SERVER['DOCUMENT_ROOT']."/dev/demo1.jpg", $_SERVER['DOCUMENT_ROOT']."/public/activite/img/demo1.png");
  copy($_SERVER['DOCUMENT_ROOT']."/dev/demo2.jpg", $_SERVER['DOCUMENT_ROOT']."/public/activite/img/demo2.png");
  copy($_SERVER['DOCUMENT_ROOT']."/dev/demo3.jpg", $_SERVER['DOCUMENT_ROOT']."/public/activite/img/demo3.png");
  copy($_SERVER['DOCUMENT_ROOT']."/dev/emailATkidiwiDOTfr.png", $_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/emailATkidiwiDOTfr.png");
  $pdo->prepare($req)->execute();
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
   <span id="status" class="animated fadeIn slower">Préparation à la démonstration...</span></p>
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
  setTimeout(status, 1000, "Configuration de la base de données...");
  setTimeout(status, 2000, "Copie de données en cours...");
  setTimeout(status, 5000, "Vérification des données...");
  setTimeout(status, 6000, "La version de démonstration est activée.");
  setTimeout(fin, 7000);
</script>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <body>
  </html>

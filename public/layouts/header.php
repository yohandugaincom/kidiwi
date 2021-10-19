<?php
if (!file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {
  header('Location: /public/maintenance.php');
}
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$i = false;
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs");
while ($donnees = $req->fetch()) {
  $i = true;
}
$theme_text = "";
session_start();
$req = $pdo->query("SELECT * FROM ".BDD."general WHERE email='".$_SESSION['email']."'");
while ($donnees = $req->fetch()) {
  $theme = $donnees['theme'];
}
if ($theme=="sombre") {
  $theme_text = "_sombre";
}
$req->closeCursor();
$email = str_replace("@", "AT", $_SESSION['email']);
$email = str_replace(".", "DOT", $email);
$email = str_replace("-", "T", $email);
if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email.".png")) {
    $avatar = "/public/compte/avatar/".$email.".png";
} else {
    $avatar = "/public/img/profil.png";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/public/img/origami.png" />
    <title>Kid'iwi</title>
    <meta http-equiv="pragma" content="nocache">
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/default<?php echo $theme_text; ?>.css">
  </head>

  <body>
    <div id="menu" style="z-index:1000;position:fixed;width:100%;top:0;">
      <nav class="navbar navbar-expand-lg navbar-dark navcolor">
        <a class="navbar-brand" href="/public" style="font-family:'Hand';color:white;font-size:30px;text-shadow: 1px 1px 3px black;"><img src="/public/img/origami.png" width="50px" style="display:inline-block;filter:invert(0);vertical-align: -10px;"/> Kid'iwi
        <?php if (($_SESSION['role']=="Artiste") || ($_SESSION['role']=="Gérant")) {
          echo '<span style="text-shadow: 0px 0px 0px black;" class="raleway badge badge-warning">Pro</span>';
        } ?></a>
        <div id="chargement" class="spinner-border text-light" style="display:none;" role="status">
          <span class="sr-only">Chargement...</span>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="padding-right:2rem;">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="/public/accueil">Accueil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/public/decouvrir">Découvrir</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/public/rechercher/recherche.php">Rechercher</a>
            </li>
            <?php if(isset($_SESSION['connecte'])) {
              include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/connecte.php';
              $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_SESSION['email']."'");
              while ($donnees = $req->fetch()) {
              	$active = $donnees['active'];
                $mot_de_passe = $donnees['mot_de_passe'];
              }
              $req->closeCursor();
              if (($active <> "oui") || (!password_verify($_SESSION['password'], $mot_de_passe))) {
                session_destroy();
                echo '<script>location.href="/public/compte/se-connecter/se-connecter.php?status=deconnecte";</script>';
              }
            } else {
              include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/non_connecte.php';
            }
            ?>
        </div>
      </nav>
    </div>
    <div id="content" style="margin-top:6rem;margin-bottom:7rem;">

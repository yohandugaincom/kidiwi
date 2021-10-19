<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/events.png" width="50px" /> <b class="align-middle">Mes évènements</b></p>
    <?php
    setlocale(LC_TIME, "fr_FR");
    $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE email='".$_SESSION['email']."'");
    while ($donnees = $req->fetch())
    {
      $email_presentation = $donnees['email'];
      $id = $donnees['id'];
      $titre = $donnees['titre'];
      $theme = $donnees['theme'];
      $prix = $donnees['prix'];
      $places_max = $donnees['places_max'];
      $age_min = $donnees['age_min'];
      $age_max = $donnees['age_max'];
      $date = $donnees['date'];
      $description = $donnees['description'];
      $adresse = $donnees['adresse'];
      $longitude = $donnees['longitude'];
      $latitude = $donnees['latitude'];
      $active = $donnees['active'];
      $image1 = $donnees['image1'];
      $image2 = $donnees['image2'];
      $image3 = $donnees['image3'];
      $liste_inscrits = $donnees['liste_inscrits'];
      $inscrits = explode(",", $liste_inscrits);
      if ($active=="oui") {
        $titre = $titre." (ANNONCE ACTIVÉE)";
      } else {
        $titre = $titre." (ANNONCE DÉSACTIVÉE)";
      }
      echo '<div class="card bg-dark text-white reservation" style="background:url(/public/activite/img/'.$image1.');background-position:center;">
          <a href="/public/activite/presentation.php?id='.$id.'" class="text-white">
            <div class="card-img-overlay">
            <h5 class="card-title" style="filter: drop-shadow(4px 4px 4px black);">'.$titre.'</h5>
            <p class="card-text" style="filter: drop-shadow(4px 4px 4px black);">Il y a actuellement '.count($inscrits).' réservations.</p>
            <p class="card-text" style="filter: drop-shadow(4px 4px 4px black);">Prévu '.strftime("%A %d %B %Y à %H:%M", strtotime($date)).'</p>
          </div>
        </a>
      </div>';
    }
    if (!isset($image1)) {
      echo "<p>Vous n'avez aucun évènement en cours.</p>";
    }
    ?>


<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

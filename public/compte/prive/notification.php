<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$requete = "UPDATE ".BDD."general SET notifications_num='0' WHERE email='".$_SESSION['email']."'";
$pdo->prepare($requete)->execute();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/notif.png" width="50px" /> <b class="align-middle">Mes notifications</b></p>
      <?php
      $affiche='';
      $exi = 0;
      $req = $pdo->query("SELECT * FROM ".BDD."notifications WHERE `email`='".$_SESSION['email']."'");
      while ($donnees = $req->fetch())
      {
        $date = $donnees['date'];
        $titre = $donnees['titre'];
        $message = $donnees['message'];
        $id = $donnees['id'];
        $href = $donnees['href'];
        $duree = (strtotime(date("Y-m-d H:i:s")) - strtotime($date))/86400;
        $heure = date("H", strtotime($date))+2;
        if (strlen($heure)==1) {
          $heure = '0'.$heure;
        }
        if (floor($duree) == 0) {
          $moment = "Aujourd'hui à ".$heure.'h'.date("i", strtotime($date));
        } else {
          if (floor($duree) == 1) {
            $moment = "Hier à ".$heure.'h'.date("i", strtotime($date));
          } else {
            $moment = "Il y a ".floor($duree)." jours";
          }
        }
        if ($href=='') {
          $disp = "none";
        } else {
          $disp = "inline-block";
        }
        if ($duree<10) {
          $affiche = '<div class="card fondcolorcard" style="margin-bottom:1%;">
            <h5 class="card-header">'.$moment.'</h5>
            <div class="card-body">
              <h5 class="card-title">'.$titre.'</h5>
              <p class="card-text">'.$message.'</p>
              <div align="center" style="width:100%;margin:auto;"><a style="display:'.$disp.';width:40%;" href="'.$href.'" class="btn btn-primary">Consulter</a>
              <a style="display:inline-block;width:40%" href="/public/compte/prive/supprimer-notification.php?id='.$id.'" class="btn btn-secondary">Effacer</a></div>
            </div>
          </div>'.$affiche;
          $exi = 1;
        } else {
          $requete = "DELETE FROM ".BDD."notifications WHERE id='".$donnees['id']."'";
          $pdo->prepare($requete)->execute();
      }

      }
      if ($exi == 0) {
        echo '<div align="center"><img class="icon" src="/public/img/no_notification.png" style="max-height:200px;" /></br>
        <p class="raleway" style="font-size:20px;">Vous n\'avez pas de notification.</p></div>';
      }
      echo $affiche;
       ?>
  </div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

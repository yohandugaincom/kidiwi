<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>
  <?php
  $exi = 0;
  $req = $pdo->query("SELECT * FROM ".BDD."messages WHERE `id`='".$_GET['id']."'");
  while ($donnees = $req->fetch())
  {
    $email_expediteur1 = $donnees['email_expediteur'];
    $email_destinataire = $donnees['email_destinataire'];
    $date = $donnees['date'];
    if ($email_expediteur1 <> $_SESSION['email']) {
      echo '<script>location.href="/public/compte/prive/messagerie.php"';
      exit;
    }
    $titre = $donnees['titre'];
    $message = $donnees['message'];
    $id = $donnees['id'];
    $lu = $donnees['lu'];
    $heure = date("H", strtotime($date))+2;
    $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_expediteur."'");
    while ($donnees1 = $req1->fetch())
    {
      $role1 = $donnees1['role'];
    }
    if ($role1<>"parents") {
      $pro = ' <span class="badge badge-warning">Pro</span> ';
    }
    if (strlen($heure)==1) {
      $heure = '0'.$heure;
    }
    if (floor($duree) == 0) {
      $moment = "Aujourd'hui à ".$heure.'h'.date("i", strtotime($date));
    } else {
      if (floor($duree) == 1) {
        $moment = "Hier à ".$heure.'h'.date("i", strtotime($date));
      } else {
        $moment = "Le ".date("d F Y", strtotime($date))." à ".date("H:i", strtotime($date));
      }
    }
    $email_expediteur = str_replace("@", "AT", $email_destinataire);
    $email_expediteur = str_replace(".", "DOT", $email_expediteur);
    $email_expediteur = str_replace("-", "T", $email_expediteur);
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email_expediteur.".png")) {
        $avatar_expediteur = "/public/compte/avatar/".$email_expediteur.".png";
    } else {
        $avatar_expediteur = "/public/img/profil.png";
    }
  }
  $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_destinataire."'");
  while ($donnees = $req->fetch()) {
    $prenom = $donnees['prenom'];
  }
   ?>
  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:40px;margin-left:1%;"><img class="icon" src="/public/img/send.png" width="50px" /> <b class="align-middle">Envoyé à <?php echo $prenom; ?></b></p>
      <div style="margin-top:5%;">
        <div id="avatar" style="display:inline-block;float:left;width:25%;" align="center">
          <?php echo '<img id="avatar_users" src="'.$avatar_expediteur.'" width="100px" height="100px" />'; ?>
        </div>
        <div id="infos" style="display:inline-block;float:right;width:75%;" align="left">
          <span style="font-family:Times New Roman;font-size:20px;">Envoyé par : <b><?php echo $email_expediteur1; ?> (Vous)</b></span></br>
          <span style="font-family:Times New Roman;font-size:20px;">Destinataire : <b><?php echo $email_destinataire.$pro; ?></b></span></br>
          <span style="font-family:Times New Roman;font-size:20px;">Date d'envoi : <b><?php echo $moment; ?></b></span>
        </div>
      </div>
      <div style="margin-top:5%;float:left;width:100%;">
        <p style="font-family:Times New Roman;font-size:20px;">Objet : <b><?php echo $titre; ?></b></p>
        <p style="font-family:Arial;font-size:15px;"><?php echo $message; ?></p>
      </div>
      <div style="margin-top:2%;float:left;width:100%;">
        <hr>
        <p><?php if ($lu == "oui") {
          echo '<img class="icon" src="/public/img/lu.png" width="20px" /> '.$prenom.' a ouvert votre message.';
        } else {
          echo '<img class="icon" src="/public/img/pas_lu.png" width="20px" /> '.$prenom.' n\'a toujours pas ouvert votre message.';
        } ?></p>
      </div>
  </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

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
    if ($email_destinataire <> $_SESSION['email']) {
      echo '<script>location.href="/public/compte/prive/messagerie.php"';
      exit;
    }
    $date = $donnees['date'];
    $titre = $donnees['titre'];
    $message = $donnees['message'];
    $id = $donnees['id'];
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
    $email_expediteur = str_replace("@", "AT", $email_expediteur1);
    $email_expediteur = str_replace(".", "DOT", $email_expediteur);
    $email_expediteur = str_replace("-", "T", $email_expediteur);
    if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email_expediteur.".png")) {
        $avatar_expediteur = "/public/compte/avatar/".$email_expediteur.".png";
    } else {
        $avatar_expediteur = "/public/img/profil.png";
    }
  }
  $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_expediteur1."'");
  while ($donnees = $req->fetch()) {
    $prenom = $donnees['prenom'];
    $nom = $donnees['nom'];
  }
  $requete = "UPDATE ".BDD."messages SET lu='oui' WHERE id='".$_GET['id']."'";
  $pdo->prepare($requete)->execute();
   ?>
  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:40px;margin-left:1%;"><img class="icon" src="/public/img/return.png" width="50px" /> <b class="align-middle">Répondre à <?php echo $prenom; ?></b></p>
      <div style="margin-top:5%;">
        <div id="avatar" style="display:inline-block;float:left;width:25%;" align="center">
          <?php echo '<img id="avatar_users" src="'.$avatar_expediteur.'" width="100px" height="100px" />'; ?>
        </div>
        <div id="infos" style="display:inline-block;float:right;width:75%;" align="left">
          <span style="font-family:Times New Roman;font-size:20px;">Envoyé par : <b><?php echo $email_expediteur1.$pro; ?></b></span></br>
          <span style="font-family:Times New Roman;font-size:20px;">Destinataire : <b><?php echo $email_destinataire; ?> (Vous)</b></span></br>
          <span style="font-family:Times New Roman;font-size:20px;">Date d'envoi : <b><?php echo $moment; ?></b></span>
        </div>
      </div>
      <div style="margin-top:5%;float:left;width:100%;">
        <p style="font-family:Times New Roman;font-size:20px;">Objet : <b><?php echo $titre; ?></b></p>
        <p style="font-family:Arial;font-size:15px;"><?php echo $message; ?></p>
      </div>
      <div style="margin-top:2%;float:left;width:100%;">
        <hr>
        <p>Vous répondez à <?php echo $prenom.' '.$nom; ?>.</p>
        <form method="post" action="envoi-message.php">
          <input type="hidden" name="expediteur" value="<?php echo $_SESSION['email']; ?>">
          <input type="hidden" name="destinataire" value="<?php echo $email_expediteur1; ?>">
          <div class="form-group">
            <input required class="form-control form-control-lg" name="objet" type="text" placeholder="Objet du message">
          </div>
          <div class="form-group">
            <textarea required class="form-control form-control-lg" name="message" id="message" placeholder="Message" rows="5"></textarea>
          </div>
          <div class="form-group">
            <button id="envoyer" type="submit" style="width:100%;" class="btn btn-lg btn-success">Envoyer</button>
          </div>
        </form>
      </div>
  </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

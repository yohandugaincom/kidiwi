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
  $prenom = '';
  $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_GET['email']."'");
  while ($donnees = $req->fetch()) {
    $prenom = $donnees['prenom'];
  }
  if ($prenom=='') {
    echo '<script>location.href="/public/compte/se-deconnecter/incident.php";</script>';
    exit;
  }
  $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_expediteur."'");
  while ($donnees1 = $req1->fetch())
  {
    $role1 = $donnees1['role'];
  }
  if ($role1<>"parents") {
    $pro = ' <span class="badge badge-warning">Pro</span> ';
  }
  $email_expediteur = str_replace("@", "AT", $_GET['email']);
  $email_expediteur = str_replace(".", "DOT", $email_expediteur);
  $email_expediteur = str_replace("-", "T", $email_expediteur);
  if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email_expediteur.".png")) {
      $avatar_expediteur = "/public/compte/avatar/".$email_expediteur.".png";
  } else {
      $avatar_expediteur = "/public/img/profil.png";
  }
   ?>
  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:40px;margin-left:1%;"><img class="icon" src="/public/img/write.png" width="50px" /> <b class="align-middle">Nouveau message à <?php echo $prenom; ?></b></p>
      <div style="margin-top:5%;">
        <div id="avatar" style="display:inline-block;float:left;width:25%;" align="center">
          <?php echo '<img id="avatar_users" src="'.$avatar_expediteur.'" width="100px" height="100px" />'; ?>
        </div>
        <div id="infos" style="display:inline-block;float:right;width:75%;" align="left">
          <span style="font-family:Times New Roman;font-size:20px;">Envoyé par : <b><?php echo $_SESSION['email']; ?> (Vous)</b></span></br>
          <span style="font-family:Times New Roman;font-size:20px;">Destinataire : <b><?php echo $_GET['email'].$pro; ?></b></span>
        </div>
      </div>
      <div style="margin-top:2%;float:left;width:100%;">
        <hr>
        <form method="post" action="envoi-message.php">
          <input type="hidden" name="expediteur" value="<?php echo $_SESSION['email']; ?>">
          <input type="hidden" name="destinataire" value="<?php echo $_GET['email']; ?>">
          <div class="form-group">
            <input required class="form-control form-control-lg" name="objet" type="text" <?php if (isset($_GET['objet'])) {echo 'value="'.$_GET['objet'].'"';} ?> placeholder="Objet du message">
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

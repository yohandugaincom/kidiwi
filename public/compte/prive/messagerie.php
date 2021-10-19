<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$requete = "UPDATE ".BDD."general SET messages_num='0' WHERE email='".$_SESSION['email']."'";
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
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/message.png" width="50px" /> <b class="align-middle">Boîte de réception</b></p>
    <div style="margin-bottom:2%;">
        <button type="button" class="btn btn-success" style="margin-right:1%;" data-toggle="modal" data-target="#new">Envoyer un message</button>
        <a href="/public/compte/prive/messagerie-envoye.php"><button type="button" class="btn btn-dark" style="margin-right:1%;">Messages envoyés</button></a>
        <a href="/public/compte/prive/messagerie.php"><button type="button" class="btn btn-dark" style="margin-right:1%;">Actualiser</button></a>
    </div>
    <?php
    $affiche='';
    $exi = 0;
    $req = $pdo->query("SELECT * FROM ".BDD."messages WHERE email_destinataire='".$_SESSION['email']."' AND visible_des<>'non'");
    while ($donnees = $req->fetch())
    {
      $date = $donnees['date'];
      $lu = $donnees['lu'];
      $email_expediteur = $donnees['email_expediteur'];
      $titre = $donnees['titre'];
      $message = $donnees['message'];
      $id = $donnees['id'];
      $heure = date("H", strtotime($date))+2;
      $duree = (strtotime(date("Y-m-d H:i:s")) - strtotime($date))/86400;
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
      $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_expediteur."'");
      while ($donnees1 = $req1->fetch())
      {
        $role1 = $donnees1['role'];
      }
      if ($role1<>"parents") {
        $pro = '<span class="badge badge-warning">Pro</span> ';
      }
      $action = "Marquer</br>comme lu";
      if ($lu=="oui") {
        $action = "Masquer";
      }
      $email_expediteur = str_replace("@", "AT", $email_expediteur);
      $email_expediteur = str_replace(".", "DOT", $email_expediteur);
      $email_expediteur = str_replace("-", "T", $email_expediteur);
      if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email_expediteur.".png")) {
          $avatar_expediteur = "/public/compte/avatar/".$email_expediteur.".png";
      } else {
          $avatar_expediteur = "/public/img/profil.png";
      }
      if ($theme == "sombre") {
        $colorbtn = "dark";
      } else {
        $colorbtn = "light";
      }
        $affiche = '<div class="card mb-3 fondcolorcard" style="max-width:100%;min-height:180px;">
          <div class="row no-gutters">
            <div class="col-md-2">
              <img id="avatar_users" src="'.$avatar_expediteur.'" style="margin-top:8%;margin-left:10%;" width="150px" height="150px" />
            </div>
            <div class="col-md-6">
              <div class="card-body">
                <h5 class="card-title">'.$pro.substr($titre,0,50).'</h5>
                <p class="card-text">'.substr($message,0,125).'...</p>
                <p class="card-text"><small class="text-muted">'.$moment.'</small></p>
              </div>
            </div>
            <div class="col-md-4" align="right">
              <div class="btn-group mr-2" role="group" style="height:100%;width:100%;min-height:180px;">
                <button onclick="location.href=\'/public/compte/prive/messagerie-repondre.php?id='.$id.'\'" type="button" class="btn btn-'.$colorbtn.'" style="min-width:50%;">Répondre</button>
                <button onclick="location.href=\'/public/compte/prive/supprimer-des.php?id='.$id.'\'" type="button" class="btn btn-'.$colorbtn.'" style="min-width:50%;">'.$action.'</button>
              </div>
            </div>
          </div>
        </div>'.$affiche;
        $exi = 1;

    }
    if ($exi == 0) {
      echo '<div align="center"><img class="icon" src="/public/img/no_message.png" style="max-height:200px;" /></br>
      <p class="raleway" style="font-size:20px;">Vous n\'avez pas de messages.</p></div>';
    }
    echo $affiche;
     ?>

  </div>
  <div class="modal fade" id="new" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content fondcolorcard">
        <div class="modal-header">
          <h5 class="modal-title" >Rechercher un utilisateur</h5>
          <button type="button" class="close icon" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" align="center">
          <span id="result"><img id="avatar_users" src="/public/img/profil.png" width="150px" height="150px" /></br></br><p id="user">Aucun utilisateur trouvé.</p></span>
          <div class="form-group">
            <input id="query" required class="form-control form-control-lg" name="query" type="email" placeholder="Adresse e-mail de l'utilisateur">
          </div>
        </div>
        <div class="modal-footer">
          <button id="next" onclick="search();" type="button" class="btn btn-success">Rechercher</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Supprimer ce message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Attention,
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
function valide() {
  var user = document.getElementById("user");
  var continu = document.getElementById("next");
  if (user.innerHTML==='Aucun utilisateur trouvé.') {
    continu.innerHTML = "Rechercher";
  } else {
    continu.innerHTML = "Continuer";
  }
}
function search() {
  var query = document.getElementById("query");
  var result = document.getElementById("result");
  var continu = document.getElementById("next");
  var prec = document.getElementById("next").innerHTML;
  const req = new XMLHttpRequest();
  req.open('GET', '/public/compte/prive/messagerie-recherche-users.php?query=' + query.value, false);
  req.send(null);
  if (req.status === 200) {
      result.innerHTML = req.responseText;
      valide();
      if ((continu.innerHTML === 'Continuer') && (prec === continu.innerHTML)) {
        location.href = '/public/compte/prive/messagerie-nouveau.php?email=' + query.value;
      }
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

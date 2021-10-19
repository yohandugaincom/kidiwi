<?php
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$result = '<img id="avatar_users" src="/public/img/profil.png" width="150px" height="150px" /></br></br><p id="user">Aucun utilisateur trouvé.</p>';
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_GET['query']."'");
while ($donnees = $req->fetch())
{
  $email = str_replace("@", "AT", $donnees['email']);
  $email = str_replace(".", "DOT", $email);
  $email = str_replace("-", "T", $email);
  $prenom = $donnees['prenom'];
  $nom = $donnees['nom'];
  $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email."'");
  $role1 = $donnees['role'];
  if ($role1<>"parents") {
    $pro = ' <span class="badge badge-warning">Pro</span> ';
  }
  if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email.".png")) {
      $avatar = "/public/compte/avatar/".$email.".png";
  } else {
      $avatar = "/public/img/profil.png";
  }
  $result = '<img id="avatar_users" src="'.$avatar.'" width="150px" height="150px" /></br></br><p id="user">'.$prenom.' '.$nom.$pro.'</p>';
}
echo $result;
 ?>

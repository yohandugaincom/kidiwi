<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $req = $pdo->query("SELECT * FROM ".BDD."messages WHERE id='".$_GET['id']."'");
  while ($donnees = $req->fetch()) {
    $email_adress = $donnees['email_destinataire'];
    $lu = $donnees['lu'];
  }
  if ($email_adress == $_SESSION['email']) {
    if ($lu == 'oui') {
      $requete = "UPDATE ".BDD."messages SET visible_des='non' WHERE id='".$_GET['id']."'";
      $pdo->prepare($requete)->execute();
      header('Location: /public/compte/prive/messagerie.php');
    } else {
      $requete = "UPDATE ".BDD."messages SET lu='oui' WHERE id='".$_GET['id']."'";
      $pdo->prepare($requete)->execute();
      header('Location: /public/compte/prive/messagerie.php');
    }
  }
}
?>

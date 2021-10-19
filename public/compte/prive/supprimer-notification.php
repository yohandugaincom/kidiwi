<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $req = $pdo->query("SELECT * FROM ".BDD."notifications WHERE `id`='".$_GET['id']."'");
  while ($donnees = $req->fetch()) {
    $email_adress = $donnees['email'];
  }
  if ($email_adress == $_SESSION['email']) {
    $req = "DELETE FROM ".BDD."notifications WHERE id='".$_GET['id']."'";
    $pdo->prepare($req)->execute();
    header('Location: /public/compte/prive/notification.php');
  }
}
?>

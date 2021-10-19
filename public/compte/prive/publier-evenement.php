<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE `id`='".$_GET['id']."'");
while ($donnees = $req->fetch())
{
  $email_presentation = $donnees['email'];
}
if ($email_presentation == $_SESSION['email']) {
  $requete = "UPDATE ".BDD."evenements SET active='oui' WHERE id='".$_GET['id']."'";
  $pdo->prepare($requete)->execute();
}
header('Location: /public/activite/presentation.php?id='.$_GET['id']);
 ?>

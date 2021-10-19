<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE `id`='".$_POST['id']."'");
while ($donnees = $req->fetch())
{
  $inscrits = $donnees['liste_inscrits'];
}
$req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `id`='".$_POST['enfant']."'");
while ($donnees = $req->fetch())
{
  $prenom = $donnees['prenom'];
}
if (($prenom=='') || ($_POST['enfant']=='') || (!isset($_POST['enfant']))) {
  header('Location: /public/activite/presentation.php?id='.$_POST['id']);
  exit;
}
$inscrits = $inscrits.$_POST['enfant'].',';
$requete = "UPDATE ".BDD."evenements SET liste_inscrits='".$inscrits."' WHERE id='".$_POST['id']."'";
$pdo->prepare($requete)->execute();
$date = date("Y-m-d H:i:s");
$requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date."', 'Confirmation de réservation', 'Nous vous confirmons de la bonne réservation de l''activité <b>".$_POST['titre']."</b> pour <b>".$prenom."</b>.', '/public/activite/presentation.php?id=".$_POST['id']."')";
$pdo->prepare($requete)->execute();
$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $num = $donnees['notifications_num'];
}
$num = $num+1;
$requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_SESSION['email']."'";
$pdo->prepare($requete)->execute();
header('Location: /public/activite/presentation.php?id='.$_POST['id']);
 ?>

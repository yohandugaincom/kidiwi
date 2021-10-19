<?php
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
session_start();
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$theme = "default";
if ($_GET['id'] == "2") {
  $theme = "sombre";
}
$requete = "UPDATE ".BDD."general SET theme='".$theme."' WHERE email='".$_SESSION['email']."'";
$pdo->prepare($requete)->execute();

$date = date("Y-m-d H:i:s");
$requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date."', 'À propos de vos préférences', 'Votre nouveau thème par défaut a été modifié. Ce thème s\'appliquera également lors de vos prochaines visites.', '')";
$pdo->prepare($requete)->execute();

$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $num = $donnees['notifications_num'];
}
$num = $num+1;
$requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_SESSION['email']."'";
$pdo->prepare($requete)->execute();

header('Location: /public/compte/prive/mes-preferences.php');

 ?>

<?php
include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$date = date("Y-m-d H:i:s");
$requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_GET['email']."', '".$date."', '".htmlentities($_GET['titre'], ENT_QUOTES)."', '".htmlentities($_GET['message'], ENT_QUOTES)."', '".$_GET['href']."')";
$pdo->prepare($requete)->execute();

$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_GET['email']."'");
while ($donnees = $req->fetch())
{
  $num = $donnees['notifications_num'];
}
$num = $num+1;
$requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_GET['email']."'";
$pdo->prepare($requete)->execute();

 ?>

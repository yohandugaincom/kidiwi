<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); session_start();
if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `active`='".$_GET['code']."'");
while ($donnees = $req->fetch())
{
	$email = $donnees['email'];
}
$req->closeCursor();
if (($email == $_GET['email']) && ($_GET['code'] <> 'oui')) {
  echo 'true';
  $requete = "UPDATE ".BDD."utilisateurs SET active='oui' WHERE active='".$_GET['code']."'";
  $pdo->prepare($requete)->execute();
} else {
  echo 'false';
}
 ?>

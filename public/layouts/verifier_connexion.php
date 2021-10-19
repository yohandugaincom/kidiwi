<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
$secure = false;
session_start();
if (!isset($_SESSION['connecte'])) {
  header('Location: /public/compte/se-deconnecter/delai.php');
}
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
	$active = $donnees['active'];
  $mot_de_passe = $donnees['mot_de_passe'];
}
if (($active <> "oui") || (!password_verify($_SESSION['password'], $mot_de_passe))) {
  header('Location: /public/compte/se-deconnecter/incident.php');
}
$secure = true;

 ?>

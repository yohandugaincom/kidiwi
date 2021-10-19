<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();

// Génère un code pour la déconnexion
function kodex_random_string($length=20){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';
    for($i=0; $i<$length; $i++){
        $string .= $chars[rand(0, strlen($chars)-1)];
    }
    return $string;
}

$secure = kodex_random_string();

$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_GET['email']."'");
while ($donnees = $req->fetch())
{
	$active = $donnees['active'];
  $mot_de_passe = $donnees['mot_de_passe'];
  $role = $donnees['role'];
}
$req->closeCursor();
if (($active == "oui") && (password_verify($_GET['password'], $mot_de_passe))) {
  echo 'true';
  $_SESSION['connecte'] = $secure;
  $_SESSION['password'] = $_GET['password'];
  $_SESSION['email'] = $_GET['email'];
  $_SESSION['role'] = $role;
} else {
  if (password_verify($_GET['password'], $mot_de_passe)) {
    echo 'non_active';
  } else {
    echo 'false';
  }
}

 ?>

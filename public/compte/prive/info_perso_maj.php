<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
$prenom_secondaire = "";
$nom_secondaire = "";
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $prenom = htmlentities($_POST['prenom'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom'], ENT_QUOTES);
  $prenom_secondaire = htmlentities($_POST['prenom2'], ENT_QUOTES);
  $nom_secondaire = htmlentities($_POST['nom2'], ENT_QUOTES);
  $adresse = htmlentities($_POST['adresse'], ENT_QUOTES);
  $adresse_complement = htmlentities($_POST['c_adresse'], ENT_QUOTES);
  $ville = htmlentities($_POST['ville'], ENT_QUOTES);
  $code_postal = htmlentities($_POST['cp'], ENT_QUOTES);
  $requete = "UPDATE ".BDD."utilisateurs SET prenom='".$prenom."', nom='".$nom."', prenom_secondaire='".$prenom_secondaire."', nom_secondaire='".$nom_secondaire."',
  adresse='".$adresse."', adresse_complement='".$adresse_complement."', ville='".$ville."', code_postal='".$code_postal."' WHERE email='".$_SESSION['email']."'";
  $pdo->prepare($requete)->execute();
  header('Location: /public/compte/prive/mon-compte.php');
}
?>

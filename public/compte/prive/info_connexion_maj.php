<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
$email_secondaire = "";
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $email_secondaire = htmlentities($_POST['email2'], ENT_QUOTES);
  $nmdp = htmlentities($_POST['nmdp'], ENT_QUOTES);
  $nmdpr = htmlentities($_POST['nmdpr'], ENT_QUOTES);
  $mdp = htmlentities($_POST['mdp'], ENT_QUOTES);
  $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_SESSION['email']."'");
  while ($donnees = $req->fetch())
  {
    $mot_de_passe = $donnees['mot_de_passe'];
  }
  if ((password_verify($mdp, $mot_de_passe)) && ($nmdp == $nmdpr)) {
    $mdp = password_hash($nmdp, PASSWORD_DEFAULT);
    if ($nmdp == '') {
      $requete = "UPDATE ".BDD."utilisateurs SET email_secondaire='".$email_secondaire."' WHERE email='".$_SESSION['email']."'";
      $pdo->prepare($requete)->execute();
    } else {
      $requete = "UPDATE ".BDD."utilisateurs SET email_secondaire='".$email_secondaire."', mot_de_passe='".$mdp."' WHERE email='".$_SESSION['email']."'";
      $pdo->prepare($requete)->execute();
      $_SESSION['password'] = $nmdp;
    }
    $date = date("Y-m-d H:i:s");
    $requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date."', 'Alerte de sécurité', 'Nous vous informons que vos informations de connexion ont bien été mises à jour.', '')";
    $pdo->prepare($requete)->execute();

    $req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
    while ($donnees = $req->fetch())
    {
      $num = $donnees['notifications_num'];
    }
    $num = $num+1;
    $requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_SESSION['email']."'";
    $pdo->prepare($requete)->execute();
    header('Location: /public/compte/prive/mon-compte.php');
  } else {
    header('Location: /public/compte/prive/info_connexion.php?status=incorrect');
  }
}
?>

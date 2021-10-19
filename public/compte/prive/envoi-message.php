<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  function kodex_random_string($length=20){
      $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $string = '';
      for($i=0; $i<$length; $i++){
          $string .= $chars[rand(0, strlen($chars)-1)];
      }
      return $string;
  }

  $titre = htmlentities($_POST['objet'], ENT_QUOTES);
  $message = htmlentities($_POST['message'], ENT_QUOTES);
  $email_expediteur = $_POST['expediteur'];
  $email_destinataire = $_POST['destinataire'];
  $date = date("Y-m-d H:i:s");

    $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $req = "INSERT INTO ".BDD."messages (id, email_expediteur, email_destinataire, date, titre, message, lu, visible_des, visible_exp)
     VALUES (NULL, '".$email_expediteur."', '".$email_destinataire."', '".$date."', '".$titre."', '".$message."', 'non', 'oui', 'oui')";
      $pdo->prepare($req)->execute();
      $id = $pdo->lastInsertId();
      $req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$email_destinataire."'");
      while ($donnees = $req->fetch())
      {
        $num = $donnees['messages_num'];
      }
      $num = $num+1;
      $requete = "UPDATE ".BDD."general SET messages_num='".$num."' WHERE email='".$email_destinataire."'";
      $pdo->prepare($requete)->execute();
      header('Location: /public/compte/prive/messagerie-recapitulatif.php?id='.$id);
}
 ?>

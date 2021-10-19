<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE `id`='".$_GET['id']."'");
  while ($donnees = $req->fetch()) {
    $email_adress = $donnees['email'];
    $liste_inscrits = $donnees['liste_inscrits'];
  }
  $req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_adress."'");
  while ($donnees = $req->fetch())
  {
    $prenom = $donnees['prenom'];
  }
  if ($email_adress == $_SESSION['email']) {

    $inscrits = explode(",", $liste_inscrits);
    foreach($inscrits as $id_enfant) {
          $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `id`='".$id_enfant."'");
          while ($donnees = $req->fetch())
          {
            $date1 = date("Y-m-d H:i:s");
            $requete1 = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date1."', 'À propos de votre réservation', 'Nous vous informons que ".$prenom." a annulé son évènement. Vous ne serez pas débité pour cette prestation. Nous vous conseillons de prendre contact avec ".$prenom." pour en savoir plus <a href=''/public/compte/prive/messagerie-nouveau.php?email=".$email_presentation."&objet=[Annonce désactivée]''>en cliquant ici.</a>', '')";
            $pdo->prepare($requete1)->execute();
            $req1 = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_donnees['email']."'");
            while ($donnees1 = $req1->fetch())
            {
              $num1 = $donnees1['notifications_num'];
            }
            $num1 = $num1+1;
            $requete11 = "UPDATE ".BDD."general SET notifications_num='".$num1."' WHERE email='".$_donnees['email']."'";
            $pdo->prepare($requete11)->execute();
          }
      }

    $req = "DELETE FROM ".BDD."evenements WHERE id='".$_GET['id']."'";
    $pdo->prepare($req)->execute();

    $requete = "UPDATE ".BDD."evenements SET liste_inscrits='".$inscrits."' WHERE id='".$_POST['id']."'";
    $pdo->prepare($requete)->execute();
    $date = date("Y-m-d H:i:s");
    $requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date."', 'Confirmation de suppression', 'Nous vous confirmons de la bonne suppression de votre activité. Nous vous informons également que vous ne percevrez plus la commission associée.', '')";
    $pdo->prepare($requete)->execute();
    $req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
    while ($donnees = $req->fetch())
    {
      $num = $donnees['notifications_num'];
    }
    $num = $num+1;
    $requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_SESSION['email']."'";
    $pdo->prepare($requete)->execute();

    header('Location: /public/compte/prive/mes-evenements.php');
  }
}
?>

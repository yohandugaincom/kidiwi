<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_parents.php';
if ($secure == true) {
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $num_enfants = 0;
  $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE email='".$_SESSION['email']."'");
  while ($donnees = $req->fetch()) {
    $num_enfants = $num_enfants+1;
  }
  $id = $_POST['e1'];
  $prenom = htmlentities($_POST['prenom1'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom1'], ENT_QUOTES);
  $sexe = htmlentities($_POST['sexe1'], ENT_QUOTES);
  $date = htmlentities($_POST['naissance1'], ENT_QUOTES);
  if ($id <> '') {
    $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE id='".$id."'");
    while ($donnees = $req->fetch()) {
      $email = $donnees['email'];
    }
    if ($email == $_SESSION['email']) {
      $requete = "UPDATE ".BDD."enfants SET prenom='".$prenom."', nom='".$nom."', sexe='".$sexe."', date_naissance='".$date."' WHERE id='".$id."'";
      $pdo->prepare($requete)->execute();
    } else {
      header('Location: /public/compte/se-deconnecter/incident.php');
    }
  } else {
    if (($_POST['prenom1'] <> '') && ($num_enfants<5)) {
      $requete = "INSERT INTO ".BDD."enfants (id, email, prenom, nom, date_naissance, sexe) VALUES (NULL, '".$_SESSION['email']."', '".$prenom."', '".$nom."', '".$date."', '".$sexe."')";
      $pdo->prepare($requete)->execute();
    }
  }
  $id = $_POST['e2'];
  $prenom = htmlentities($_POST['prenom2'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom2'], ENT_QUOTES);
  $sexe = htmlentities($_POST['sexe2'], ENT_QUOTES);
  $date = htmlentities($_POST['naissance2'], ENT_QUOTES);
  if ($id <> '') {
    $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE id='".$id."'");
    while ($donnees = $req->fetch()) {
      $email = $donnees['email'];
    }
    if ($email == $_SESSION['email']) {
      $requete = "UPDATE ".BDD."enfants SET prenom='".$prenom."', nom='".$nom."', sexe='".$sexe."', date_naissance='".$date."' WHERE id='".$id."'";
      $pdo->prepare($requete)->execute();
    } else {
      header('Location: /public/compte/se-deconnecter/incident.php');
    }
  } else {
    if (($_POST['prenom2'] <> '') && ($num_enfants<5)) {
      $requete = "INSERT INTO ".BDD."enfants (id, email, prenom, nom, date_naissance, sexe) VALUES (NULL, '".$_SESSION['email']."', '".$prenom."', '".$nom."', '".$date."', '".$sexe."')";
      $pdo->prepare($requete)->execute();
    }
  }
  $id = $_POST['e3'];
  $prenom = htmlentities($_POST['prenom3'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom3'], ENT_QUOTES);
  $sexe = htmlentities($_POST['sexe3'], ENT_QUOTES);
  $date = htmlentities($_POST['naissance3'], ENT_QUOTES);
  if ($id <> '') {
    $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE id='".$id."'");
    while ($donnees = $req->fetch()) {
      $email = $donnees['email'];
    }
    if ($email == $_SESSION['email']) {
      $requete = "UPDATE ".BDD."enfants SET prenom='".$prenom."', nom='".$nom."', sexe='".$sexe."', date_naissance='".$date."' WHERE id='".$id."'";
      $pdo->prepare($requete)->execute();
    } else {
      header('Location: /public/compte/se-deconnecter/incident.php');
    }
  } else {
    if (($_POST['prenom3'] <> '') && ($num_enfants<5)) {
      $requete = "INSERT INTO ".BDD."enfants (id, email, prenom, nom, date_naissance, sexe) VALUES (NULL, '".$_SESSION['email']."', '".$prenom."', '".$nom."', '".$date."', '".$sexe."')";
      $pdo->prepare($requete)->execute();
    }
  }
  $id = $_POST['e4'];
  $prenom = htmlentities($_POST['prenom4'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom4'], ENT_QUOTES);
  $sexe = htmlentities($_POST['sexe4'], ENT_QUOTES);
  $date = htmlentities($_POST['naissance4'], ENT_QUOTES);
  if ($id <> '') {
    $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE id='".$id."'");
    while ($donnees = $req->fetch()) {
      $email = $donnees['email'];
    }
    if ($email == $_SESSION['email']) {
      $requete = "UPDATE ".BDD."enfants SET prenom='".$prenom."', nom='".$nom."', sexe='".$sexe."', date_naissance='".$date."' WHERE id='".$id."'";
      $pdo->prepare($requete)->execute();
    } else {
      header('Location: /public/compte/se-deconnecter/incident.php');
    }
  } else {
    if (($_POST['prenom4'] <> '') && ($num_enfants<5)) {
      $requete = "INSERT INTO ".BDD."enfants (id, email, prenom, nom, date_naissance, sexe) VALUES (NULL, '".$_SESSION['email']."', '".$prenom."', '".$nom."', '".$date."', '".$sexe."')";
      $pdo->prepare($requete)->execute();
    }
  }
  $id = $_POST['e5'];
  $prenom = htmlentities($_POST['prenom5'], ENT_QUOTES);
  $nom = htmlentities($_POST['nom5'], ENT_QUOTES);
  $sexe = htmlentities($_POST['sexe5'], ENT_QUOTES);
  $date = htmlentities($_POST['naissance5'], ENT_QUOTES);
  if ($id <> '') {
    $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE id='".$id."'");
    while ($donnees = $req->fetch()) {
      $email = $donnees['email'];
    }
    if ($email == $_SESSION['email']) {
      $requete = "UPDATE ".BDD."enfants SET prenom='".$prenom."', nom='".$nom."', sexe='".$sexe."', date_naissance='".$date."' WHERE id='".$id."'";
      $pdo->prepare($requete)->execute();
    } else {
      header('Location: /public/compte/se-deconnecter/incident.php');
    }
  } else {
    if (($_POST['prenom5'] <> '') && ($num_enfants<5)) {
      $requete = "INSERT INTO ".BDD."enfants (id, email, prenom, nom, date_naissance, sexe) VALUES (NULL, '".$_SESSION['email']."', '".$prenom."', '".$nom."', '".$date."', '".$sexe."')";
      $pdo->prepare($requete)->execute();
    }
  }
  header('Location: /public/compte/prive/mon-compte.php');
}
?>

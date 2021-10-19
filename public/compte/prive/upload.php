<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $email = str_replace("@", "AT", $_SESSION['email']);
  $email = str_replace(".", "DOT", $email);
  $email = str_replace("-", "T", $email);
  /* Getting file name */
  $filename = $_FILES['file']['name'];

  /* Location */
  $location = $_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$filename;
  $uploadOk = 1;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

  /* Valid Extensions */
  $valid_extensions = array("jpg","jpeg","png");
  /* Check file extension */
  if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
     $uploadOk = 0;
  }

  if($uploadOk == 0){
     echo 0;
  }else{
     /* Upload file */
     if(move_uploaded_file($_FILES['file']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email.".png")){
        echo 1;
        $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
        $date = date("Y-m-d H:i:s");
        $requete = "INSERT INTO ".BDD."notifications (id, email, date, titre, message, href) VALUES (NULL, '".$_SESSION['email']."', '".$date."', 'Alerte de confidentialité', 'Vous avez mis à jour votre avatar Kid''iwi. Nous vous rappelons que cet avatar est visible et accessible par l''ensemble de la communauté.', '/public/compte/prive/mon-avatar.php')";
        $pdo->prepare($requete)->execute();

        $req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
        while ($donnees = $req->fetch())
        {
          $num = $donnees['notifications_num'];
        }
        $num = $num+1;
        $requete = "UPDATE ".BDD."general SET notifications_num='".$num."' WHERE email='".$_SESSION['email']."'";
        $pdo->prepare($requete)->execute();
     }else{
        echo 0;
     }
  }
} else {
  echo 0;
}


?>

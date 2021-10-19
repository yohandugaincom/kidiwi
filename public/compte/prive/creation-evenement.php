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

  $titre = $_POST['titre'];
  $theme = $_POST['theme'];
  $prix = $_POST['prix'];
  $places_max = $_POST['places_max'];
  $age_min = $_POST['age_min'];
  $age_max = $_POST['age_max'];
  $date = $_POST['date'];
  $heure = $_POST['heure'];
  $description = $_POST['description'];
  $adresse = $_POST['adresse'];
  $longitude = $_POST['longitude'];
  $latitude = $_POST['latitude'];
  $date_formated = $date.' '.$heure;
  $image1 = kodex_random_string().'.png';
  $image2 = kodex_random_string().'.png';
  $image3 = kodex_random_string().'.png';

    $filename = $_FILES['file1']['name'];
    $location = $_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions = array("jpg","jpeg","png");
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }
    if($uploadOk == 0){
       echo 'Image 1 : non transféré.';
       $image1 = '';
    }else{
       if(move_uploaded_file($_FILES['file1']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$image1)){
         echo 'Image 1 : transféré.';
       }
    }

    $filename = $_FILES['file2']['name'];
    $location = $_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions = array("jpg","jpeg","png");
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }
    if($uploadOk == 0){
       echo 'Image 2 : non transféré.';
       $image2 = '';
    }else{
       if(move_uploaded_file($_FILES['file2']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$image2)){
         echo 'Image 2 : transféré.';
       }
    }

    $filename = $_FILES['file3']['name'];
    $location = $_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    $valid_extensions = array("jpg","jpeg","png");
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }
    if($uploadOk == 0){
       echo 'Image 3 : non transféré.';
       $image3 = '';
    }else{
       if(move_uploaded_file($_FILES['file3']['tmp_name'],$_SERVER['DOCUMENT_ROOT']."/public/activite/img/".$image3)){
         echo 'Image 3 : transféré.';
       }
    }

    $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $req = "INSERT INTO ".BDD."evenements (id, email, date, titre, description, places_min, places_max, age_min, age_max, prix, adresse, theme, longitude, latitude, liste_inscrits, active, image1, image2, image3) VALUES (NULL, '".$_SESSION['email']."', '".$date_formated."', '".$titre."', '".$description."', '0', '".$places_max."', '".$age_min."', '".$age_max."', '".$prix."', '".htmlentities($adresse, ENT_QUOTES)."','".$theme."', '".$longitude."', '".$latitude."', '', 'non', '".$image1."', '".$image2."', '".$image3."')";
      $pdo->prepare($req)->execute();
      $id = $pdo->lastInsertId();
      header('Location: /public/activite/presentation.php?id='.$id);
}
 ?>

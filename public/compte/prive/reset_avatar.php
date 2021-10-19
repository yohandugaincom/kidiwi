<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
if ($secure == true) {
  $email = str_replace("@", "AT", $_SESSION['email']);
  $email = str_replace(".", "DOT", $email);
  $email = str_replace("-", "T", $email);
  if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email.".png")) {
      unlink($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email.".png");
  }
}


?>

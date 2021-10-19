<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();

if ($_GET['secure'] == $_SESSION['connecte']) {
  session_destroy();
  header('Location: /public/compte/se-connecter/se-connecter.php?status=deconnecte');
}

 ?>

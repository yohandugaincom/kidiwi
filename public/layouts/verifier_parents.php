<?php
if ($_SESSION['role']<>"parents") {
  header('Location: /public/404.php');
}
 ?>

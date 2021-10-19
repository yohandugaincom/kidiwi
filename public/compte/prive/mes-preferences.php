<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/preferences.png" width="50px" /> <b class="align-middle">Mes préférences</b></p>
    <p class="raleway" style="font-size:25px;">Thèmes</p>
    <div align="center">
      <a href="theme.php?id=1"><img class="zoom" src="/public/img/theme_default.png" width="300px" /></a>
      <a href="theme.php?id=2"><img class="zoom" style="margin-left:4%;" src="/public/img/theme_sombre.png" width="300px" /></a>
    </div>
  </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

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
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/account.png" width="50px" /> <b class="align-middle">Mon compte</b></p>
    <div style="margin-bottom:2%;">
        <a href="/public/compte/prive/info_perso.php"><button type="button" class="btn btn-dark" style="margin-right:1%;"><img src="/public/img/identity.png" style="filter:invert(1);vertical-align:-4px;" width="20px" /> Informations personnelles</button></a>
        <a href="/public/compte/prive/info_connexion.php"><button type="button" class="btn btn-dark" style="margin-right:1%;"><img src="/public/img/security.png" style="filter:invert(1);vertical-align:-4px;" width="20px" /> Sécurité</button></a>
        <?php if ($_SESSION['role']=="parents") {
          echo '<a href="/public/compte/prive/mes-enfants.php"><button type="button" class="btn btn-dark" style="margin-right:1%;"><img src="/public/img/family.png" style="filter:invert(1);vertical-align:-4px;" width="20px" /> Mes enfants</button></a>';
        } ?>
        <a href="/public/compte/prive/mes-preferences.php"><button type="button" class="btn btn-dark" style="margin-right:1%;"><img src="/public/img/preferences.png" style="filter:invert(1);vertical-align:-4px;" width="20px" /> Mes préférences</button></a>
    </div>
  </div>

</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

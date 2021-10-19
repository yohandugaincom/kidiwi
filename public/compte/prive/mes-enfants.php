<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_parents.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$num_enfants = 0;
$req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $num_enfants = $num_enfants+1;
  if ($num_enfants==1) {
    $id1 = $donnees['id'];
    $prenom1 = $donnees['prenom'];
    $nom1 = $donnees['nom'];
    $date1 = $donnees['date_naissance'];
    $sexe1 = $donnees['sexe'];
  }
  if ($num_enfants==2) {
    $id2 = $donnees['id'];
    $prenom2 = $donnees['prenom'];
    $nom2 = $donnees['nom'];
    $date2 = $donnees['date_naissance'];
    $sexe2 = $donnees['sexe'];
  }
  if ($num_enfants==3) {
    $id3 = $donnees['id'];
    $prenom3 = $donnees['prenom'];
    $nom3 = $donnees['nom'];
    $date3 = $donnees['date_naissance'];
    $sexe3 = $donnees['sexe'];
  }
  if ($num_enfants==4) {
    $id4 = $donnees['id'];
    $prenom4 = $donnees['prenom'];
    $nom4 = $donnees['nom'];
    $date4 = $donnees['date_naissance'];
    $sexe4 = $donnees['sexe'];
  }
  if ($num_enfants==5) {
    $id5 = $donnees['id'];
    $prenom5 = $donnees['prenom'];
    $nom5 = $donnees['nom'];
    $date5 = $donnees['date_naissance'];
    $sexe5 = $donnees['sexe'];
  }
}
$req->closeCursor(); ?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/family.png" width="50px" /> <b class="align-middle">Mes enfants</b></p>
    <div align="center" class="lato" style="font-size:15px;margin-top:1%;">
      <div align="center" style="margin-top:1%;">
        <div id="alert" class="alert alert-success" role="alert" style="width:45%;height:90px;">
          <div style="display:inline-block;float:left;width:25%;">
            <img src="/public/img/kid.png" width="50px" />
          </div>
          <div style="display:inline-block;float:right;width:75%;font-size:12px;" align="left">
            <p style="margin-top:8px;">Parce que l'avenir de vos enfants leur appartient,</br>
            nous souhaitons récolter le moins d'informations possible les concernant !</p>
          </div>
        </div>
      </div>
    </div>
    <form method="post" action="mes-enfants-maj.php">
      <div style="display:block;">
        <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°1</p>
        <div class="form-row">
          <div class="form-group col-md-6">
            <input onkeyup="direct_empty(this);" type="text" value="<?php echo $prenom1; ?>" class="form-control" id="prenom1" name="prenom1" placeholder="Prénom"></br>
            <select name="sexe1" class="form-control">
              <option value="ND">Non défini</option>
              <option value="f"<?php if ($sexe1=="f") {echo " selected";} ?>>Fille</option>
              <option value="m"<?php if ($sexe1=="m") {echo " selected";} ?>>Garçon</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <input onkeyup="direct_empty(this);" type="text" value="<?php echo $nom1; ?>" class="form-control" id="nom1" name="nom1" placeholder="Nom"></br>
            <input type="date" value="<?php echo $date1; ?>" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance1">
          </div>
        </div>
        </br>
    </div>
    <div style="display:block;" id="kid2">
      <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°2</p>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input onkeyup="direct_empty(this);" type="text" value="<?php echo $prenom2; ?>" class="form-control" name="prenom2" placeholder="Prénom"></br>
          <select name="sexe2" class="form-control">
            <option value="ND">Non défini</option>
            <option value="f"<?php if ($sexe2=="f") {echo " selected";} ?>>Fille</option>
            <option value="m"<?php if ($sexe2=="m") {echo " selected";} ?>>Garçon</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <input onkeyup="direct();direct_empty(this);" type="text" value="<?php echo $nom2; ?>" class="form-control" name="nom2" placeholder="Nom"></br>
          <input type="date" value="<?php echo $date2; ?>" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance2">
        </div>
      </div>
      </br>
  </div>
  <div style="display:block;" id="kid3">
    <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°3</p>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $prenom3; ?>" class="form-control" name="prenom3" placeholder="Prénom"></br>
        <select name="sexe3" class="form-control">
          <option value="ND">Non défini</option>
          <option value="f"<?php if ($sexe3=="f") {echo " selected";} ?>>Fille</option>
          <option value="m"<?php if ($sexe3=="m") {echo " selected";} ?>>Garçon</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $nom3; ?>" class="form-control" name="nom3" placeholder="Nom"></br>
        <input type="date" value="<?php echo $date3; ?>" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance3">
      </div>
    </div>
    </br>
  </div>
  <div style="display:block;" id="kid4">
    <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°4</p>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $prenom4; ?>" class="form-control" name="prenom4" placeholder="Prénom"></br>
        <select name="sexe4" class="form-control">
          <option value="ND">Non défini</option>
          <option value="f"<?php if ($sexe4=="f") {echo " selected";} ?>>Fille</option>
          <option value="m"<?php if ($sexe4=="m") {echo " selected";} ?>>Garçon</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $nom4; ?>" class="form-control" name="nom4" placeholder="Nom"></br>
        <input type="date" value="<?php echo $date4; ?>" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance4">
      </div>
    </div>
    </br>
  </div>
  <div style="display:block;" id="kid5">
    <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°5</p>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $prenom5; ?>" class="form-control" name="prenom5" placeholder="Prénom"></br>
        <select name="sexe5" class="form-control">
          <option value="ND">Non défini</option>
          <option value="f"<?php if ($sexe5=="f") {echo " selected";} ?>>Fille</option>
          <option value="m"<?php if ($sexe5=="m") {echo " selected";} ?>>Garçon</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct_empty(this);" type="text" value="<?php echo $nom5; ?>" class="form-control" name="nom5" placeholder="Nom"></br>
        <input type="date" value="<?php echo $date5; ?>" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance5">
      </div>
    </div>
    </br>
    <input type="hidden" value="<?php echo $id1; ?>" name="e1">
    <input type="hidden" value="<?php echo $id2; ?>" name="e2">
    <input type="hidden" value="<?php echo $id3; ?>" name="e3">
    <input type="hidden" value="<?php echo $id4; ?>" name="e4">
    <input type="hidden" value="<?php echo $id5; ?>" name="e5">
  </div>
    <hr style="width:80%">
    <div style="margin-bottom:2%;" align="right">
      <p id="sorry" style="display:block;"></br>Malheureusement, Kid'iwi ne peut pas encore supporter plus de 5 enfants par compte.</p>
        <button type="submit" class="btn btn-success" style="margin-right:1%;">Mettre à jour</button>
        <a href="/public/compte/prive/mon-compte.php"><button type="button" class="btn btn-dark" style="margin-right:1%;">Annuler</button></a>
    </div>
  </form>
  </div>

</div>
<script>
function direct_empty(x) {
  if (x.value !== '') {
    x.classList.remove("is-invalid");
    x.classList.add("is-valid");
  } else {
    x.classList.add("is-invalid");
    x.classList.remove("is-valid");
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); session_start();if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>

<div align="center" class="raleway animated bounceInDown" style="font-size:35px;margin-top:11%;">Désormais, faisons connaissance avec vos enfants !</div>

<div align="center" class="lato animated bounceInDown" style="font-size:15px;margin-top:1%;">
  <div align="center" style="margin-top:1%;">
    <div id="alert" class="alert alert-success" role="alert" style="width:45%;height:75px;">
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

<div id="donnees" style="width:40%;margin:auto;margin-top:2%;" class=" animated bounceInDown">
  <form method="post" action="etape-4.php">
    <div style="display:block;">
      <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°1</p>
      <div class="form-row">
        <div class="form-group col-md-6">
          <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" id="prenom1" name="prenom1" placeholder="Prénom"></br>
          <select name="sexe1" class="form-control">
            <option value="ND">Non défini</option>
            <option value="f">Fille</option>
            <option value="m">Garçon</option>
          </select>
        </div>
        <div class="form-group col-md-6">
          <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" id="nom1" name="nom1" placeholder="Nom"></br>
          <input type="date" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance1">
        </div>
      </div>
      </br>
  </div>
  <div style="display:none;" class="animated flipInX" id="kid2">
    <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°2</p>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="prenom2" placeholder="Prénom"></br>
        <select name="sexe2" class="form-control">
          <option value="ND">Non défini</option>
          <option value="f">Fille</option>
          <option value="m">Garçon</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="nom2" placeholder="Nom"></br>
        <input type="date" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance2">
      </div>
    </div>
    </br>
</div>
<div style="display:none;" class="animated flipInX" id="kid3">
  <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°3</p>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="prenom3" placeholder="Prénom"></br>
      <select name="sexe3" class="form-control">
        <option value="ND">Non défini</option>
        <option value="f">Fille</option>
        <option value="m">Garçon</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="nom3" placeholder="Nom"></br>
      <input type="date" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance3">
    </div>
  </div>
  </br>
</div>
<div style="display:none;" class="animated flipInX" id="kid4">
  <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°4</p>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="prenom4" placeholder="Prénom"></br>
      <select name="sexe4" class="form-control">
        <option value="ND">Non défini</option>
        <option value="f">Fille</option>
        <option value="m">Garçon</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="nom4" placeholder="Nom"></br>
      <input type="date" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance4">
    </div>
  </div>
  </br>
</div>
<div style="display:none;" class="animated flipInX" id="kid5">
  <p class="raleway" style="font-size:25px;font-family:Hand;">Enfant n°5</p>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="prenom5" placeholder="Prénom"></br>
      <select name="sexe5" class="form-control">
        <option value="ND">Non défini</option>
        <option value="f">Fille</option>
        <option value="m">Garçon</option>
      </select>
    </div>
    <div class="form-group col-md-6">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="nom5" placeholder="Nom"></br>
      <input type="date" max="<?php echo date(Y).'-'.date(m).'-'.date(d); ?>" min="<?php echo date(Y)-18; ?>-01-01" class="form-control" name="naissance5">
    </div>
  </div>
  </br>
</div>
</div>
  <div align="center" id="continue" style="margin-top:1%;display:none;">
    <button type="submit" class="btn btn-success btn-lg">Continuer</button></br>
  </div>
</form>
  <div align="center">
    </br>
      <p id="sorry" style="display:none;"></br>Malheureusement, Kid'iwi ne peut pas encore supporter plus de 5 enfants par compte.</p>
      <button class="btn btn-secondary btn-lg animated bounceInDown" id="next" style="display:block;" onclick="next();">Pas maintenant</button>
      <button class="btn btn-secondary btn-lg animated fadeIn" id="add" style="display:none;" onclick="add_kid();">Ajouter un enfant</button>
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

function next() {
    location.href = "etape-4.php";
}

function add_kid() {
  var kid2 = document.getElementById("kid2");
  var kid3 = document.getElementById("kid3");
  var kid4 = document.getElementById("kid4");
  var kid5 = document.getElementById("kid5");
  if (kid4.style.display == "block") {
    kid5.style.display = "block";
    document.getElementById("add").style.display = "none";
    document.getElementById("sorry").style.display = "block";
  }
  if (kid3.style.display == "block") {
    kid4.style.display = "block";
  }
  if (kid2.style.display == "block") {
    kid3.style.display = "block";
  }
  kid2.style.display = "block";
}

function direct() {
  var nom = document.getElementById("nom1").value;
  var prenom = document.getElementById("prenom1").value;
	var next = document.getElementById("continue");
	if ((nom !== '') && (prenom !== '')) {
		next.style.display = "block";
    document.getElementById("add").style.display = "block";
    document.getElementById("next").style.display = "none";
	} else {
		next.style.display = "none";
    document.getElementById("add").style.display = "none";
    document.getElementById("next").style.display = "block";
	}
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

<?php
$_SESSION['prenom2'] = $_POST['prenom2'];
$_SESSION['nom2'] = $_POST['nom2'];
$_SESSION['email2'] = $_POST['email2'];
?>

<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); session_start();if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>

<div align="center" class="raleway animated bounceInDown" style="font-size:35px;margin-top:11%;">Bienvenue <?php echo $_POST['prenom']; ?> !</br>Souhaitez-vous ajouter un deuxième parent ?</div>

<div align="center" class="lato animated bounceInDown" style="font-size:15px;margin-top:1%;">
  <div align="center" style="margin-top:1%;">
    <div id="alert" class="alert alert-primary" role="alert" style="width:45%;height:75px;">
      <div style="display:inline-block;float:left;width:25%;">
        <img src="/public/img/later.png" width="50px" />
      </div>
      <div style="display:inline-block;float:right;width:75%;font-size:12px;" align="left">
        <p style="margin-top:15px;">Vous pourrez modifier cette information plus tard si vous le souhaitez.</p>
      </div>
    </div>
  </div>
</div>

<div id="donnees" style="width:40%;margin:auto;margin-top:2%;" class=" animated bounceInDown">
  <form action="etape-3.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" id="prenom2" name="prenom2" placeholder="Son prénom">
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" id="nom2" name="nom2" placeholder="Son nom">
      </div>
    </div>
    <div class="form-group">
      <input onkeyup="direct();direct_mail();" type="email" class="form-control" id="email2" name="email2" placeholder="Son adresse e-mail">
    </div>
  </div>
  <div align="center" style="margin-top:1%;">
    <button type="submit" class="btn btn-success btn-lg" id="continue" style="display:none;">Continuer</button>
    <button type="submit" class="btn btn-secondary btn-lg animated bounceInDown" id="later" style="display:block;">Pas maintenant</button>
  </div>
</form>
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
function direct_mail() {
	var email = document.getElementById("email2");
	if ((/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email.value)) && (email.value !== '')) {
		email.classList.remove("is-invalid");
		email.classList.add("is-valid");
		return true;
	} else {
		email.classList.add("is-invalid");
		email.classList.remove("is-valid");
		return false;
	}
}

function direct() {
  var nom = document.getElementById("nom2").value;
  var prenom = document.getElementById("prenom2").value;
	var email = document.getElementById("email2");
	var next = document.getElementById("continue");
  var later = document.getElementById("later");
	if ((direct_mail()===true) && (nom !== '') && (prenom !== '')) {
		next.style.display = "block";
    later.style.display = "none";
	} else {
		next.style.display = "none";
    later.style.display = "block";
	}
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

<?php
$_SESSION['prenom'] = $_POST['prenom'];
$_SESSION['nom'] = $_POST['nom'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['mdp'] = $_POST['mdp'];
$_SESSION['mdpr'] = $_POST['mdpr'];
$_SESSION['adresse'] = $_POST['adresse'];
$_SESSION['c_adresse'] = $_POST['c_adresse'];
$_SESSION['ville'] = $_POST['ville'];
$_SESSION['cp'] = $_POST['cp'];

$nb = 0;
$pdo = new PDO('mysql:host=localhost', 'root', 'root',
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_POST['email']."'");
while ($donnees = $req->fetch()) {
	$nb = 1;
}
$req->closeCursor();
if($nb == 1) {
  echo '<script>location.href="/public/compte/se-connecter/se-connecter.php?status=email_exist";</script>';
}
?>

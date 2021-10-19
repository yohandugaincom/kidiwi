<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php';
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $email = $donnees['email'];
  $email2 = $donnees['email_secondaire'];
  $mot_de_passe = $donnees['mot_de_passe'];
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
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/security.png" width="50px" /> <b class="align-middle">Sécurité</b></p>
    <div align="center" class="lato" style="font-size:15px;margin-top:1%;">
      <div align="center" style="margin-top:1%;">
        <div id="alert" class="alert alert-success" role="alert" style="width:45%;height:90px;">
          <div style="display:inline-block;float:left;width:25%;">
            <img src="/public/img/shield.png" width="50px" />
          </div>
          <div style="display:inline-block;float:right;width:75%;font-size:12px;" align="left">
            <p style="margin-top:5px;">Vous disposez d'un accès complet à vos données.
            </br>Vous pouvez les modifier, les consulter mais également les supprimer à tout moment.</p>
          </div>
        </div>
      </div>
    </div>
    <form method="post" action="info_connexion_maj.php">
      <p class="raleway" style="font-size:25px;">Informations de connexion</p>
      <?php
      if ($_SESSION['role']=="parents") {
        echo '<p class="raleway" style="font-size:20px;">Parent 1</p>';
      }
       ?>
      <div class="form-group">
        <input disabled type="email" class="form-control" value="<?php echo $email; ?>" placeholder="Mon adresse e-mail">
      </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct();" type="password" class="form-control" name="nmdp" id="nmdp" placeholder="Mon nouveau mot de passe">
        <small class="form-text text-muted">
        Votre mot de passe doit comporter au moins 6 caractères dont un chiffre et une lettre.
      </small>
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct();" type="password" class="form-control" name="nmdpr" id="nmdpr" placeholder="Répétez votre nouveau mot de passe">
      </div>
    </div>
    <?php
    if ($_SESSION['role']=="parents") {
      echo '<p class="raleway" style="font-size:20px;">Parent 2</p>
      <div class="form-group">
        <input onkeyup="direct_mail(this);" type="email" class="form-control" value="'.$email2.'" name="email2" id="email2" placeholder="Son adresse e-mail">
      </div>';
    }
     ?>
  <hr style="width:80%">
  <div style="margin-bottom:2%;" align="right">
      <input onkeyup="direct();" style="display:inline-block;width:30%;vertical-align:-2px;" type="password" class="form-control" name="mdp" id="mdp" placeholder="Mon mot de passe actuel">
      <button disabled id="continue" type="submit" class="btn btn-success" style="margin-left:1%;margin-right:1%;">Mettre à jour</button>
      <a href="/public/compte/prive/mon-compte.php"><button type="button" class="btn btn-dark" style="margin-right:1%;">Annuler</button></a>
  </div>
  </div>
  </form>
  </div>

</div>
<script>
function direct_empty(x) {
  if (x.value !== '') {
    x.classList.remove("is-invalid");
    x.classList.add("is-valid");
    return true;
  } else {
    x.classList.add("is-invalid");
    x.classList.remove("is-valid");
    return false;
  }
}
function direct_mail(x) {
	var email = x;
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
function direct_psw() {
	var psw = document.getElementById("nmdp");
	if ((psw.value.length > 5) && ( /[a-zA-Z]+[0-9]+|[0-9]+[a-zA-Z]+/.test(psw.value))) {
		psw.classList.remove("is-invalid");
		psw.classList.add("is-valid");
		return true;
	} else {
		psw.classList.add("is-invalid");
		psw.classList.remove("is-valid");
		return false;
	}
}

function direct_apsw() {
	var psw = document.getElementById("nmdp");
	var apsw = document.getElementById("nmdpr");
	if ((psw.value!=='') && (apsw.value!=='') && (psw.value===apsw.value)) {
		apsw.classList.remove("is-invalid");
		apsw.classList.add("is-valid");
		return true;
	} else {
		apsw.classList.add("is-invalid");
		apsw.classList.remove("is-valid");
		return false;
	}
}
function direct_npsw() {
  if (document.getElementById('mdp').value !== '') {
    document.getElementById('mdp').classList.remove("is-invalid");
    document.getElementById('mdp').classList.add("is-valid");
    return true;
  } else {
    document.getElementById('mdp').classList.add("is-invalid");
    document.getElementById('mdp').classList.remove("is-valid");
    return false;
  }
}
function direct() {
	var email = document.getElementById("email");
	var psw = document.getElementById("nmdp");
	var apsw = document.getElementById("nmdpr");
	var next = document.getElementById("continue");
	if ((((direct_psw()===true) && (direct_apsw()===true)) || ((psw.value=='') && (apsw.value==''))) && (direct_npsw()===true)) {
		next.disabled = false;
	} else {
		next.disabled = true;
	}
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

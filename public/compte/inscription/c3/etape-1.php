<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
session_destroy();
session_start();
if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>

<div align="center" class="raleway animated bounceInDown" style="font-size:35px;margin-top:8%;">Parfait, complétons ensemble quelques informations</br>vous concernant.</div>

<div align="center" class="lato animated bounceInDown" style="font-size:15px;margin-top:1%;">
  <div align="center" style="margin-top:1%;">
    <div id="alert" class="alert alert-success" role="alert" style="width:45%;height:75px;">
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

<div id="donnees" style="width:40%;margin:auto;margin-top:2%;" class=" animated bounceInDown">
  <form action="confirmer_adresse.php" method="post">
    <div class="form-row">
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="prenom" id="prenom" placeholder="Mon prénom">
      </div>
      <div class="form-group col-md-6">
        <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="nom" id="nom" placeholder="Mon nom">
      </div>
    </div>
    <div class="form-group">
      <input onkeyup="direct();direct_mail();" type="email" class="form-control" name="email" id="email" placeholder="Mon adresse e-mail">
    </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <input onkeyup="direct();" type="password" class="form-control" name="mdp" id="mdp" placeholder="Mon mot de passe">
      <small class="form-text text-muted">
      Votre mot de passe doit comporter au moins 6 caractères dont un chiffre et une lettre.
    </small>
    </div>
    <div class="form-group col-md-6">
      <input onkeyup="direct();" type="password" class="form-control" name="mdpr" id="mdpr" placeholder="Répétez votre mot de passe">
    </div>
  </div>
  <div class="form-group">
    <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="adresse" id="adresse" placeholder="Mon adresse">
  </div>
  <div class="form-group">
    <input type="text" class="form-control" name="c_adresse" name="c_adresse" placeholder="Mon complément d'adresse (facultatif)">
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <input onkeyup="direct();direct_empty(this);" type="text" class="form-control" name="ville" id="ville" placeholder="Ma ville">
    </div>

    <div class="form-group col-md-4">
      <input onkeyup="direct();direct_empty(this);direct_region(this.value.substr(0,2));" type="text" class="form-control" id="cp" name="cp" placeholder="Mon code postal">
    </div>
    <div class="form-group col-md-4">
      <select id="region" name="region" class="form-control" disabled>
        <option value="0" selected>Région automatique</option>
        <option value="1">Île-de-France</option>
        <option value="2">Auvergne-Rhône-Alpes</option>
        <option value="3">Bourgogne-Franche-Comté</option>
        <option value="4">Bretagne</option>
        <option value="5">Centre-Val de Loire</option>
        <option value="6">Corse</option>
        <option value="7">Grand Est</option>
        <option value="8">Hauts-de-France</option>
        <option value="9">Normandie</option>
        <option value="10">Nouvelle-Aquitaine</option>
        <option value="11">Occitanie</option>
        <option value="12">Pays de la Loire</option>
        <option value="13">Provence-Alpes-Côte d'Azur</option>
        <option value="14">Guadeloupe</option>
        <option value="15">Guyane</option>
        <option value="16">La Réunion</option>
        <option value="17">Martinique</option>
        <option value="18">Mayotte</option>
      </select>
    </div>
  </div>
  <div align="center" style="margin-top:1%;">
    <button type="submit" class="btn btn-success btn-lg" id="continue" style="display:none;">Continuer</button>
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
	var email = document.getElementById("email");
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
	var psw = document.getElementById("mdp");
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
	var psw = document.getElementById("mdp");
	var apsw = document.getElementById("mdpr");
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

function direct_region(x) {
  document.getElementById('region').value = "0";
  if ((x === "01") || (x==="03") || (x==="07") || (x==="15") || (x==="26") || (x==="38") || (x==="42") || (x==="43") || (x==="69") || (x==="63") || (x==="73") || (x==="74")) {
    document.getElementById('region').value = "2";
  }
  if ((x === "91") || (x==="92") || (x==="93") || (x==="94") || (x==="95") || (x==="75") || (x==="77") || (x==="78")) {
    document.getElementById('region').value = "1";
  }
  if ((x === "21") || (x==="25") || (x==="39") || (x==="58") || (x==="70") || (x==="71") || (x==="89") || (x==="90")) {
    document.getElementById('region').value = "3";
  }
  if ((x === "22") || (x==="29") || (x==="35") || (x==="56")) {
    document.getElementById('region').value = "4";
  }
  if ((x === "18") || (x==="28") || (x==="36") || (x==="37") || (x==="41") || (x==="45")) {
    document.getElementById('region').value = "5";
  }
  if ((x === "2A") || (x==="2B")) {
    document.getElementById('region').value = "6";
  }
  if ((x === "08") || (x==="10") || (x==="51") || (x==="52") || (x==="54") || (x==="55") || (x==="57") || (x==="67") || (x==="68") || (x==="88")) {
    document.getElementById('region').value = "7";
  }
  if ((x === "02") || (x==="59") || (x==="60") || (x==="62") || (x==="80")) {
    document.getElementById('region').value = "8";
  }
  if ((x === "14") || (x==="27") || (x==="50") || (x==="61") || (x==="76")) {
    document.getElementById('region').value = "9";
  }
  if ((x === "16") || (x==="17") || (x==="19") || (x==="23") || (x==="24") || (x==="33") || (x==="40") || (x==="47") || (x==="64") || (x==="79") || (x==="86") || (x==="87")) {
    document.getElementById('region').value = "10";
  }
  if ((x === "09") || (x==="11") || (x==="12") || (x==="30") || (x==="31") || (x==="32") || (x==="34") || (x==="46") || (x==="48") || (x==="65") || (x==="66") || (x==="81") || (x==="82")) {
    document.getElementById('region').value = "11";
  }
  if ((x === "44") || (x==="49") || (x==="53") || (x==="72") || (x==="85")) {
    document.getElementById('region').value = "12";
  }
  if ((x === "04") || (x==="05") || (x==="06") || (x==="13") || (x==="83") || (x==="84")) {
    document.getElementById('region').value = "13";
  }
  if ((x === "97")) {
    if (document.getElementById('cp').value.substr(0,3) === "971") {
      document.getElementById('region').value = "14";
    }
    if (document.getElementById('cp').value.substr(0,3) === "972") {
      document.getElementById('region').value = "17";
    }
    if (document.getElementById('cp').value.substr(0,3) === "973") {
      document.getElementById('region').value = "15";
    }
    if (document.getElementById('cp').value.substr(0,3) === "974") {
      document.getElementById('region').value = "16";
    }
    if (document.getElementById('cp').value.substr(0,3) === "975") {
      document.getElementById('region').value = "18";
    }
  }
}

function direct() {
  var nom = document.getElementById("nom").value;
  var prenom = document.getElementById("prenom").value;
  var adresse = document.getElementById("adresse").value;
  var ville = document.getElementById("ville").value;
  var cp = document.getElementById("cp").value;
  var region = document.getElementById("region").value;
	var email = document.getElementById("email");
	var psw = document.getElementById("psw1");
	var apsw = document.getElementById("psw2");
	var next = document.getElementById("continue");
	if ((direct_mail()===true) && (direct_psw()===true) && (direct_apsw()===true) && (nom !== '') && (prenom !== '') && (ville !== '') && (adresse !== '') && (cp !== '') && (region !== "Région automatique")) {
		next.style.display = "block";
	} else {
		next.style.display = "none";
	}
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

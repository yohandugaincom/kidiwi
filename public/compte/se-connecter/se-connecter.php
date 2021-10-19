<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
	overflow-x: hidden;
}
.navbar {
	color: #fff;
	background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
}


@-webkit-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@-moz-keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}

@keyframes Gradient {
	0% {
		background-position: 0% 50%
	}
	50% {
		background-position: 100% 50%
	}
	100% {
		background-position: 0% 50%
	}
}
</style>
<div align="center" style="font-size:35px;margin-top:15%;">
<p class="raleway"><span class="animated fadeIn" style="margin-top:10px;font-family:'Hand';color:white;font-size:50px;text-shadow: 1px 1px 3px black;">
<img src="/public/img/origami.png" width="100px" style="vertical-align: -15px;" />
   Kid'iwi</span></br>

<span id="message" class="animated fadeIn" style="font-size:15px;font-family:Arial;display:<?php if (isset($_GET['status'])) {echo 'block';}else{echo 'none';} ?>">
  <div id="status" class="raleway" style="font-size:15px;">
    <?php
    if ($_GET['status'] == "email_exist") {
      echo 'Désolé, cette adresse e-mail est déjà associée à un compte.';
    }
    if ($_GET['status'] == "deconnecte") {
      echo 'Vous avez bien été déconnecté.';
    }
    ?>
  </div>
</span>

<div align="center" class="animated fadeIn" style="width:30%;margin-top:1%;">
      <div class="form-group">
        <input style="font-size:20px;" onkeyup="direct();direct_mail();" type="email" class="form-control" id="email" name="email" placeholder="Mon adresse e-mail">
      </div>
      <div class="form-group">
        <input style="font-size:20px;" onkeyup="direct();" type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Mon mot de passe">
      </div>
    </div>
    <div align="center" style="margin-top:1%;">
      <button onclick="connect();" class="btn btn-light btn-lg animated fadeIn" id="continue" style="display:none;">Se connecter</button>
    </div>
</div>
</div>

<script>
$(document).on('keypress',function(e) {
    if(e.which == 13) {
        connect();
    }
});
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
function direct() {
	var next = document.getElementById("continue");
	if ((direct_mail()==true)) {
		next.style.display = "block";
	} else {
		next.style.display = "none";
	}
}
function connect() {
  var email = document.getElementById("email");
  var password = document.getElementById("mot_de_passe").value;
  var status = document.getElementById("status");
  const req = new XMLHttpRequest();
  req.open('GET', '/public/compte/se-connecter/connexion.php?email=' + email.value + '&password=' + password, false);
  req.send(null);
  if (req.status === 200) {
      if (req.responseText=="true") {
        location.href="/public/compte/prive/mon-compte.php";
      }
      if (req.responseText=="false") {
        message.style.display = "block";
        status.innerHTML = "Vos informations de connexion ne sont pas correctes.";
      }
      if (req.responseText=="non_active") {
        message.style.display = "block";
        status.innerHTML = "Votre compte n'est toujours pas activé.";
      }
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; session_destroy(); ?>

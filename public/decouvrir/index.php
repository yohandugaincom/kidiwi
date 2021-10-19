<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	<?php if ($theme=="sombre") {
	  echo 'background: linear-gradient(-45deg, #2f3640, #218c74, #353b48, #009432);';
	} else {
		echo 'background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);';
	}
	?>
	background-size: 400% 400%;
	-webkit-animation: Gradient 15s ease infinite;
	-moz-animation: Gradient 15s ease infinite;
	animation: Gradient 15s ease infinite;
	overflow-x: hidden;
}
.navbar {
	color: #fff;
	<?php if ($theme=="sombre") {
	  echo 'background: linear-gradient(-45deg, black);';
	} else {
		echo 'background: linear-gradient(-45deg, #3498db, #2ecc71, #27ae60, #2980b9);';
	}
	?>
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
<div align="center" style="position: absolute;top: 50%;transform: translateY(-50%);">
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="/public/img/accueil1.png" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="/public/img/accueil2.png" class="d-block w-100">
      </div>
      <div class="carousel-item">
        <img src="/public/img/accueil3.png" class="d-block w-100">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Suivant</span>
    </a>
    <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Précèdent</span>
    </a>
  </div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

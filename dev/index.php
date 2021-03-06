<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); ?><!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="icon" type="image/png" href="/public/img/origami.png" />
    <title>Kid'iwi</title>
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <link rel="stylesheet" type="text/css" href="/public/css/default.css">
<style>
body {
	width: 100wh;
	height: 90vh;
	color: #fff;
	background: linear-gradient(-45deg, black<?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {echo ',#2ecc71';} else {echo ',#d35400';} ?>);
	background-size: 300% 300%;
	-webkit-animation: Gradient 10s ease infinite;
	-moz-animation: Gradient 10s ease infinite;
	animation: Gradient 10s ease infinite;
	overflow-x: hidden;
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
  </head>
  <body>
<div align="center" style="font-size:35px;margin-top:12%;">
<p class="raleway"><span class="animated fadeIn" style="margin-top:10px;font-family:'Hand';color:white;font-size:50px;text-shadow: 1px 1px 3px black;">
<img src="/public/img/origami.png" width="100px" style="vertical-align: -15px;" /> Kid'iwi</span></br>
   <span id="status" class="animated fadeIn slower">Kidiwi/dev</span></p>
   <p style="font-size:18px;" class="animated fadeIn"><?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {echo "??tat du site : Actif";} else {echo "??tat du site : Inactif";} ?></p>
   <div id="fin" align="center" class="animated fadeIn" style="margin-top:1%;">
     <?php if (!file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {echo '<a href="/dev/install.php"><button class="btn btn-light btn-lg">Installer</button></a>';} ?>
     <?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {echo '<a href="/dev/reinitialiser.php"><button class="btn btn-danger btn-lg">R??initialiser</button></a>';} ?>
     <?php if (file_exists($_SERVER['DOCUMENT_ROOT']."/dev/active.kidiwi")) {echo '<a href="/dev/demo.php"><button class="btn btn-secondary btn-lg">Version d??mo</button></a>';} ?>
     <button type="button" class="btn btn-secondary btn-lg" data-toggle="modal" data-target=".bd-example-modal-lg">path_info</button>
   </div>
   <a href="/public" target="_blank"><button class="btn btn-light btn-lg animated pulse infinite" style="margin-top:3%;">Ouvrir /public</button></a>
</div>

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" style="color:black !important;padding:10px;">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      <h3 class="modal-title">path_info</h3>
      <div class="modal-body">
        <?php include($_SERVER['DOCUMENT_ROOT']."/dev/path_info.php"); ?>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <body>
  </html>

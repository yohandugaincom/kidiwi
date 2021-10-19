<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
#map {
    height: 550px;
}
.marker {
  background-image: url('/public/img/marker.png');
  background-size: cover;
  width: 40px;
  height: 55px;
  cursor: pointer;
}
</style>
<div align="center" style="margin-top:7%;">
  <nav class="nav nav-pills flex-column flex-sm-row" style="width:80%;">
    <a class="flex-sm-fill text-sm-center nav-link" style="color:#27ae60;border:1px solid #27ae60;margin-right:1%;" href="/public/rechercher/recherche.php">Retour</a>
    <a class="flex-sm-fill text-sm-center nav-link active" style="background-color:#27ae60 !important;" href="/public/rechercher/carte_interactive.php">Carte interactive</a>
  </nav>
</div>
<div style="margin-top:1%;margin-left:2%;margin-right:2%;overflow-y:scroll;">
  <div id="map">
  </div>
</div>

<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<script>
document.getElementById('chargement').style.display = "block";
var lat = 48.864716;
var long = 2.349014;

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/interactive_data.php'; ?>

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(showPosition);
} else {
  alert("La localisation n'est pas supportée par ce navigateur.");
  document.getElementById('chargement').style.display = "none";
}

function showPosition(position) {
  lat = position.coords.latitude;
  long = position.coords.longitude;
  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/interactive_data.php'; ?>
  document.getElementById('chargement').style.display = "none";
}


</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

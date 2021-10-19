<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
#map { width:100%;height: 400px; }
</style>
<div align="center" class="raleway animated bounceInDown" style="font-size:35px;margin-top:8%;">Super, confirmez la localisation de votre établissement.</div>
</br>
<div class="animated bounceInDown" id='map'></div>
<div align="center" style="margin-top:1%;">
  <a href="etape-2.php"><button class="btn btn-success btn animated bounceInDown">Je confirme</button></a>
    <button class="btn btn-secondary btn animated bounceInDown" onclick="window.history.back();">Je rectifie l'adresse</button>
</div>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<script>
  mapboxgl.accessToken = 'pk.eyJ1IjoieW9oYW5kdWdhaW4iLCJhIjoiY2p3M25sMGRnMTVrMTRja3RjdGY0YnlpYiJ9.gMbdo0jOSMJg0Dq8ClZJnw';

  var adresse = "<?php echo $_POST['adresse'].', '.$_POST['c_adresse'].', '.$_POST['ville'].', '.$_POST['cp']; ?>";
  adresse = escape(adresse);
  var request = new XMLHttpRequest();
  request.open("GET", "http://www.mapquestapi.com/geocoding/v1/address?maxResults=1&key=wsJZ523rBfhlDPKaTpijUAU6YA5fcnVB&location=" + adresse + "+France", false);
  request.send(null);
  var my_JSON_object = JSON.parse(request.responseText);

  var map = new mapboxgl.Map({
    container: 'map',
    style: 'mapbox://styles/mapbox/streets-v11',
    center: [my_JSON_object.results[0].locations[0].latLng.lng, my_JSON_object.results[0].locations[0].latLng.lat],
    zoom: 15
  });

  map.loadImage('/public/img/marker.png', function(error, image) {
  if (error) throw error;
    map.addImage('cat', image);
    map.addLayer({
    "id": "1",
    "type": "symbol",
    "source": {
      "type": "geojson",
      "data": {
        "type": "FeatureCollection",
        "features": [{
          "type": "Feature",
          "geometry": {
            "type": "Point",
            "coordinates": [my_JSON_object.results[0].locations[0].latLng.lng, my_JSON_object.results[0].locations[0].latLng.lat]
          }
        }]
      }
    },
    "layout": {
      "icon-image": "cat",
      "icon-size": 0.7
    }
  });
  });
</script>
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
<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

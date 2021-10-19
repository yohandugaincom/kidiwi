<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<style>
.checked {
  color: #27ae60;
}
#map { width:100%;height: 250px; }
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/event.png" width="50px" /> <b class="align-middle">Créer un évènement</b></p>

    <form method="post" action="/public/compte/prive/creation-evenement.php" enctype="multipart/form-data">
      <p class="raleway" style="font-size:30px;">Informations générales</p>
      <div class="form-group">
        <label>Titre de l'évènement</label>
        <input required onkeyup="direct_empty(this);" type="text" class="form-control" id="titre" name="titre" placeholder="Nom de l'activité">
      </div>
      <div class="form-group">
        <label>Thème de l'activité</label>
        <select class="form-control" id="theme" name="theme">
          <option value="scolaire">Actvités scolaires</option>
          <option value="gastronomie">Gastronomie</option>
          <option value="creatif">Loisirs créatifs</option>
          <option value="maison">Maison et mode de vie</option>
          <option value="beaute">Mode et beauté</option>
          <option value="sante">Santé et Bien-être</option>
          <option value="science">Sciences et technologies</option>
          <option value="exterieur">Activité de plein air</option>
          <option value="bienfaisance">Oeuvre de bienfaisance</option>
        </select>
      </div>
      <div class="form-group">
        <label>Prix de l'activité</label></br>
        <input required onkeyup="direct_empty(this);" type="number" class="form-control form-control-lg" id="prix" name="prix" min="0" max="99" style="font-size:30px;display:inline-block;width:150px;margin-right:2%;">
        <span class="raleway" style="display:inline-block;font-size:30px;"> euros (€)</span>
      </div>
      <div class="form-group">
        <label>Capacité de l'évènement</label></br>
        <input required onkeyup="direct_empty(this);" type="number" class="form-control form-control-lg" id="places_max" name="places_max" min="0" max="99" style="font-size:30px;display:inline-block;width:150px;margin-right:2%;">
        <span class="raleway" style="display:inline-block;font-size:30px;"> enfants maximum</span>
      </div>
      <div class="form-group">
        <label>Tranche d'âge</label></br>
        <input required onkeyup="direct_empty(this);" type="number" class="form-control form-control-lg" id="age_min" name="age_min" min="0" max="18" style="font-size:30px;display:inline-block;width:150px;margin-right:2%;">
        <span class="raleway" style="display:inline-block;font-size:30px;"> - </span>
        <input required onkeyup="direct_empty(this);" type="number" class="form-control form-control-lg" id="age_max" name="age_max" min="0" max="99" style="font-size:30px;display:inline-block;width:150px;margin-right:2%;">
        <span class="raleway" style="display:inline-block;font-size:30px;"> ans</span>
      </div>
      <div class="form-group">
        <label>Date et heure de l'évènement</label></br>
        <input required onkeyup="direct_empty(this);" style="display:inline-block;width:40%;" min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>" type="date" class="form-control" id="date" name="date">
        <input required onkeyup="direct_empty(this);" style="display:inline-block;width:40%;" value="<?php echo date("H:i"); ?>" type="time" class="form-control" id="heure" name="heure">
      </div>
      <p class="raleway" style="font-size:30px;margin-top:2%;">Présentation de l'activité</p>
      <div class="form-group">
        <label>Description détaillée</label>
        <textarea required onkeyup="direct_empty(this);" class="form-control" id="description" name="description" rows="5"></textarea>
      </div>
      <div class="form-group">
        <label>Image 1</label></br>
        <input name="file1" id="file1" type="file">
      </div>
      <div class="form-group">
        <label>Image 2</label></br>
        <input name="file2" id="file2" type="file">
      </div>
      <div class="form-group">
        <label>Image 3</label></br>
        <input name="file3" id="file3" type="file">
      </div>
      <p class="raleway" style="font-size:30px;margin-top:2%;">Lieu de l'évènement</p>
      <div class="form-group">
        <label>Adresse de l'évènement</label></br>
        <input required onkeyup="direct_empty(this);" type="text" class="form-control" style="display:inline-block;width:50%;" id="adresse" name="adresse" placeholder="Adresse complète de l'évènement">
        <span id="verifier" class="btn btn-success" onclick="document.getElementById('valider').style.display='block';" style="display:inline-block;cursor:pointer;">Vérifier l'adresse</span><span id="lieu" class="btn btn-secondary" style="display:inline-block;cursor:pointer;margin-left:1%;">Trouver un lieu</span>
      </div>
      <div id='map'></div></br>
      <input id="longitude" name="longitude" type="hidden" value="0" />
      <input id="latitude" name ="latitude" type="hidden" value="0" />
      <button type="submit" id="valider" class="btn btn-success animated fadeIn" style="display:none;cursor:pointer;width:100%;">Continuer</button>
    </form>

  </div>

</div>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
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

mapboxgl.accessToken = 'pk.eyJ1IjoieW9oYW5kdWdhaW4iLCJhIjoiY2p3M25sMGRnMTVrMTRja3RjdGY0YnlpYiJ9.gMbdo0jOSMJg0Dq8ClZJnw';

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [2.349014, 48.864716],
  zoom: 15
});

function makeid(length) {
   var result           = '';
   var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
   var charactersLength = characters.length;
   for ( var i = 0; i < length; i++ ) {
      result += characters.charAt(Math.floor(Math.random() * charactersLength));
   }
   return result;
}

var layer = makeid(5);

$( "#verifier" ).click(function() {
    map.removeLayer(layer);
    layer = makeid(5);
    var adresse = document.getElementById("adresse").value;
    adresse = escape(adresse);
    var request = new XMLHttpRequest();
    request.open("GET", "http://www.mapquestapi.com/geocoding/v1/address?maxResults=1&key=wsJZ523rBfhlDPKaTpijUAU6YA5fcnVB&location=" + adresse + "+France", false);
    request.send(null);
    var my_JSON_object = JSON.parse(request.responseText);
    map.flyTo({
      center: [my_JSON_object.results[0].locations[0].latLng.lng, my_JSON_object.results[0].locations[0].latLng.lat]
    });
    document.getElementById('longitude').value = my_JSON_object.results[0].locations[0].latLng.lng;
    document.getElementById('latitude').value = my_JSON_object.results[0].locations[0].latLng.lat;
    map.loadImage('/public/img/marker.png', function(error, image) {
    if (error) throw error;
      map.addImage('cat', image);
      map.addLayer({
      "id": layer,
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
});

</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

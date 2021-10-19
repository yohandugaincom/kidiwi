<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>
<?php
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE `id`='".$_GET['id']."'");
while ($donnees = $req->fetch())
{
  $email_presentation = $donnees['email'];
  $titre = $donnees['titre'];
  $theme = $donnees['theme'];
  $prix = $donnees['prix'];
  $places_max = $donnees['places_max'];
  $age_min = $donnees['age_min'];
  $age_max = $donnees['age_max'];
  $date = $donnees['date'];
  $description = $donnees['description'];
  $adresse = $donnees['adresse'];
  $longitude = $donnees['longitude'];
  $latitude = $donnees['latitude'];
  $active = $donnees['active'];
  $image1 = $donnees['image1'];
  $image2 = $donnees['image2'];
  $image3 = $donnees['image3'];
  $liste_inscrits = $donnees['liste_inscrits'];
}
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$email_presentation."'");
while ($donnees = $req->fetch())
{
  $prenom = $donnees['prenom'];
  $nom = $donnees['nom'];
  $role = $donnees['role'];
  $note = $donnees['note'];
}
$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$email_presentation."'");
while ($donnees = $req->fetch())
{
  $note_presentation = $donnees['note'];
}
$req->closeCursor();
if ($role == "parents") {
  $role = "Particulier";
}
$inscrits = explode(",", $liste_inscrits);
$inscrits_affiche = "";
$num_inscrits = -1;
foreach($inscrits as $id_enfant) {
    if ($num_inscrits <> count($inscrits)-2) {
      $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `id`='".$id_enfant."'");
      while ($donnees = $req->fetch())
      {
        $prenom_enfant = $donnees['prenom'];
        $email_e = $donnees['email'];
        $age1 = date('Y') - date('Y', strtotime($donnees['date_naissance']));
        if (date('md') < date('md', strtotime($donnees['date_naissance']))) {
          $age1 = $age1 - 1;
        }
        $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$donnees['email']."'");
        while ($donnees1 = $req1->fetch())
        {
          $prenom_parent = $donnees1['prenom'];
        }
      }
      $inscrits_affiche = ($num_inscrits+2)." - <a href='/public/compte/prive/messagerie-nouveau.php?email=".$email_e."&objet=[".$titre."][Enfant : ".$prenom_enfant."]' target='_blank'><b>".$prenom_parent."</b></a> a inscrit <b>".$prenom_enfant." (".$age1." ans)</b> à cette activité.</br>".$inscrits_affiche;
    }
    $num_inscrits = $num_inscrits + 1;
}
$liste_enfants = "";
$btn_continue = "";
$req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $present = false;
  foreach($inscrits as $id_enfant) {
    if ($id_enfant == $donnees['id']) {
      $present = true;
    }
  }
  if ($present == false) {
    $prenom_e = $donnees['prenom'];
    $nom_e = $donnees['nom'];
    $ddn = $donnees['date_naissance'];
    // calcul de l'âge de l'enfant
    $age = date('Y') - date('Y', strtotime($ddn));
    if (date('md') < date('md', strtotime($ddn))) {
    $age = $age - 1;
    }
    if (($age>$age_max) || ($age<$age_min)) {
      $liste_enfants = "<option disabled>".$prenom_e." ".$nom_e." (activité inadaptée)</option>".$liste_enfants;
    } else {
      $liste_enfants = "<option value='".$donnees['id']."'>".$prenom_e." ".$nom_e."</option>".$liste_enfants;
      $btn_continue = '<button type="submit" class="btn btn-success">Continuer</button>';
    }
  } else {
    $prenom_e = $donnees['prenom'];
    $nom_e = $donnees['nom'];
    $liste_enfants = "<option disabled>".$prenom_e." ".$nom_e." (déjà inscrit)</option>".$liste_enfants;
  }
}
if ($image1 <> '') {
  $image1 = '<div class="carousel-item active">
    <img src="/public/activite/img/'.$image1.'" class="d-block w-100" alt="Image de présentation">
  </div>';
  $i1 = '<li data-slide-to="0" class="active"></li>';
}
if ($image2 <> '') {
  $image2 = '<div class="carousel-item">
    <img src="/public/activite/img/'.$image2.'" class="d-block w-100" alt="Image de présentation">
  </div>';
  $i2 = '<li data-slide-to="1"></li>';
}
if ($image3 <> '') {
  $image3 = '<div class="carousel-item">
    <img src="/public/activite/img/'.$image3.'" class="d-block w-100" alt="Image de présentation">
  </div>';
  $i3 = '<li data-slide-to="2"></li>';
}
$email_presentation_f = str_replace("@", "AT", $email_presentation);
$email_presentation_f = str_replace(".", "DOT", $email_presentation_f);
$email_presentation_f = str_replace("-", "T", $email_presentation_f);
if (file_exists($_SERVER['DOCUMENT_ROOT']."/public/compte/avatar/".$email_presentation_f.".png")) {
    $avatar_presentation = "/public/compte/avatar/".$email_presentation_f.".png";
} else {
    $avatar_presentation = "/public/img/profil.png";
}
 ?>
<style>
.checked {
  color: #27ae60;
}
#map { width:100%;height: 300px; }
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <div class="fondcolor" style="float:left;width:25%;display:inline-block;padding:2%;position:fixed;">
    <div align="center"><p style="font-size:18px;" class="badge badge-secondary"><?php echo $role; ?></p></br>
      <img src="<?php echo $avatar_presentation; ?>" width="150px" style="border-radius:50%;"/></br>
      <p class="raleway" style="font-size:30px;"><?php echo $prenom.' '.$nom; ?></br>
        <span class="fa fa-star<?php if ($note_presentation>=1) { echo " checked"; } ?>"></span>
        <span class="fa fa-star<?php if ($note_presentation>=2) { echo " checked"; } ?>"></span>
        <span class="fa fa-star<?php if ($note_presentation>=3) { echo " checked"; } ?>"></span>
        <span class="fa fa-star<?php if ($note_presentation>=4) { echo " checked"; } ?>"></span>
        <span class="fa fa-star<?php if ($note_presentation==5) { echo " checked"; } ?>"></span></p>
      <div class="progress" style="height: 25px;">
        <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?php echo intval($num_inscrits/$places_max*100); ?>%;color:black;" aria-valuemin="0" aria-valuemax="100">
          <span style="margin-left:10px;"><b><?php echo ($places_max-$num_inscrits); ?> places restantes</b></span>
        </div>
      </div></br>
      <?php if ($email_presentation == $_SESSION['email']) {
              if ($active == "non") {
                echo '<a href="/public/compte/prive/publier-evenement.php?id='.$_GET['id'].'"><button id="reserve" type="button" class="btn btn-success">Publier</button></a>
                <a href="/public/compte/prive/supprimer-evenement.php?id='.$_GET['id'].'"><button type="button" class="btn btn-danger">Supprimer</button></a>';
              } else {
                echo '<a href="/public/compte/prive/desactiver-evenement.php?id='.$_GET['id'].'"><button type="button" class="btn btn-warning">Désactiver</button></a>
                <button id="reserve" type="button" class="btn btn-secondary" data-toggle="modal" data-target="#reservations">Voir les réservations</button>';
              }
            } else {
              if (isset($_SESSION['connecte'])) {
                if ($num_inscrits == $places_max) {
                  echo '<button type="button" class="btn btn-success" data-toggle="modal" disabled>C\'est complet !</button>
                  <a href="/public/compte/prive/messagerie-nouveau.php?email='.$email_presentation.'&objet=['.$titre.']"><button id="reserve" type="button" class="btn btn-secondary">Contacter</button></a>';
                } else {
                  if ($active == "non") {
                    echo 'La réservation a été temporairement désactivée.</br></br><a href="/public/compte/prive/messagerie-nouveau.php?email='.$email_presentation.'&objet=['.$titre.']"><button id="reserve" type="button" class="btn btn-secondary">Contacter</button></a>';
                  } else {
                    if ($_SESSION['role']=="parents") {
                      echo '<button id="reserve" type="button" class="btn btn-success" data-toggle="modal" data-target="#reservations">Je réserve</button>
                      <a href="/public/compte/prive/messagerie-nouveau.php?email='.$email_presentation.'&objet=['.$titre.']"><button type="button" class="btn btn-secondary">Contacter</button></a>';
                    } else {
                      echo'<a href="/public/compte/prive/messagerie-nouveau.php?email='.$email_presentation.'&objet=[PRO]['.$titre.']"><button type="button" class="btn btn-secondary">Contacter</button></a>';
                    }
                  }
                }
              } else {
                echo 'Connectez-vous pour réserver cette activité.';
              }
            }
      ?>
    </div>
  </div>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><span class="badge badge-dark"><?php echo $prix; ?>€</span> <b><?php echo $titre; ?></b></p>

    <div class="bd-example">
    <div id="presentation" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php echo $i1.$i2.$i3; ?>
      </ol>
      <div class="carousel-inner">
        <?php echo $image1.$image2.$image3; ?>
      </div>
      <a class="carousel-control-prev" href="#presentation" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Précédent</span>
      </a>
      <a class="carousel-control-next" href="#presentation" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Suivant</span>
      </a>
    </div>
  </div>
</br>
<p class="raleway" style="font-size:25px;margin-bottom:2%;">Information détaillée</p>
<p class="lato" style="font-size:15px;text-align:justify;"><?php echo $description; ?></p>
</br>
    <p><span class="lato" style="font-size:50px;"><img src="/public/img/count.png" width="50px" /> <?php echo $places_max.' enfants'; ?></span>
    <span class="lato" style="font-size:50px;margin-left:5%;"><img src="/public/img/age.png" width="50px" /> <?php echo $age_min.' - '.$age_max.' ans'; ?></span></p>
</br>
    <p class="lato" style="font-size:50px;"><img src="/public/img/time.png" width="50px" /> <?php setlocale(LC_TIME, "fr_FR"); echo strftime("%A %d %B %Y à %H:%M", strtotime($date)); ?></p>
</br>
    <p class="lato" style="font-size:30px;"><img src="/public/img/map.png" width="50px" /> <?php echo $adresse; ?></p>
    <div id='map'></div>
  </div>
</div>
<?php
if ($email_presentation == $_SESSION['email']) {
  echo '<div class="modal fade" id="reservations" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content fondcolorcard">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Réservation pour cet évènement</h5>
        <button type="button" class="close icon" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        '.$inscrits_affiche.'
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>';
} else {
  echo '<div class="modal fade" id="reservations" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content fondcolorcard">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Réserver pour cet évènement</h5>
        <button type="button" class="close icon" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="post" action="/public/compte/prive/reservation-evenement.php">
          <div class="form-group">
            <label>Pour quel enfant souhaitez-vous réserver cette activité ?</label>
            <select class="form-control" id="enfant" name="enfant">
              '.$liste_enfants.'
            </select>
          </div>
          <input type="hidden" name="id" value="'.$_GET['id'].'" />
          <input type="hidden" name="titre" value="'.$titre.'" />
      </div>
      <div class="modal-footer">
        '.$btn_continue.'
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
      </form>
    </div>
  </div>
</div>';
}
?>
<script src='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.js'></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v0.53.1/mapbox-gl.css' rel='stylesheet' />
<script>
$(function() {
  setInterval(function() {
    var animationName = 'animated pulse';
    var animationend = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
    $('#reserve').addClass(animationName).one(animationend, function() {
      $(this).removeClass(animationName);
    });
  }, 5000);
});
mapboxgl.accessToken = 'pk.eyJ1IjoieW9oYW5kdWdhaW4iLCJhIjoiY2p3M25sMGRnMTVrMTRja3RjdGY0YnlpYiJ9.gMbdo0jOSMJg0Dq8ClZJnw';

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

var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [<?php echo $longitude; ?>, <?php echo $latitude; ?>],
  zoom: 15
});

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
          "coordinates": [<?php echo $longitude; ?>, <?php echo $latitude; ?>]
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

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

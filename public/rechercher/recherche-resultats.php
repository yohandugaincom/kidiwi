<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
  $termes = $_GET['query'];
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $req = $pdo->query("SELECT * FROM ".BDD."general WHERE email='".$_SESSION['email']."'");
  while ($donnees = $req->fetch()) {
    $theme = $donnees['theme'];
  }
  if ($theme=="sombre") {
    $theme_text = "_sombre";
  }
  if ($theme == "sombre") {
    $colorbtn = "dark";
  } else {
    $colorbtn = "light";
  }
  $liste_enfant = '';
  $result = '';
  $type = $_GET['type_act'];
  if ($type=="all") {
    $type_cherche = "";
  } else {
    $type_cherche = " AND (theme='".$type."') ";
  }
  $req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE ((titre LIKE '%".$termes."%') OR (description LIKE '%".$termes."%') OR (adresse LIKE '%".$termes."%')) AND (active='oui') ".$type_cherche." LIMIT 10");
  while ($donnees = $req->fetch()) {
    $email_presentation = $donnees['email'];
    $id = $donnees['id'];
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
    $liste_inscrits = $donnees['liste_inscrits'];
    $inscrits = explode(",", $liste_inscrits);
    $inscrits_affiche = "";
    $num_inscrits = -1;
    foreach($inscrits as $id_enfant) {
        if ($num_inscrits <> count($inscrits)-2) {
          $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE `id`='".$id_enfant."'");
          while ($donnees = $req->fetch())
          {
            $prenom_enfant = $donnees['prenom'];
            $req1 = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$donnees['email']."'");
            while ($donnees1 = $req1->fetch())
            {
              $prenom_parent = $donnees1['prenom'];
            }
          }
          $inscrits_affiche = "<b>".$prenom_parent."</b> a inscrit <b>".$prenom_enfant."</b> à cette activité.</br>".$inscrits_affiche;
        }
        $num_inscrits = $num_inscrits + 1;
    }
    setlocale(LC_TIME, "fr_FR");
    $moment = strftime("%A %d %B %Y à %H:%M", strtotime($date));
    $result = $result.'<div class="card mb-3 animated fadeIn fondcolorcard" style="max-width:100%;min-height:180px;">
      <div class="row no-gutters">
        <div class="col-md-2">
          <img id="image" src="/public/activite/img/'.$image1.'" style="margin-top:8%;margin-left:10%;max-height:200px;max-width:200px;" />
        <div class="progress" style="height: 25px;margin-left:10%;margin-top:5%;width:200px;">
            <div class="progress-bar bg-success progress-bar-striped progress-bar-animated" role="progressbar" style="width: '.intval($num_inscrits/$places_max*100).'%;color:black;" aria-valuemin="0" aria-valuemax="100">
              <span style="margin-left:10px;"><b>'.($places_max-$num_inscrits).' places restantes</b></span>
            </div>
          </div>
        </div>
        <div class="col-md-8">
          <div class="card-body" style="margin-left:5%;">
            <h5 class="card-title"><span class="badge badge-dark">'.$prix.'€</span> '.$titre.'</h5>
            <p class="card-text">'.substr($description,0,128).'</p>
            <p class="card-text"><small class="text-muted"><img src="/public/img/age.png" width="20px" /> '.$age_min.' - '.$age_max.' ans <img src="/public/img/time.png" width="20px" /> '.$moment.'
            </br><img src="/public/img/map.png" width="20px" /> '.$adresse.'</small></p>
          </div>
        </div>
        <div class="col-md-2" align="right">
          <div class="btn-group mr-2" role="group" style="height:100%;width:100%;min-height:180px;">
            <button onclick="location.href=\'/public/activite/presentation.php?id='.$id.'\'" type="button" class="btn btn-'.$colorbtn.'" style="min-width:50%;">En savoir plus</button>
          </div>
        </div>
      </div>
    </div>';
  }
  if ($result == "") {
    $result = '<div align="center" class="animated shake"><img class="icon" src="/public/img/not_found.png" style="max-height:200px;" /></br>
    <p class="raleway" style="font-size:20px;">Désolé, aucun évènement ne corresponds à votre recherche.</p></div>';
  }
    echo $result;
?>

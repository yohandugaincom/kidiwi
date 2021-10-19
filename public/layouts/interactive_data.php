
    mapboxgl.accessToken = 'pk.eyJ1IjoieW9oYW5kdWdhaW4iLCJhIjoiY2p3M25sMGRnMTVrMTRja3RjdGY0YnlpYiJ9.gMbdo0jOSMJg0Dq8ClZJnw';
    var map = new mapboxgl.Map({
      container: 'map', // HTML container id
      style: 'mapbox://styles/mapbox/streets-v11', // style URL
      center: [long, lat], // starting position as [lng, lat]
      zoom: 13
    });
    <?php
    include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
    $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $req = $pdo->query("SELECT * FROM ".BDD."evenements WHERE active<>'non'");
    while ($donnees = $req->fetch())
    {
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
      $image2 = $donnees['image2'];
      $image3 = $donnees['image3'];
      $liste_inscrits = $donnees['liste_inscrits'];
      echo "var el = document.createElement('div');
        el.className = 'marker';

      var popup = new mapboxgl.Popup()
        .setHTML('<div class=\'card\' style=\'width: 18rem;\'><img src=\'/public/activite/img/".$image1."\' class=\'card-img-top\'><div class=\'card-body\'><p class=\'card-text\' style=\'font-size:15px;\'>".$titre."</p><a href=\'/public/activite/presentation.php?id=".$id."\'><button type=\'button\' class=\'btn btn-success\'>Voir la prestation</button></a></div></div>');

      var marker = new mapboxgl.Marker(el)
        .setLngLat([".$longitude.", ".$latitude."])
        .setPopup(popup)
        .addTo(map);";
    }
    ?>

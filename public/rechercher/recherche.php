<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php';
session_start();
if (isset($_SESSION['connecte'])) {
  include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
  $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
      array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
  );
  $liste_enfant = '';
  $req = $pdo->query("SELECT * FROM ".BDD."enfants WHERE email='".$_SESSION['email']."'");
  while ($donnees = $req->fetch()) {
    $id = $donnees['id'];
    $prenom = $donnees['prenom'];
    $nom = $donnees['nom'];
    $liste_enfant = $liste_enfant.'<div class="custom-control custom-switch" style="display:inline-block;margin-right:1%;margin-top:1%;">
      <input type="checkbox" checked class="custom-control-input" id="c'.$id.'">
      <label class="custom-control-label" for="c'.$id.'">'.$prenom.' '.$nom.'</label>
    </div>';
  }
}
?>
<div class="fondcolor" style="width:95%;margin:auto;margin-top:7%;">
  <div class="fondcolor" style="margin-left:1%;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;">
      <img class="icon" src="/public/img/search.png" width="50px" /> <b class="align-middle">Rechercher</b></p>
    <div style="width:80%;margin-top:1%;" align="left">
      <input class="form-control form-control-lg" type="text" id="termes" style="display:inline-block;width:40%;" placeholder="Entrez un mot-clé, une ville, une activité...">
      <select name="type_act" id="type_act" class="form-control form-control-lg" style="display:inline-block;width:20%;">
        <option value="all">Thème de l'activité</option>
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
    <button class="btn btn-success btn-lg" onclick="rechercher();" style="display:inline-block;vertical-align:0px;">Rechercher</button>
    <a href="carte_interactive.php"><button class="btn btn-dark btn-lg" style="display:inline-block;vertical-align:0px;">Carte interactive</button></a></br>
    <?php echo $liste_enfant; ?>
    </div>
  </div>
  <hr style="width:80%;">
  <div id="resultats" style="width:90%;margin:auto;padding:1%;">
  </div>
</div>
<script>
function rechercher() {
  var termes = document.getElementById('termes');
  var type_act = document.getElementById('type_act');
  const req = new XMLHttpRequest();
  req.open('GET', '/public/rechercher/recherche-resultats.php?query=' + termes.value + '&type_act=' + type_act.value, false);
  req.send(null);
  if (req.status === 200) {
      document.getElementById('resultats').innerHTML = req.responseText;
  }
}
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

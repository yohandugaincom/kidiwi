<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php"); session_start();if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>

<div align="center" id="wait" class="raleway animated bounceInDown" style="font-size:25px;margin-top:11%;display:block;">
  <div><img src="/public/img/password.png" class="animated pulse infinite slow" height="150px" /></br>
  Nous vous avons envoyé un code sur votre adresse</br>
  e-mail principale.</div>
  <div id="donnees" style="width:40%;margin:auto;margin-top:2%;" class=" animated bounceInDown">
    <input onkeyup="direct();" type="text" class="form-control" id="code" placeholder="*  *  *  *  *  *" style="text-align:center;font-size:30px;">
  </div>
</div>
<div align="center" id="good" class="raleway animated bounceInDown" style="font-size:30px;margin-top:11%;display:none;">
  <div><img src="/public/img/checked.png" class="animated tada infinite slow" height="150px" /></br></br>
  Nous finalisons votre inscription ...</div>
</div>
<script>
function direct() {
  var code = document.getElementById("code").value;
  const req = new XMLHttpRequest();
  req.open('GET', '/public/compte/inscription/c3/verifier_email.php?email=<?php
if (isset($_SESSION['email'])) {
  echo $_SESSION['email'];
} else {
  echo $_GET['email'];
} ?>&code='+code, false);
  req.send(null);
  if (req.status === 200) {
      if (req.responseText=="true") {
        document.getElementById("good").style.display = "block";
        document.getElementById("wait").style.display = "none";
        setTimeout(function(){location.href="etape-3.php?email=<?php echo $_SESSION['email']; ?>"} , 5000);
      }
  }
}
<?php
if (isset($_GET['activation'])) {
  echo "const req = new XMLHttpRequest();
  req.open('GET', '/public/compte/inscription/c3/verifier_email.php?email=".$_GET['email']."&code=".$_GET['activation']."', false);
  req.send(null);
  if (req.status === 200) {
      if (req.responseText=='true') {
        document.getElementById('good').style.display = 'block';
        document.getElementById('wait').style.display = 'none';
        setTimeout(function(){location.href='etape-3.php?email=".$_GET['email']."'} , 5000);
      }
  }";
}
 ?>
</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

<?php
if (!isset($_SESSION['inscription'])) {

  // Génère un code pour le mail
  function kodex_random_string($length=8){
      $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $string = '';
      for($i=0; $i<$length; $i++){
          $string .= $chars[rand(0, strlen($chars)-1)];
      }
      return $string;
  }

  $code = kodex_random_string();


  // Finalisation de l'inscription

  if (($_SESSION['mdp'] == $_SESSION['mdpr']) && (!isset($_GET['activation']))) {

  // Hachage
    $mdp = password_hash($_SESSION['mdp'], PASSWORD_DEFAULT);
  // Lancement de la requête
    $pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
    $requete = "INSERT INTO ".BDD."utilisateurs (id, prenom, nom, prenom_secondaire, nom_secondaire, adresse, adresse_complement, ville, code_postal, mot_de_passe, email, email_secondaire, role, active) VALUES (NULL, '".htmlspecialchars($_SESSION['prenom'], ENT_QUOTES)."', '".htmlspecialchars($_SESSION['nom'], ENT_QUOTES)."', '', '', '".htmlspecialchars($_SESSION['adresse'], ENT_QUOTES)."', '".htmlspecialchars($_SESSION['c_adresse'], ENT_QUOTES)."', '".htmlspecialchars($_SESSION['ville'], ENT_QUOTES)."', '".htmlspecialchars($_SESSION['cp'], ENT_QUOTES)."', '".$mdp."', '".htmlspecialchars($_SESSION['email'], ENT_QUOTES)."', '', 'Gérant', '".$code."')";
    $pdo->prepare($requete)->execute();

    $requete = "INSERT INTO ".BDD."general (id, email, note, messages_num, notifications_num, avatar, theme) VALUES (NULL, '".$_SESSION['email']."', '0', '0', '0', 'default', 'default')";
    $pdo->prepare($requete)->execute();
  }

       $to  = $_SESSION['email']; // notez la virgule

       // Sujet
       $subject = "Activation de votre compte professionnel Kid'iwi";

       // message
       $message = "
       <html>
        <head>
         <title>Activation de votre compte Kid'iwi</title>
         <link href='https://fonts.googleapis.com/css?family=Lato|Raleway' rel='stylesheet'>
        </head>
        <body>
         <div align='center'>
         <img src='https://i.goopics.net/0oE82.png' width='300px' /></br>
         <p style='font-family:Raleway;font-size:15px'>Voici votre code d'activation :</p>
         <p style='font-family:Lato;font-size:35px'>".$code."</p>
         <a href='#' target='_blank'>
          <p style='font-family:Raleway;font-size:15px'>Vous pouvez aussi activer votre compte en cliquant ici.</p>
         </a>
         </div>
        </body>
       </html>
       ";

       // Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
       $headers[] = 'MIME-Version: 1.0';
       $headers[] = 'Content-type: text/html; charset=iso-8859-1';

       // Envoi
       $success = mail($to, $subject, $message, implode("\r\n", $headers));

       if (!$success) {
         $errorMessage = error_get_last()['message'];
       }
       $_SESSION['inscription'] = "en_attente";
}


?>

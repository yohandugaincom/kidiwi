<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $messages_num = $donnees['messages_num'];
  $notifications_num = $donnees['notifications_num'];
}
$req->closeCursor();

if ($messages_num == '0') {
  $messages_dis = "0";
} else {
  $messages_dis = "1";
}
if ($notifications_num == '0') {
  $notifications_dis = "0";
  $notify = "";
} else {
  $notifications_dis = "1";
  $notify = "_e";
}
 ?>
<li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Mon compte
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
  <a class="dropdown-item" href="/public/compte/prive/mon-compte.php">Mon profil</a>
  <?php
  if ($_SESSION['role']=="parents") {
    echo '<a class="dropdown-item" href="/public/compte/prive/reservation.php">Mes réservations</a>';
  }
   ?>
  <a class="dropdown-item" href="/public/compte/prive/mes-evenements.php">Mes évènements</a>
  <div class="dropdown-divider"></div>
  <a class="dropdown-item" href="/public/compte/prive/creer-evenement.php">Créer un évènement</a>
</div>
</li>
</ul>
<a href="/public/compte/prive/messagerie.php"><img src="/public/img/message.png" width="35px" style="display:block;position:relative;" /></a><span onclick="location.href='/public/compte/prive/messagerie.php';" class="badge badge-dark animated pulse infinite" style="cursor:pointer;opacity:<?php echo $messages_dis; ?>;margin-right:2rem;position:relative;margin-left:-15px;margin-top:15px;">
  <?php echo $messages_num; ?>
</span>
<a href="/public/compte/prive/notification.php"><img src="/public/img/notif<?php echo $notify; ?>.png" width="35px" style="display:block;position:relative;" /></a><span onclick="location.href='/public/compte/prive/notification.php';" class="badge badge-dark animated pulse infinite" style="cursor:pointer;opacity:<?php echo $notifications_dis; ?>;margin-right:2rem;position:relative;margin-left:-15px;margin-top:15px;">
<?php echo $notifications_num; ?>
</span>

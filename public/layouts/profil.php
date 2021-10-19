<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
$pdo = new PDO('mysql:host='.HOST, USERNAME, MOTDEPASSE,
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
);
$req = $pdo->query("SELECT * FROM ".BDD."utilisateurs WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $prenom = $donnees['prenom'];
  $nom = $donnees['nom'];
}
$req = $pdo->query("SELECT * FROM ".BDD."general WHERE `email`='".$_SESSION['email']."'");
while ($donnees = $req->fetch())
{
  $note = $donnees['note'];
}
$req->closeCursor();
 ?>

<div class="fondcolor" style="float:left;width:25%;display:inline-block;padding:2%;position:fixed;">
  <div align="center"><p id="status_profil" style="font-size:18px;" class="badge badge-success">En ligne</p></br>
    <a href="/public/compte/prive/mon-avatar.php" onmouseover="document.getElementById('status_profil').innerHTML='Modifier mon avatar';" onmouseout="document.getElementById('status_profil').innerHTML='En ligne';"><img id="avatar_profil" src="<?php echo $avatar; ?>" width="150px" height="150px" /></a></br>
    <p class="raleway" style="font-size:30px;"><?php echo $prenom.' '.$nom; ?></br>
    <span class="fa fa-star<?php if ($note>=1) { echo " checked"; } ?>"></span>
    <span class="fa fa-star<?php if ($note>=2) { echo " checked"; } ?>"></span>
    <span class="fa fa-star<?php if ($note>=3) { echo " checked"; } ?>"></span>
    <span class="fa fa-star<?php if ($note>=4) { echo " checked"; } ?>"></span>
    <span class="fa fa-star<?php if ($note==5) { echo " checked"; } ?>"></span></p>
    <a href="/public/compte/prive/mon-compte.php"><button type="button" class="btn btn-secondary">Mon compte</button></a>
    <a href="/public/compte/se-deconnecter/se-deconnecter.php?secure=<?php echo $_SESSION['connecte']; ?>"><button type="button" class="btn btn-danger">Se déconnecter</button></a>
  </div>
</div>

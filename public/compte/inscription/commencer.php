<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
session_start();
session_destroy();
if (isset($_SESSION['connecte'])) {
  header('Location: /public/accueil');
}
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php'; ?>

<style>
  .card {
    background-color:white;
    color:black;
  }
  .card:hover {
    background-color: #2ecc71;
    color:white;
    cursor:pointer;
  }
</style>

<div align="center" class="raleway animated bounceInDown" style="font-size:35px;margin-top:8%;">Bien commençons, par vous orienter ...</div>

<div align="center" class="lato animated bounceInDown" style="font-size:15px;">
</br>Afin de pouvoir répondre à vos besoins, nous avons besoin de connaître quelques informations vous concernant.
</br>Ces informations nous permettrons de mieux guider votre procédure d'inscription.
</div>
<div align="center" style="margin-top:1%;">
  <div id="alert" class="alert alert-success" role="alert" style="display:none;width:50%;">
    Attention, vous ne pourrez plus modifier votre rôle Kid'iwi après finalisation de votre inscription.
  </div>
</div>
<div id="choix" align="center" style="margin-top:2%;">
  <div id="c1" class="card d-inline-block animated bounceIn delay-1s" style="width: 12rem;" align="center" onmouseover="show('parents');" onmouseout="hide('parents');" onclick="select('c1');">
    <img src="/public/img/parents.png" class="card-img-top" style="padding:20px;">
    <div class="card-body">
      <p class="card-text lato">Un parent ou un proche</p>
    </div>
  </div>
  <div id="c2" class="card d-inline-block animated bounceIn delay-2s" style="width: 12rem;margin-left:2%;" align="center" onmouseover="show('pro');" onmouseout="hide('pro');" onclick="select('c2');">
    <img src="/public/img/creativity.png" class="card-img-top" style="padding:20px;">
    <div class="card-body">
      <p class="card-text lato">Un professionnel ou un artiste</p>
    </div>
  </div>
  <div id="c3" class="card d-inline-block animated bounceIn delay-3s" style="width: 12rem;margin-left:2%;" align="center" onmouseover="show('gerant');" onmouseout="hide('gerant');" onclick="select('c3');">
    <img src="/public/img/lieu.png" class="card-img-top" style="padding:20px;">
    <div class="card-body">
      <p class="card-text lato">Le gérant d'un lieu ou d'un établissement</p>
    </div>
  </div>
</div>

<div id="info" align="center" style="margin-top:3%;">
  <div id="parents" style="display:none;">
    <p class="raleway" style="font-size:20px;"><b>Vous êtes un parent ou un proche ?</b></p>
    <p style="font-size:15px;">En tant que parent ou proche, vous pourrez gérer les activités de vos enfants.</p>
  </div>
  <div id="pro" style="display:none;">
    <p class="raleway" style="font-size:20px;"><b>Vous êtes un professionnel ?</b></p>
    <p style="font-size:15px;">En tant que professionnel, vous pourrez vous spécialiser dans un ou plusieurs domaines et gérer vos disponibilités.</p>
  </div>
  <div id="gerant" style="display:none;">
    <p class="raleway" style="font-size:20px;"><b>Vous êtes gérant d'un lieu ?</b></p>
    <p style="font-size:15px;">En tant que gérant de lieu, vous pourrez gérer les disponibilités de votre établissement.</p>
  </div>
  <a id="continue" href="#" style="display:none;"><button type="button" class="btn btn-success btn-lg">Continuer</button></a>
</div>

<script>

  function show(x) {
    document.getElementById(x).style.display = "block";
    if (document.getElementById('alert').style.display === "block") {
      document.getElementById('continue').style.display = "none";
    }
  }
  function hide(x) {
    document.getElementById(x).style.display = "none";
    if (document.getElementById('alert').style.display === "block") {
      document.getElementById('continue').style.display = "block";
    }
  }
  function select(x) {
    document.getElementById('c1').style.backgroundColor = "white";
    document.getElementById('c1').style.color = "black";
    document.getElementById('c2').style.backgroundColor = "white";
    document.getElementById('c2').style.color = "black";
    document.getElementById('c3').style.backgroundColor = "white";
    document.getElementById('c3').style.color = "black";
    document.getElementById('parents').style.display = "none";
    document.getElementById('pro').style.display = "none";
    document.getElementById('gerant').style.display = "none";
    document.getElementById('alert').style.display = "block";
    document.getElementById('continue').style.display = "block";
    document.getElementById('continue').href = x + "/cgu.php";
    document.getElementById(x).style.backgroundColor = "#2ecc71";
    document.getElementById(x).style.color = "white";
  }

</script>

<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

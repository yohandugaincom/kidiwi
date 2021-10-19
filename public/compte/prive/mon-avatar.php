<?php include($_SERVER['DOCUMENT_ROOT']."/dev/constantes.php");
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/verifier_connexion.php';
include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/header.php';
?>
<style>
.checked {
  color: #27ae60;
}
</style>
<div style="margin-top:8%;margin-left:2%;margin-right:2%;overflow-y:scroll;">

  <?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/profil.php'; ?>

  <div class="fondcolor" style="float:right;width:73%;display:inline-block;padding:2%;">
    <p style="font-family:Arial;font-size:50px;margin-left:1%;"><img class="icon" src="/public/img/photo.png" width="50px" /> <b class="align-middle">Mon avatar</b></p>
    <div align="center">
      <img src="<?php echo $avatar; ?>" width="200px" /></br>
      <div align="center" class="lato" style="font-size:15px;margin-top:1%;">
        <div align="center" style="margin-top:1%;">
          <div id="alert" class="alert alert-success" role="alert" style="width:65%;height:55px;">
            <div style="display:inline-block;float:left;width:25%;">
              <img src="/public/img/world.png" width="30px" />
            </div>
            <div style="display:inline-block;float:right;width:75%;font-size:12px;" align="left">
              <p style="margin-top:5px;">Votre avatar peut être visible par l'ensemble de la communauté Kid'iwi.</p>
            </div>
          </div>
        </div>
      </div>
      <form>
        <div class="form-group" style="margin-top:2%;">
          <input id="file" type="file" style="text-align:center;margin: 0 auto;"></br></br>
          <button id="envoyer" type="button" class="btn btn-success">Mettre à jour</button>
        <button id="reset" type="button" class="btn btn-secondary">Réinitialiser</button>
        </div>
      </form>
    </div>
  </div>
</div>
 <script>
   $(document).ready(function() {
     console.log($.ajax);
   });
$("#avatar_profil").addClass("animated pulse infinite");

$(document).ready(function(){

    $("#envoyer").click(function(){

        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file',files);

        $.ajax({
            url: '/public/compte/prive/upload.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                if(response != 0){
                    location.reload(true);
                }else{
                    alert("Une erreur est survenue, contactez l'assistance Kid'iwi.");
                }
            },
        });
    });
    $("#reset").click(function(){
      const req = new XMLHttpRequest();
      req.open('GET', '/public/compte/prive/reset_avatar.php', false);
      req.send(null);
      if (req.status === 200) {
          location.reload(true);
      }
    });
});
</script>
<?php include $_SERVER['DOCUMENT_ROOT'].'/public/layouts/footer.php'; ?>

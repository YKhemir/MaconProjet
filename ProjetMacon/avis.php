<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis</title>
</head>
<body>
    <?php
        include_once("connexion_bd.php");
        include_once("session.php");
        include_once("classes/Avis.class.php");
        include_once("classes/AvisManager.class.php");
        include_once("include/menu.inclu.php");
        
    ?>
    <div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 style="text-align: center;">Donnez votre avis</h2>
      <form  method="POST">
      <i class="bi bi-star"></i>
        <div class="form-group">
          <label for="nom">Nom :</label>
          <input type="text" class="form-control" name="nom" id="nom" oninput="saisietextenom()" required>
        </div>
        <div class="form-group">
          <label for="prenom">Prénom :</label>
          <input type="prenom" class="form-control" name="prenom" id="prenom" oninput="saisietexteprenom()" required>
        </div>
        <div class="form-group">
          <label for="titre">Titre :</label>
          <input type="text" class="form-control" name="titre" id="titre" oninput="saisietextetitre()" required>
        </div>
        <div class="form-group">
          <label for="avis">Avis :</label>
          <textarea class="form-control" name="avis" id="avis" rows="5" required></textarea>
        </div>
        <button type="submit" style="margin: 10px ;" class="btn btn-primary">Envoyer</button>
      </form>
    </div>
  </div>
</div>
<?php 

if(isset($_POST['nom']) && isset($_POST['prenom']) 
   && isset($_POST['titre']) && isset($_POST['avis'])){
    // Ajout du l'avis dans la base de données
    $avisObject = new AvisManager($db);
    $idUser = $_SESSION['user_id'];
    $avis = new Avis ([
      'idUser' => $idUser,
      'nom' => $_POST['nom'],
      'prenom' => $_POST['prenom'],
      'titre'=>$_POST['titre'],
      'avis' => $_POST['avis']
    ]);
    $avisObject -> add($avis);
    echo "Votre avis compte pour nous!Merci.";
  } else {
    echo "";

}
?>
<script>
    function saisietextenom() { // conditions du nom
      var nomInput = document.getElementById("nom");
      var isValidFormat = /^[a-zA-Z]+$/.test(nomInput.value);
      var isValidLength = nomInput.value.length >= 4 && nomInput.value.length <= 30;

      nomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      nomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }

    function saisietexteprenom() { // conditions du prénom
      var prenomInput = document.getElementById("prenom");
      var isValidFormat = /^[a-zA-Z]+$/.test(prenomInput.value);
      var isValidLength = prenomInput.value.length >= 4 && prenomInput.value.length <= 30;

      prenomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      prenomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }

    function saisietextetitre() { // conditions du prénom
      var messageInput = document.getElementById("titre");
      var isValidFormat = /^[a-zA-Z]+$/.test(prenomInput.value);
      var isValidLength = prenomInput.value.length >= 4 && prenomInput.value.length <= 30;

      prenomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      prenomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }
</script>
<?php 
  include_once("include/footer.inclu.php");
?>
</body>
</html>
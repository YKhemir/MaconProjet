<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
</head>
<body>
    
    <?php
        // connection à la base de données 
        include_once("connexion_bd.php");
        include_once("classes/DevisManager.class.php");
        include_once("session.php");
        include_once("include/menu.inclu.php");
        
    ?>
    <h1 style="text-align: center;">Bienvenue chez nous</h1> 
    <p style="text-align: center;">
        Vous êtes dans votre espace à vous.Nous vous accompagnons 
        dans chaque étape de votre vie.Veuillez prendre un rendre
        un devis.Dans le menu vous trouvez Devis.Cliquez
        dessus.
    </p>
    <div class="container">
  <div class="row">
    <div class="col-md-6 offset-md-3">
      <h2 style="text-align: center;">Faite votre devis</h2>
      <form  method="POST">
        <div class="form-group">
          <label for="nom">Nom</label>
          <input type="text" class="form-control" name="nom" id="nom" oninput="saisietextenom()" required>
        </div>
        <div class="form-group">
          <label for="prenom">Prénom</label>
          <input type="text" class="form-control" name="prenom" id="prenom" oninput="saisietexteprenom()"required>
        </div>
        <div class="form-group">
        <label for="service" class="form-label" required>Services</label>
        <select class="form-select" name="service" id="service">
            <option >--Sélectionner une option--</option>
            <option >Jardinage</option>
            <option >Travaux</option>
            <option >Peinture</option>
            <option >Construction</option>
            <option >Plomberie</option>
        </select>  
    </div>
        <div class="form-group">
          <label for="date">date du rendez-vous:</label>
          <input  class="form-control" type="date" placeholder="dd-mm-yyyy" value="" min="1997-01-01" max="2030-12-31" name="date" id="date" required>  
        </div> 
        <div class="form-group">
          <label for="message">Message:</label>
          <textarea class="form-control" name="message" id="message" rows="5" required oninput="saisietextemessage()"></textarea>
        </div>
        
        <button type="submit" style="margin: 10px ;" class="btn btn-primary">Envoyer</button>
      </form>
    </div>
  </div>
</div>
<?php 
if(isset($_POST['nom']) && (isset($_POST['prenom']))  && (isset($_POST['date']))
&& (isset($_POST['service']))  && (isset($_POST['message']))
){
  $nomInput = $_POST["nom"];
  $prenomInput = $_POST["prenom"];
  $dateInput = $_POST['date'];
  $serviceInput = $_POST['service'];
  $messageInput = $_POST['message'];

  $isValidFormatNom = preg_match('/^[a-zA-Z]{4,30}$/', $nomInput);
  $isValidLengthNom = strlen($nomInput) >= 4 && strlen($nomInput) <= 30;

  $isValidFormatPrenom = preg_match('/^[a-zA-Z]{4,30}$/', $prenomInput);
  $isValidLengthPrenom = strlen($prenomInput) >= 4 && strlen($prenomInput) <= 30;

  // Vérifier si la date est une date valide et qu'elle n'est pas antérieure à la date d'aujourd'hui
  $currentDate = date('Y-m-d');
  if (!empty($dateInput) && strtotime($dateInput) >= strtotime($currentDate)) {
      // La date est valide et postérieure ou égale à aujourd'hui
      $dateIsValid = true;
  } else {
      // La date n'est pas valide ou antérieure à aujourd'hui
      $dateIsValid = false;
  }

  // Vérifier que le service et le message sont des chaînes de texte
  $serviceIsValid = is_string($serviceInput);
  $messageIsValid = is_string($messageInput);


  $devisObject = new DevisManager($db);
  $idUser = $_SESSION['user_id'] ;
  $devis = new Devis ([
    'idUser'=> $idUser,
    'nom' => $_POST['nom'],
    'prenom'=> $_POST['prenom'],
    'dateDevis'=> $_POST['date'],
    'service'=> $_POST['service'],
    'message'=> $_POST['message']
  ]);
  $devisObject->add($devis);
  echo "<p>Voici votre devis !<p>";
} else {
  echo'';
}

?>

<script>
  // Obtenir la date actuelle au format YYYY-MM-DD
  function getCurrentDate() {
    const now = new Date();
    const year = now.getFullYear();
    let month = now.getMonth() + 1;
    let day = now.getDate();

    // Ajouter un zéro devant le mois/jour si nécessaire
    if (month < 10) {
      month = '0' + month;
    }
    if (day < 10) {
      day = '0' + day;
    }

    return `${year}-${month}-${day}`;
  }

  // Mettre à jour la valeur minimale de l'élément de date
  document.getElementById('date').setAttribute('min', getCurrentDate());
  // Pas de besoin de définir une valeur maximale, ce qui signifie "jusqu'à l'infini"

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

    function saisietextemessage() { // conditions du prénom
      var messageInput = document.getElementById("message");
      var isValidFormat = /^[a-zA-Z]+$/.test(prenomInput.value);
      var isValidLength = prenomInput.value.length >= 4 && prenomInput.value.length <= 500;

      prenomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      prenomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }
</script>
<?php 
  include_once("include/footer.inclu.php");
?>
</body>
</html>
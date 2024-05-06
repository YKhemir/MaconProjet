<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
</head>
<body>
    <?php
        include_once("session.php");
        include_once("include/menu.inclu.php");
        if(isset($_SESSION['erreurInscription'])){
          echo ($_SESSION['erreurInscription']);
        }
        
    ?>
    
    <div class="d-flex justify-content-center">
    <form class="p-3 mb-2 centered-form" method="POST">
      <div class="mb-3">
        <label for="nom" class="form-label">Nom :</label>
        <input type="text" class="form-control" id="nom1" name="nom" oninput="saisietextenom()">
      </div>
      <div class="mb-3">
        <label for="prenom" class="form-label">Prénom :</label>
        <input type="text" class="form-control" id="prenom" name="prenom" oninput="saisietexteprenom()">
      </div>
      <div class="mb-3">
        <label for="email1" class="form-label">Email :</label>
        <input type="email" class="form-control" id="email1" name="email1" aria-describedby="emailHelp" oninput="saisiemail()">
        <div id="emailHelp" class="form-text">Nous ne partagerons pas votre email</div>
      </div>
      <div class="mb-3">
        <label for="password1" class="form-label">Mot de passe :</label>
        <input type="password" class="form-control" id="passwordInput"  name="passwordInput"  oninput="validatePassword(); validatePasswordMatch();">
      </div>
      <div class="mb-3">
        <label for="password2" class="form-label">Confirmer le mot de passe :</label>
        <input type="password" class="form-control" id="confirmPasswordInput" name="confirmPasswordInput" oninput="validatePasswordMatch();">
      </div>
      <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>
  </div>
  
  <script>
    function saisietextenom() {
      var nomInput = document.getElementById("nom1");
      var isValidFormat = /^[a-zA-Z]+$/.test(nomInput.value);
      var isValidLength = nomInput.value.length >= 4 && nomInput.value.length <= 30;

      nomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      nomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }

    function saisietexteprenom() {
      var prenomInput = document.getElementById("prenom");
      var isValidFormat = /^[a-zA-Z]+$/.test(prenomInput.value);
      var isValidLength = prenomInput.value.length >= 4 && prenomInput.value.length <= 30;

      prenomInput.classList.toggle('is-valid', isValidFormat && isValidLength);
      prenomInput.classList.toggle('is-invalid', !isValidFormat || !isValidLength);
    }

    function saisiemail() {
      var emailInput = document.getElementById("email1");
      var isValidEmail = emailInput.value.includes("@");

      if (isValidEmail) {
        emailInput.classList.remove('is-invalid');
        emailInput.classList.add('is-valid');
      } else {
        emailInput.classList.remove('is-valid');
        emailInput.classList.add('is-invalid');
      }
    }

    function validatePassword() {
        var passwordInput = document.getElementById("passwordInput");
        var passwordValue = passwordInput.value;
        var regexLength = /^.{8,}$/;  // Au moins 12 caractères
        var regexSpecialChars = /[^a-zA-Z0-9]/;  // Caractères spéciaux
        var regexUppercase = /[A-Z]/;  // Au moins une lettre majuscule
        var regexLowercase = /[a-z]/;  // Au moins une lettre minuscule

        if (
            regexLength.test(passwordValue) &&
            regexSpecialChars.test(passwordValue) &&
            regexUppercase.test(passwordValue) &&
            regexLowercase.test(passwordValue)
        ) {
            passwordInput.classList.remove('is-invalid');
            passwordInput.classList.add('is-valid');
        } else {
            passwordInput.classList.remove('is-valid');
            passwordInput.classList.add('is-invalid');
        }
    }

    function validatePasswordMatch() {
        var passwordInput = document.getElementById("passwordInput");
        var confirmPasswordInput = document.getElementById("confirmPasswordInput");
        var passwordValue = passwordInput.value;
        var confirmPasswordValue = confirmPasswordInput.value;

        if (passwordValue === confirmPasswordValue && passwordValue !== '') {
            confirmPasswordInput.classList.remove('is-invalid');
            confirmPasswordInput.classList.add('is-valid');
        } else {
            confirmPasswordInput.classList.remove('is-valid');
            confirmPasswordInput.classList.add('is-invalid');
        }
    }
  </script>
      <?php

// vérifier les informations du formulaire saisie 

if (isset($_POST["nom"]) && isset($_POST["prenom"]) 
   && isset($_POST["email1"]) 
   && isset($_POST["passwordInput"]) 
   && isset($_POST["confirmPasswordInput"])){
    $nomInput = $_POST["nom"];
    $prenomInput = $_POST["prenom"];
    $emailInput = $_POST["email1"];
    $passwordInput = $_POST["passwordInput"];
    $confirmPasswordInput = $_POST["confirmPasswordInput"];

    $isValidFormatNom = preg_match('/^[a-zA-Z]{4,30}$/', $nomInput);
    $isValidLengthNom = strlen($nomInput) >= 4 && strlen($nomInput) <= 30;

    $isValidFormatPrenom = preg_match('/^[a-zA-Z]{4,30}$/', $prenomInput);
    $isValidLengthPrenom = strlen($prenomInput) >= 4 && strlen($prenomInput) <= 30;

    $isValidEmail = strpos($emailInput, "@") !== false;

    $regexLength = '/^.{8,}$/';  // Au moins 12 caractères
    $regexSpecialChars = '/[^a-zA-Z0-9]/';  // Caractères spéciaux
    $regexUppercase = '/[A-Z]/';  // Au moins une lettre majuscule
    $regexLowercase = '/[a-z]/';  // Au moins une lettre minuscule

    $isValidPassword = preg_match($regexLength, $passwordInput) &&
        preg_match($regexSpecialChars, $passwordInput) &&
        preg_match($regexUppercase, $passwordInput) &&
        preg_match($regexLowercase, $passwordInput);

    $passwordsMatch = $passwordInput === $confirmPasswordInput && $passwordInput !== '';

    if ($isValidFormatNom && $isValidLengthNom &&
        $isValidFormatPrenom && $isValidLengthPrenom &&
        $isValidEmail && $isValidPassword && $passwordsMatch) {
          // connection à la base de données 
          include_once("connexion_bd.php");
          // Ajoutez des var_dump pour déboguer
          //echo var_dump($_POST);
          include_once('classes/User.class.php');
          include_once('classes/UserManager.class.php');

          $manager = new UserManager($db);
          //var_dump($manager);
          //echo 'jojo';

          $emailExists = $manager->emailExists($_POST['email1']);

          if ($emailExists) {
              echo "Cet e-mail est déjà associé à un compte. Veuillez choisir un autre e-mail.Ou vous connectez !";
          } else {
          
          $user = new User([
              'nom' => $_POST['nom'],
              'prenom' => $_POST['prenom'] ,
              'email' => $_POST['email1'], 
              'mdp' => $_POST['passwordInput'],
              'type'=> 'client'
              ]);
          //var_dump($user); // Vérifiez les valeurs de l'objet User avant d'appeler add()
          $manager->add($user);
          echo "<p>Bienvenue chez nous !<p>";
          }
    } 
  }
  include_once("include/footer.inclu.php");
?>
  </body>
</html>
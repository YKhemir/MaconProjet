<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connxion</title>
</head>
<body>
    <?php
        include_once("session.php");
        // connection à la base de données 
        include_once("connexion_bd.php");
        include_once("classes/UserManager.class.php");
        include_once("include/menu.inclu.php");
        
    ?>
    

    <!-- formulaire de connexion-->
    <div class="d-flex justify-content-center">
        <form  method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" oninput="saisiemail()">
                <div id="emailHelp" class="form-text">Nous ne partagerons pas votre email</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="passwordInput" name="passwordInput" oninput="validatePassword()">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    

   <?php
   
   if(isset($_POST['email']) && isset($_POST['passwordInput'])){
    $email = $_POST['email'];
    $mdp = $_POST['passwordInput'];
    // vérification présence du mail et mdp dans la base de données
    
    $manager = new UserManager($db);
    $userExist = $manager->exists($email,$mdp);
    if($userExist == 'true'){
        $_SESSION['logged'] = true;
        $user = $manager->getUser($email);
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['user_type'] = $user->getType();
        header('Location: avis.php');
    } else {
        include("index.php");
    }

   }

   
   include('include/footer.inclu.php');
   
   ?>

    
</body>
</html>
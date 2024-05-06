<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KhemirMultiservices</title>
</head>
<body>
    <?php
        include_once("session.php");
        include_once("include/menu.inclu.php");
        include_once("include/image.inclu.php");
        include_once("include/presentation.inclu.php");
        include_once("include/avantages.inclu.php");
        include_once("include/projets.inclu.php");
        include_once("include/footer.inclu.php");
        
    ?>
<style>
  /* image de l'acceuil */
#image-container {
    position: relative;
    height: 90vh;
  }
  
  #image-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
  
  #image-container .text-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    text-align: center;
  }
  
  #image-container .text-overlay h1 {
    color: white;
    font-size: 36px;
  }
  
  #image-container .text-overlay p {
    color: white;
    font-size: 18px;
  }
  /* centrer les formulaires */
  .form {
    display: flex;
    justify-content: center;
    align-items: center;
  }

  


</style>       
</body>
</html>
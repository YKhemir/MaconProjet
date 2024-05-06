<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KhemirMultiservices</title>
</head>
<body>
    <?php
        include_once("session.php");
        include_once("include/menu.inclu.php");
        include_once("connexion_bd.php");
        include_once("classes/Avis.class.php");
        include_once("classes/AvisManager.class.php");
    ?>
    <h1 style="text-align: center;">Gestion des Avis</h1>
    <?php
        $avisObject = new AvisManager($db);
        $idUser = $_SESSION['user_id'];
        $avis = $avisObject -> getAvis();

        if (!empty($avis)) {
            echo '<table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID utilisateur</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Avis</th>
                            
                        </tr>
                    </thead>
                    <tbody>';
        
            foreach ($avis as $avisInfo) {
                echo "<tr>
                        <td>" . $avisInfo['idUser'] . "</td>
                        <td>" . $avisInfo['nom'] . "</td>
                        <td>" . $avisInfo['prenom'] . "</td>
                        <td>" . $avisInfo['titre'] . "</td>
                        <td>" . $avisInfo['avis'] . "</td>
                        <td><button class='btn btn-secondary''>Supprimer</button></td>
                        <td><button class='btn btn-secondary' disabled>Modifier</button></td>
                      </tr>";
            }
        
            echo '</tbody>
                </table>';
        } else {
            echo "Aucun devis trouvé.";
        }
    ?>
</body>
</html>
<?php 
include_once("connexion_bd.php");
include_once("./classes/DevisManager.class.php");
// verification de donnees du formulaire fictif du bouton javascript 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $devisId = $_POST['devisId'];

    

    //instancier devis
    $devisManager = new DevisManager($db);
    try {
        $devisManager->deleteDevis($devisId);
        http_response_code(201); // Indique que la suppression a été effectuée avec succès
        echo "Devis successfully deleted!";
    } catch (Exception $e) {
       // http_response_code(500); // Indique une erreur interne du serveur
        echo "Error: Unable to delete the devis ".$e->getMessage();
    }
} else {
    http_response_code(400); // Indique une mauvaise requête
    echo "Error: Bad request";
}
?>
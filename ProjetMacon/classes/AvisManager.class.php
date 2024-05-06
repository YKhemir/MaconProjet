<?php 
class AvisManager{
    private $_db;
    public function __construct($db){
        $this->setDb($db);
    }

    // ajouter l'avis 
    public function add(Avis $avis){
        $q = $this->_db->prepare('INSERT INTO avis (idAvis, idUser, nom, prenom,
             titre, avis)VALUES (:idAvis, :idUser, :nom, :prenom,:titre, :avis)');
        $q->bindValue(':idAvis', $avis->getIdAvis());
        $q->bindValue(':idUser', $avis->getIdUser());
        $q->bindValue(':nom', $avis->getNom());
        $q->bindValue(':prenom', $avis->getPrenom());
        $q->bindValue(':titre', $avis->getTitre());
        $q->bindValue(':avis', $avis->getAvis());
        $q->execute();

        $avis->hydrate([
            'Id' => $this->_db->lastInsertId(),
        ]);
    }
    // avoir tous les avis 
    public function getAvis(){
        $q = $this-> _db->query('SELECT * FROM avis');
        $avisInfo = $q->fetchAll(PDO::FETCH_ASSOC);
        return  $avisInfo;

    }
    // supprimer l'avis 

    // modifier l'avis

    public function setDb(PDO $db){
        $this -> _db = $db;
    }
    
}
?>
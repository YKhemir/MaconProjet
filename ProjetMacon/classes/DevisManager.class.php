<?php
include("Devis.class.php");
class DevisManager {

    private $_db;
    public function __construct($db){
        $this->setDb($db);
    }
        
    
    // CRUD 
    public function add(Devis $devis ){
        $q = $this->_db->prepare('INSERT INTO devis (nom, prenom,
        idUser, dateDevis, service, message)VALUES (:nom, :prenom, :idUser,:dateDevis, :service
        , :message)');
        $q->bindValue(':nom', $devis->getNom());
        $q->bindValue(':prenom', $devis->getPrenom());
        $q->bindValue(':idUser', $devis->getIdUser());
        $q->bindValue('dateDevis', $devis->getDateDevis());
        $q->bindValue(':service', $devis->getService());
        $q->bindValue(':message', $devis->getMessage());
        $q->execute();

        $devis->hydrate([
            'Id' => $this->_db->lastInsertId(),
        ]);
    }
    public function update(Devis $devis ){
    
        try {
            $q = $this->_db->prepare('UPDATE devis SET  id =:id, nom = :nom, prenom = :prenom, 
                                    dateDevis 
                                    = :dateDevis, service = :service, 
                                    message = :message WHERE id = :id');
        $q->bindValue(':id', $devis->getId());
        $q->bindValue(':nom', $devis->getNom());
        $q->bindValue(':prenom', $devis->getPrenom());
        //$q->bindValue(':idUser', $devis->getIdUser());
        $q->bindValue('dateDevis', $devis->getDateDevis());
        $q->bindValue(':service', $devis->getService());
        $q->bindValue(':message', $devis->getMessage());
        $q->execute();
          } catch (\PDOException $e) {
            echo $e->getMessage() . '<BR>';
          }
    }

    public function getDevis(){
        $q = $this-> _db->query('SELECT * FROM devis');
        $devisInfo = $q->fetchAll(PDO::FETCH_ASSOC);
        return  $devisInfo;

    }

    public function getDevisById($id){
        $q = $this-> _db->prepare('SELECT *  FROM devis WHERE id = :id');
        $q->execute(array('id' => $id));
        $devisInfo = $q->fetch(PDO::FETCH_ASSOC);
        if($devisInfo){
            return new Devis($devisInfo);
        } else {
            return null;
        }

    }
    public function deleteDevis($id){
        $q = $this -> _db->prepare('DELETE  FROM devis WHERE id = :id');
        $q->execute(array('id' => $id));
         
         // Vérifier si la suppression a réussi en vérifiant le nombre de lignes affectées
         if ($q->rowCount() > 0) {
             // La photo a été supprimée avec succès
             return true;
         } else {
             // La suppression a échoué
             return false;
         }
        
    }
    
    // public function updateDevis($id,$nom,$prenom,$dateDevis,$service,$message){
    //     $q = $this -> _db->prepare('UPDATE devis SET  id =:id, nom = :nom, prenom = :prenom, 
    //                             dateDevis = :dateDevis, service = :service, 
    //                             message = :message WHERE id = :id');
    //      $q->bindParam(':nom', $nom, PDO::PARAM_INT);
    //      $q->bindValue(':prenom', $prenom, PDO::PARAM_INT);
    //      $q->bindValue('dateDevis', $dateDevis, PDO::PARAM_INT);
    //      $q->bindValue(':service', $service, PDO::PARAM_INT);
    //      $q->bindValue(':message', $message, PDO::PARAM_INT);
    //      $q->execute();
    // }

    public function setDb(PDO $db){
        $this -> _db = $db;
    }
    

    


}
?>
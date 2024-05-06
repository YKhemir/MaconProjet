<?php 
class Devis {
     // Attributs 
     private $_id;
     private $_idUser;
     private $_nom;
     private $_prenom;
     private $_dateDevis;
     private $_service;
     private $_message;

     // hydratation 
    public function __construct(array $donnees){
        $this -> hydrate ($donnees);
    }

    public function hydrate (array $donnees){

        foreach($donnees as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
			{
				$this->$method($value);
			}

        }

    }
    // Getters 
    public function getId (){
        return $this -> _id;
    }
    public function getIdUser (){
        return $this -> _idUser;
    }
    public function getNom (){
        return $this -> _nom;
    }
    public function getDateDevis (){
        return $this -> _dateDevis;
    }
    public function getPrenom(){
        return $this -> _prenom;
    }
    public function getService(){
        return $this->_service;
    }
    public function getMessage(){
        return $this -> _message;
    }
    // setters 
    public function setId ($id){
         $this -> _id = $id;
    }
    public function setIdUser ($idUser){
        $this -> _idUser = $idUser;
   }

    public function setNom ($nom){
        if(is_string($nom)){
            $this -> _nom = $nom;
        }
    }
    public function setPrenom($prenom){
        if(is_string($prenom)){
            $this -> _prenom = $prenom;
        }
    }
    public function setService($service){
        if(is_string($service)){
            $this->_service = $service;
        }
    }
    public function setMessage($message){
        if(is_string($message)){
            $this -> _message = $message;
        }
    }
    public function setDateDevis ($dateDevis){
        return $this -> _dateDevis = $dateDevis;
    }
    
}
?>
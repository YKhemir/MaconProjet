<?php
class Avis{
    // attributs 
    private $_idAvis;
    private $_idUser;
    private $_nom;
    private $_prenom;
    private $_titre;
    private $_avis;


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
    public function getIdAvis(){
        return $this -> _idAvis;
    }
    public function getNom(){
        return $this -> _nom;
    }
    public function getPrenom(){
        return $this -> _nom;
    }
    public function getIdUser(){
        return $this -> _idUser;
    }
    public function getTitre(){
        return $this -> _titre;
    }
    public function getAvis(){
        return $this -> _avis;
    }
    

    //Setters 
    public function setIdAvis($id){
       $id = (int) $id;
       if ($id > 0){
        return $this -> _idAvis = $id;
       }
    }

    public function setNom($nom){
        if (is_string($nom)){
            return $this -> _nom = $nom;
        }
    }

    public function setPrenom($prenom){
        if (is_string($prenom)){
            return $this -> _prenom = $prenom;
        }
    }

    public function setIdUser($idUser){
        $this -> _idUser = $idUser;
    }
    public function setTitre ($titre){
        if(is_string($titre)){
            return $this -> _titre = $titre;
        }
    }
    public function setAvis ($avis){
        if(is_string($avis)){
            return $this -> _avis = $avis;
        }
    }
    

}
?>
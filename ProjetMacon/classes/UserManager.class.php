<?php
include('User.class.php');
class UserManager{
    private $_db;
    public function __construct($db){
        $this->setDb($db);
    }
        
    
    // CRUD 
    public function add(User $user ){
        $q = $this->_db->prepare('INSERT INTO users (nom, prenom, email
        , mdp, type)VALUES (:nom, :prenom, :email, :mdp
        , :type)');
        $q->bindValue(':nom', $user->getNom());
        $q->bindValue(':prenom', $user->getPrenom());
        $q->bindValue(':email', $user->getEmail());
        $q->bindValue(':mdp', md5($user->getMdp()));
        $q->bindValue(':type', $user->getType());
        $q->execute();

        $user->hydrate([
            'Id' => $this->_db->lastInsertId(),
        ]);
    }
    public function delete(User $user){}
    public function update(){
    }
    public function getUser($sonMail){
        $q = $this -> _db -> query('SELECT id,nom,prenom,email,mdp,type FROM users WHERE email = "'. $sonMail .'"');
        $userInfo = $q-> fetch(PDO::FETCH_ASSOC);
        if($userInfo){
            return new User($userInfo);
        } else {
            return null;
        }
    }

    public function getTypeUser()
    {
    // Assurez-vous que $_SESSION['user_id'] est défini
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];

        $q = $this->_db->prepare('SELECT id ,type FROM users WHERE id = :id_user');
        $q->bindParam(':id_user', $userId, PDO::PARAM_INT);
        $q->execute();

        $userInfo = $q->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            return $userInfo['type'];
        }
    }

    }

    function getUserIdFromSession()
    {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        }
    }

    // chercher l'id du user dans la bd
    function getUserId($email){
        $q= $this->_db->prepare('SELECT id FROM users WHERE email = :Email');
        $q->execute([':Email' => $email]);
        $userInfo = $q->fetch(PDO::FETCH_ASSOC);

        if ($userInfo) {
            return $userInfo['id'];
        }
    }
    
    public function emailExists($email)
    {
        $q = $this->_db->prepare('SELECT COUNT(*) FROM users WHERE email = :Email');
        $q->execute([':Email' => $email]);
        return (bool) $q->fetchColumn();
    }

    public function exists($mailUser, $mdpUser)
    {
        $q= $this->_db->prepare('SELECT COUNT(*) FROM users WHERE email = :mail AND mdp = :mdp');
        $q->execute([':mail'=> $mailUser, ':mdp'=> md5($mdpUser)]);
        return (bool) $q->fetchColumn();
    }
    
    public function setDb(PDO $db){
        $this -> _db = $db;
    }
}
    
?>
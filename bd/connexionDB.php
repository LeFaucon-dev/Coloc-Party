<?php
// D�claration d'une nouvelle classe
class connexionDB {
    private $host    = 'localhost';    // nom de l'host
    private $name    = 'ColocParty';     // nom de la base de donn�e
    private $user    = 'root';         // utilisateur
    private $pass    = 'root';         // mot de passe (pour MAC/LINUX)
    //private $pass    = '';           // si on est sous windows decommenter cette ligne et commenter la pr�c�dente
    private $connexion;

    function __construct($host = null, $name = null, $user = null, $pass = null){
        if($host != null){
            $this->host = $host;           
            $this->name = $name;           
            $this->user = $user;          
            $this->pass = $pass;
        }
    try{
        $this->connexion = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->name,
            $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND =>'SET NAMES UTF8', PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
    }catch (PDOException $e){
        echo 'Erreur : Impossible de se connecter  � la BDD !';
    die();
   }
  }
    public function query($sql, $data = array()){
        $req = $this->connexion->prepare($sql);
        $req->execute($data);

        return $req;
    }
    public function insert($sql, $data = array()){
        $req = $this->connexion->prepare($sql);
        $req->execute($data);
    }
    public function replace($sql, $data = array()){
        $req = $this->connexion->prepare($sql);
        $req->execute($data);
    }
    
}

// Faire une connexion � votre fonction

?>

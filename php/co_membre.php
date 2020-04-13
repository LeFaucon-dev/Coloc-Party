<?php

class co_membre{
    public $id;
    public $pseudo;
    private $mdp; // On récupère le mot de passe 
    public $valid;
    public $erpseudo;
    public $ermdp;

    function __construct($pseudo,$mdp,$valid){

    	$this->pseudo = htmlentities(strtolower(trim($pseudo)));
    	$this->mdp = trim($mdp);
	    $this->valid = $valid;

        $DB=new connexionDB();

        if(empty($this->pseudo)){ // Vérification qu'il y est bien un mail de renseigné
            $this->valid = false;
            $this->erpseudo = "Il faut mettre un pseudo";
        }

        elseif(empty($this->mdp)){ // Vérification qu'il y est bien un mot de passe de renseigné
            $this->valid = false;
            $this->ermdp = "Il faut mettre un mot de passe";
        }
        else{
            $req = $DB->query("SELECT * FROM membres WHERE pseudo = ? ",array($this->pseudo));

            $req = $req->fetch();
            // Si on a pas de résultat alors c'est qu'il n'y a pas d'utilisateur correspondant au couple mail / mot de passe
            if ($req == false){
                $this->valid = false;
                $this->erpseudo = "Le pseudo ou le mot de passe est incorrecte";

            }
           else{
            $hash = $req['mdp'];
                if (!password_verify($this->mdp, $hash)) { $this->ermdp = "Le mail ou le mot de passe est incorrecte";}
                else{
                    $this->id=$req['id'];
                    $this->pseudo=$req['pseudo'];
                } 
            }
        }
        // On fait une requête pour savoir si le couple pseudo / mot de passe existe bien car le mail est unique !
    }
}
?>